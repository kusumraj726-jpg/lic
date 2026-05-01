<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TtsService
{
    /**
     * Generate TTS using Google Translate unofficial API (Free & Reliable)
     * 
     * @param string $text
     * @param string $lang (hi for Hindi, en for English)
     * @return string|null Base64 encoded MP3
     */
    public function generate(string $text, string $lang = 'hi'): ?string
    {
        try {
            // Trim and clean text
            $text = trim($text);
            if (empty($text)) return null;

            // Google Translate TTS endpoint
            // client=tw-ob is the magic parameter that bypasses many restrictions
            $url = "https://translate.google.com/translate_tts?ie=UTF-8&q=" . urlencode($text) . "&tl=" . $lang . "&client=tw-ob";

            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ])->get($url);

            if ($response->successful()) {
                return base64_encode($response->body());
            }

            Log::error("TTS Service Error: " . $response->status() . " - " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("TTS Service Exception: " . $e->getMessage());
            return null;
        }
    }
}
