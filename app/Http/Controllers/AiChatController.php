<?php

namespace App\Http\Controllers;

use App\Models\AiChatSession;
use App\Models\AiChatMessage;
use App\Services\GroqChatService;
use App\Services\TtsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiChatController extends Controller
{
    protected $groq;
    protected $intelligence;

    public function __construct(GroqChatService $groq, \App\Services\VeloraIntelligenceService $intelligence)
    {
        $this->groq = $groq;
        $this->intelligence = $intelligence;
    }

    public function getBrief()
    {
        $user = Auth::user();
        $tenant = $user->context();
        $now = \Carbon\Carbon::now();

        $stats = [
            'clients' => $tenant->clients()->count(),
            'queries' => $tenant->queries()->whereIn('status', ['pending', 'open', 'in-progress'])->count(),
            'claims'  => $tenant->claims()->whereIn('status', ['pending', 'submitted'])->count(),
            'renewals' => $tenant->renewals()->where('status', 'pending')->whereDate('expiry_date', '>=', $now)->whereDate('expiry_date', '<=', $now->copy()->addDays(7))->count(),
        ];

        $greeting = "Hi " . explode(' ', $user->name)[0] . "! Velora HQ mein aapka swagat hai.";
        $update = "Aapke paas " . $stats['clients'] . " clients hain, aur " . ($stats['queries'] + $stats['claims']) . " pending items hain jinpar dhyan dena zaroori hai.";
        
        if ($stats['renewals'] > 0) {
            $update .= " Saath hi, is hafte " . $stats['renewals'] . " renewals bhi aa rahe hain.";
        }

        $question = " Kya aap abhi kisi cheez par update chahte hain?";

        return response()->json([
            'message' => "{$greeting} {$update}{$question}",
            'stats' => $stats
        ]);
    }

    public function getHistory()
    {
        $sessions = AiChatSession::where('user_id', Auth::id())
            ->with(['messages' => function($q) {
                $q->orderBy('created_at', 'asc');
            }])
            ->latest()
            ->get();

        return response()->json($sessions);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'nullable|exists:ai_chat_sessions,id',
            'url' => 'nullable|string',
            'currentPage' => 'nullable|string'
        ]);

        $user = Auth::user();
        
        // Find or create session
        if ($request->session_id) {
            $session = AiChatSession::where('user_id', $user->id)->findOrFail($request->session_id);
        } else {
            $session = AiChatSession::create([
                'user_id' => $user->id,
                'title' => substr($request->message, 0, 40) . '...'
            ]);
        }

        // Save User Message
        AiChatMessage::create([
            'ai_chat_session_id' => $session->id,
            'role' => 'user',
            'content' => $request->message
        ]);

        // Get context: Limited to last 6 messages
        $messages = $session->messages()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->reverse()
            ->map(function($m) {
                $item = [
                    'role' => $m->role,
                    'content' => $m->content,
                ];
                if ($m->tool_call_id) $item['tool_call_id'] = $m->tool_call_id;
                if ($m->name) $item['name'] = $m->name;
                return $item;
            })->toArray();

        // 🧠 BRAIN INJECTION: Pull autonomous memories
        $brainMemories = $this->intelligence->getMemoriesForPrompt($user);

        // LIVE CONTEXT INJECTION
        $liveContext = "";
        if ($request->url) {
            $liveContext = "\n**CURRENT UI CONTEXT (Your 'Eyes')**:\n- Page: " . $request->url;
            if ($request->currentPage) $liveContext .= "\n- Active Module: " . $request->currentPage;
        }

        $systemPrompt = <<<PROMPT
**Velora Identity**: You are a warm, helpful FEMALE secretary named Velora.
**GENDER**: Strictly Female. Use "bata sakti hu", "karki hu", "ati hu".
**REASONING (The Brain)**: You have an advanced 'Autonomous Brain'. Before responding, silently 'Think' (Chain of Thought):
1. Analyze the user's HIDDEN intent.
2. Check your 'Autonomous Memories' for user habits.
3. Determine the most accurate tool or conversational answer.
**PROJECT BLUEPRINT (Your ERP Source Code Knowledge)**:
- CLIENTS: Fields are [name, phone, email, dob, marriage_anniversary, unique_id].
- CLAIMS: Linked to clients. Fields [policy_number, amount, status].
- RENEWALS: Linked to clients. Fields [policy_name, expiry_date].
- QUERIES: Statuses are [pending, open, in-progress].
- ROUTES: /dashboard, /clients, /queries, /claims, /renewals, /staff.
**SKILLS**: You can search anything (universal_search), navigate ERP modules, switch themes, call/message clients.
**CONVERSATION**: If the user asks "What can you do?", speak about your skills naturally. 
**VOICE RULES**: You MUST ALWAYS say a human sentence when you use a tool.
**LANGUAGE**: Mirror the user's language (Hinglish/English).
$brainMemories
$liveContext
PROMPT;

        array_unshift($messages, [
            'role' => 'system',
            'content' => $systemPrompt,
        ]);

        try {
            $response = $this->groq->chat($messages, $user);
            $choice = $response['choices'][0]['message'];
            $pendingActions = [];

            $count = 0;
            while (isset($choice['tool_calls']) && $count < 3) {
                $assistantContent = $choice['content'] ?? null;
                $messages[] = [
                    'role' => 'assistant',
                    'content' => $assistantContent,
                    'tool_calls' => $choice['tool_calls'],
                ];

                AiChatMessage::create([
                    'ai_chat_session_id' => $session->id,
                    'role' => 'assistant',
                    'content' => $assistantContent ?? '',
                    'tool_call_id' => $choice['tool_calls'][0]['id'] ?? null,
                ]);

                foreach ($choice['tool_calls'] as $toolCall) {
                    $result = $this->groq->executeTool(
                        $toolCall['function']['name'], 
                        json_decode($toolCall['function']['arguments'], true) ?? [], 
                        $user
                    );

                    if (isset($result['__action'])) {
                        $pendingActions[] = $result;
                    }

                    $toolContent = json_encode($result);
                    $messages[] = [
                        'role' => 'tool',
                        'tool_call_id' => $toolCall['id'],
                        'name' => $toolCall['function']['name'],
                        'content' => $toolContent,
                    ];

                    AiChatMessage::create([
                        'ai_chat_session_id' => $session->id,
                        'role' => 'tool',
                        'name' => $toolCall['function']['name'],
                        'tool_call_id' => $toolCall['id'],
                        'content' => $toolContent,
                    ]);
                }

                $response = $this->groq->chat($messages, $user);
                $choice = $response['choices'][0]['message'];
                $count++;
            }

            $finalContent = $choice['content'] ?? 'Done!';
            
            // CLEAN ALL TOOL LEAKS AT THE SOURCE
            $finalContent = preg_replace('/<.*?>/i', '', $finalContent);
            $finalContent = preg_replace('/\(.*?\)/i', '', $finalContent);
            $finalContent = preg_replace('/\{"__action"[\s\S]*?\}/i', '', $finalContent);
            $finalContent = trim($finalContent);

            AiChatMessage::create([
                'ai_chat_session_id' => $session->id,
                'role' => 'assistant',
                'content' => $finalContent,
            ]);

            return response()->json([
                'session_id' => $session->id,
                'response' => $finalContent,
                'actions' => $pendingActions,
            ]);

            // 🧠 BRAIN DEVELOPMENT: Autonomous Distillation
            $this->intelligence->distillSilently($user, $messages);

            return $response;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteSession(AiChatSession $session)
    {
        if ($session->user_id !== Auth::id()) abort(403);
        $session->delete();
        return response()->json(['success' => true]);
    }
}
