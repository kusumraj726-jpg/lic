<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct(User $user, $password = null)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function handle(): void
    {
        try {
            $response = Http::withHeaders([
                'api-key' => env('BREVO_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name'  => 'nexorabyte',
                    'email' => 'info@nexorabyte.in',
                ],
                'to' => [
                    ['email' => $this->user->email, 'name' => $this->user->name],
                ],
                'subject' => 'Welcome to NexoraByte — Your Elite Workspace is Ready',
                'htmlContent' => view('emails.welcome', ['user' => $this->user, 'password' => $this->password])->render(),
            ]);

            if (!$response->successful()) {
                Log::error("Brevo API failed for {$this->user->email}: " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error("WelcomeEmail exception for {$this->user->email}: " . $e->getMessage());
        }
    }
}
