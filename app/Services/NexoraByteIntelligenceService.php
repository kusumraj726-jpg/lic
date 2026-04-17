<?php

namespace App\Services;

use App\Models\User;
use App\Models\NexoraByteInsight;
use Illuminate\Support\Facades\Log;

class NexoraByteIntelligenceService
{
    protected $groq;

    public function __construct(GroqChatService $groq)
    {
        $this->groq = $groq;
    }

    /**
     * SILENT DISTILLATION: Extracts insights autonomously from conversation history.
     */
    public function distillSilently(User $user, array $messages): void
    {
        // Don't waste API calls on very short threads
        if (count($messages) < 2) return;

        try {
            $historySnippet = json_encode(array_slice($messages, -4));
            
            $distillPrompt = [
                ['role' => 'system', 'content' => "You are an Autonomous Brain Engine. Analyze the conversation history and extract ONE key pattern, preference, or 'Brain Rule' the AI should follow for THIS user. 
                Focus on:
                1. Search habits (e.g., 'User prefers phone search').
                2. Tone/Language (e.g., 'Use more Hinglish').
                3. Content focus (e.g., 'Prioritize renewal data').
                
                Respond ONLY with the distilled rule as a short sentence. If nothing new, respond with 'NONE'."],
                ['role' => 'user', 'content' => "History: " . $historySnippet]
            ];

            // Use Groq for a fast distillation pass
            $response = $this->groq->chat($distillPrompt, $user);
            $insightContent = trim($response['choices'][0]['message']['content'] ?? 'NONE');

            if (str_contains(strtoupper($insightContent), 'NONE')) return;

            // Store it silently
            NexoraByteInsight::updateOrCreate(
                ['user_id' => $user->id, 'content' => $insightContent],
                ['category' => 'autonomous_habit', 'importance' => 5]
            );

        } catch (\Exception $e) {
            Log::error("NexoraByte Autonomous Learning Error: " . $e->getMessage());
        }
    }

    /**
     * Fetch relevant memories for the user to inject into the prompt.
     */
    public function getMemoriesForPrompt(User $user): string
    {
        $insights = NexoraByteInsight::where('user_id', $user->id)
            ->orderBy('importance', 'desc')
            ->take(5)
            ->get();

        if ($insights->isEmpty()) return "";

        $memoryString = "\n**AUTONOMOUS BRAIN CONTEXT (Your evolved knowledge of this user)**:\n";
        foreach ($insights as $insight) {
            $memoryString .= "- " . $insight->content . "\n";
        }

        return $memoryString;
    }
}
