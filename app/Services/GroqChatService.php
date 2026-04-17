<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Claim;
use App\Models\Query;
use App\Models\Renewal;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqChatService
{
    protected string $apiKey;
    protected string $model = 'llama-3.1-8b-instant';

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key', env('GROQ_API_KEY'));
    }

    public function chat(array $messages, User $user, int $retryCount = 0)
    {
        $response = Http::withToken($this->apiKey)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'tools' => $this->getTools($user),
                'tool_choice' => 'auto',
            ]);

        if ($response->failed()) {
            $error = $response->json();
            // Handle Rate Limit (code: rate_limit_exceeded)
            if (isset($error['error']['code']) && $error['error']['code'] === 'rate_limit_exceeded' && $retryCount < 2) {
                // Wait 0.5 seconds before retry
                usleep(500000); 
                return $this->chat($messages, $user, $retryCount + 1);
            }

            Log::error('Groq API Error: ' . $response->body());
            throw new \Exception('AI service is currently busy. Please try again in a few seconds.');
        }

        $data = $response->json();

        // --- BULLETPROOF PARSER: FALLBACK FOR MIS-FORMATTED TOOL CALLS ---
        if (isset($data['choices'][0]['message']) && empty($data['choices'][0]['message']['tool_calls'])) {
            $content = $data['choices'][0]['message']['content'] ?? '';
            $foundTool = false;
            $funcName = '';
            $funcArgs = '';

            // Pattern 1: <function=name{args}</function>
            if (preg_match('/<function=(\w+)(.*?)<\/function>/is', $content, $matches)) {
                $funcName = $matches[1];
                $funcArgs = trim($matches[2]);
                $content = preg_replace('/<function=.*?<\/function>/is', '', $content);
                $foundTool = true;
            } 
            // Pattern 2: Raw JSON block {"type": "function", "name": "...", "parameters" or "arguments": {...}}
            else if (preg_match('/\{(?:.*?"type":\s*"function".*?"name":\s*"(\w+)".*?(?:"parameters"|"arguments"):\s*(\{.*?\})|.*?"name":\s*"(\w+)".*?"arguments":\s*(\{.*?\})).*?\}/is', $content, $matches)) {
                // Determine which group matched (group 1/2 or 3/4)
                if (!empty($matches[1])) {
                    $funcName = $matches[1];
                    $funcArgs = $matches[2];
                } else {
                    $funcName = $matches[3];
                    $funcArgs = $matches[4];
                }
                $content = preg_replace('/\{[^}]*?"name":\s*"' . $funcName . '".*?\}/is', '', $content);
                $foundTool = true;
            }

            if ($foundTool) {
                // Ensure args is valid JSON
                $argsArray = json_decode($funcArgs, true) ?? [];

                $data['choices'][0]['message']['tool_calls'] = [[
                    'id' => 'call_' . uniqid(),
                    'type' => 'function',
                    'function' => [
                        'name' => $funcName,
                        'arguments' => json_encode($argsArray)
                    ]
                ]];
                
                // Update and clean content
                $data['choices'][0]['message']['content'] = trim($content);
            }
        }

        return $data;
    }

    protected function getTools(User $user): array
    {
        $tools = [];

        // Check permissions for tool definitions
        $canAccessClients = true;
        $canAccessQueries = true;
        $canAccessClaims = true;
        $canAccessRenewals = true;

        if ($user->role === 'staff' && $user->linkedStaffProfile) {
            $canAccessClients = (bool) $user->linkedStaffProfile->access_clients;
            $canAccessQueries = (bool) $user->linkedStaffProfile->access_queries;
            $canAccessClaims = (bool) $user->linkedStaffProfile->access_claims;
            $canAccessRenewals = (bool) $user->linkedStaffProfile->access_renewals;
        }

        if ($canAccessClients) {
            $tools[] = [
                'type' => 'function',
                'function' => [
                    'name' => 'get_clients_summary',
                    'description' => 'Get counts and basic breakdown of clients in the workspace.',
                ]
            ];
        }

        if ($canAccessQueries) {
            $tools[] = [
                'type' => 'function',
                'function' => [
                    'name' => 'get_queries_summary',
                    'description' => 'Get summary of client queries and their current statuses.',
                ]
            ];
        }

        if ($canAccessClaims) {
            $tools[] = [
                'type' => 'function',
                'function' => [
                    'name' => 'get_claims_summary',
                    'description' => 'Get summary of insurance claims currently in the system.',
                ]
            ];
        }

        if ($canAccessRenewals) {
            $tools[] = [
                'type' => 'function',
                'function' => [
                    'name' => 'get_renewals_summary',
                    'description' => 'Get summary of upcoming policy renewals.',
                ]
            ];
        }

        if ($user->role === 'advisor' || $user->role === 'admin') {
            $tools[] = [
                'type' => 'function',
                'function' => [
                    'name' => 'get_staff_summary',
                    'description' => 'Get information about your staff members and their access levels.',
                ]
            ];
        }

        // — Action Tools (always available, any role) —
        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'set_theme',
                'description' => 'Switch the UI theme between light mode and dark mode. Use when the user asks to turn on/off dark mode, switch theme, enable light/dark mode, etc.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'mode' => [
                            'type' => 'string',
                            'enum' => ['dark', 'light'],
                            'description' => 'The theme to apply: "dark" for dark mode, "light" for light mode.',
                        ],
                    ],
                    'required' => ['mode'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'navigate_to',
                'description' => 'Navigate the user to a specific page or module in the ERP. Use when the user asks to "go to", "open", "show me", or "take me to" a section.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'page' => [
                            'type' => 'string',
                            'enum' => ['dashboard', 'clients', 'queries', 'claims', 'renewals', 'staff', 'settings', 'trash', 'profile'],
                            'description' => 'The page to navigate to.',
                        ],
                    ],
                    'required' => ['page'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'universal_search',
                'description' => 'A powerful deep search into the ERP. Search for anything: Clients (name, phone, email), Claims (policy number, client), or Renewals. Use when the user asks to "find", "search", "look up", or "where is".',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'query' => [
                            'type' => 'string',
                            'description' => 'The search term (name, phone number, email, or policy number).',
                        ],
                    ],
                    'required' => ['query'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'send_whatsapp',
                'description' => 'Send a WhatsApp message to a client. Find the client by name, then open WhatsApp web with their phone number and a pre-filled message. Use for: "send WhatsApp to [name]", "WhatsApp [name]", "message [name]".',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'client_name' => ['type' => 'string', 'description' => 'Name of the client to message on WhatsApp.'],
                        'message'     => ['type' => 'string', 'description' => 'The pre-filled WhatsApp message. Write it professionally in the SAME LANGUAGE the user spoke.'],
                    ],
                    'required' => ['client_name', 'message'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'call_client',
                'description' => 'Initiate a phone call to a client. Use for: "call [name]", "phone [name]", "dial [name]".',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'client_name' => ['type' => 'string', 'description' => 'Name of the client to call.'],
                    ],
                    'required' => ['client_name'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'open_form',
                'description' => 'Open a form to add a new record. Use for: "add new client", "create claim", "add renewal", "new query" etc.',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'form' => [
                            'type' => 'string',
                            'enum' => ['client', 'claim', 'query', 'renewal', 'staff'],
                            'description' => 'Which form to open.',
                        ],
                    ],
                    'required' => ['form'],
                ],
            ],
        ];

        $tools[] = [
            'type' => 'function',
            'function' => [
                'name' => 'save_preference',
                'description' => 'Save a specific user preference, habit, or instruction to your permanent memory. Use when the user says "Always do X" or "Remember Y".',
                'parameters' => [
                    'type' => 'object',
                    'properties' => [
                        'preference' => ['type' => 'string', 'description' => 'The specific instruction or preference to remember.'],
                        'category' => ['type' => 'string', 'enum' => ['habit', 'preference', 'voice_config'], 'description' => 'The type of memory.'],
                    ],
                    'required' => ['preference', 'category'],
                ],
            ],
        ];

        return $tools;
    }

    public function executeTool(string $name, array $arguments, User $user): array
    {
        $tenant = $user->context();

        switch ($name) {
            case 'get_clients_summary':
                $clients = $tenant->clients()->get(['name', 'email', 'phone', 'dob']);
                return [
                    'total_clients' => $clients->count(),
                    'recent_clients' => $clients->take(5)->values()->toArray(),
                ];

            case 'get_queries_summary':
                $queries = $tenant->queries()->get(['id', 'subject', 'status']);
                return [
                    'total_queries' => $queries->count(),
                    'by_status' => $queries->groupBy('status')->map->count()->toArray(),
                ];

            case 'get_claims_summary':
                $claims = $tenant->claims()->with('client:id,name')->get();
                return [
                    'total_claims' => $claims->count(),
                    'by_status' => $claims->groupBy('status')->map->count()->toArray(),
                    'recent' => $claims->take(5)->map(function($c) {
                        return [
                            'client' => $c->client?->name,
                            'policy' => $c->policy_number,
                            'status' => $c->status,
                        ];
                    })->values()->toArray(),
                ];

            case 'get_renewals_summary':
                $renewals = $tenant->renewals()->with('client:id,name')->get();
                return [
                    'total' => $renewals->count(),
                    'pending' => $renewals->where('status', 'pending')->count(),
                    'upcoming' => $renewals->sortBy('due_date')->take(10)->map(function($r) {
                        return [
                            'client' => $r->client?->name,
                            'due' => $r->due_date,
                            'amount' => $r->premium_amount,
                        ];
                    })->values()->toArray(),
                ];

            case 'get_staff_summary':
                if ($user->role !== 'advisor' && $user->role !== 'admin') {
                    return ['error' => 'Unauthorized: Only advisors/admins can view staff data.'];
                }
                return [
                    'total_staff' => $tenant->staff()->count(),
                    'members' => $tenant->staff()->get(['name', 'designation', 'status'])->toArray(),
                ];

            // — Action tools: return special markers for frontend to handle —
            case 'set_theme':
                $mode = $arguments['mode'] ?? 'dark';
                return ['__action' => 'set_theme', 'mode' => $mode];

            case 'navigate_to':
                $page = $arguments['page'] ?? 'dashboard';
                $routes = [
                    'dashboard' => '/dashboard',
                    'clients' => '/clients',
                    'queries' => '/queries',
                    'claims' => '/claims',
                    'renewals' => '/renewals',
                    'staff' => '/staff',
                    'settings' => '/settings',
                    'trash' => '/trash',
                    'profile' => '/profile',
                ];
                return ['__action' => 'navigate', 'url' => $routes[$page] ?? '/dashboard'];

            case 'universal_search':
                $q = $arguments['query'] ?? '';
                
                // 1. Search Clients (Name, Phone, Email)
                $client = $tenant->clients()
                    ->where('name', 'like', "%$q%")
                    ->orWhere('phone', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%")
                    ->first(['id', 'name']);

                if ($client) {
                    return ['__action' => 'navigate', 'url' => '/clients/' . $client->id, 'found' => 'Client: ' . $client->name];
                }

                // 2. Search Claims (Policy Number)
                $claim = $tenant->claims()->where('policy_number', 'like', "%$q%")->first(['id', 'policy_number']);
                if ($claim) {
                    return ['__action' => 'navigate', 'url' => '/claims', 'found' => 'Claim Policy: ' . $claim->policy_number];
                }

                // 3. Search Renewals (Policy Name)
                $renewal = $tenant->renewals()->where('policy_name', 'like', "%$q%")->first(['id', 'policy_name']);
                if ($renewal) {
                    return ['__action' => 'navigate', 'url' => '/renewals', 'found' => 'Renewal: ' . $renewal->policy_name];
                }

                return ['error' => 'I searched everywhere but couldn\'t find "' . $q . '". Please try a different term.'];

            case 'send_whatsapp':
                $clientName = $arguments['client_name'] ?? '';
                $message    = $arguments['message'] ?? '';
                $client = $tenant->clients()->where('name', 'like', '%' . $clientName . '%')->first(['id', 'name', 'phone']);
                if (!$client) {
                    return ['error' => 'Client "' . $clientName . '" not found.'];
                }
                if (!$client->phone) {
                    return ['error' => 'Client "' . $client->name . '" has no phone number saved.'];
                }
                // Strip non-digits, ensure country code
                $phone = preg_replace('/[^0-9]/', '', $client->phone);
                if (strlen($phone) === 10) $phone = '91' . $phone;  // Add India country code
                $waUrl = 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
                return ['__action' => 'open_url', 'url' => $waUrl, 'client' => $client->name, 'phone' => $client->phone];

            case 'call_client':
                $clientName = $arguments['client_name'] ?? '';
                $client = $tenant->clients()->where('name', 'like', '%' . $clientName . '%')->first(['id', 'name', 'phone']);
                if (!$client) {
                    return ['error' => 'Client "' . $clientName . '" not found.'];
                }
                if (!$client->phone) {
                    return ['error' => 'Client "' . $client->name . '" has no phone number saved.'];
                }
                return ['__action' => 'open_url', 'url' => 'tel:' . $client->phone, 'client' => $client->name];

            case 'open_form':
                $form = $arguments['form'] ?? 'client';
                $formRoutes = [
                    'client'  => '/clients/create',
                    'claim'   => '/claims/create',
                    'query'   => '/queries/create',
                    'renewal' => '/renewals/create',
                    'staff'   => '/staff/create',
                ];
                return ['__action' => 'navigate', 'url' => $formRoutes[$form] ?? '/clients/create'];

            case 'save_preference':
                $pref = $arguments['preference'] ?? '';
                $cat = $arguments['category'] ?? 'habit';
                \App\Models\NexoraByteInsight::updateOrCreate(
                    ['user_id' => $user->id, 'content' => $pref],
                    ['category' => $cat, 'importance' => 8]
                );
                return ['success' => true, 'message' => 'Memory saved.'];

            default:
                return ['error' => 'Tool not found.'];
        }
    }
}
