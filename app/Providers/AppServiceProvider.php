<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Global Velora Intelligence View Composer
        view()->composer('layouts.app', function ($view) {
            $user = auth()->user();
            if (!$user) return;
            
            $context = $user->context();
            $now = \Carbon\Carbon::now();
            $briefs = collect();

            // Calculate Trends/Stats for logic (simplified for briefing)
            $open_queries = $context->queries()->whereIn('status', ['pending', 'open', 'in-progress'])->count();
            $pending_claims = $context->claims()->whereIn('status', ['pending', 'submitted'])->count();
            $upcoming_renewals_7d = $context->renewals()
                ->where('status', 'pending')
                ->whereBetween('expiry_date', [$now->copy()->startOfDay(), $now->copy()->addDays(7)->endOfDay()])
                ->count();

            // Intelligence Logic
            if ($open_queries > 5) {
                $briefs->push(['title' => 'Query Surge', 'message' => 'High communication volume detected.', 'type' => 'warning']);
            }
            if ($pending_claims > 3) {
                $briefs->push(['title' => 'Claim Pulse', 'message' => 'Multiple cases pending resolution.', 'type' => 'info']);
            }
            if ($upcoming_renewals_7d > 0) {
                $briefs->push(['title' => 'Renewal Alert', 'message' => "{$upcoming_renewals_7d} renewals in 7 days.", 'type' => 'success']);
            }

            // Birthdays
            $b_count = 0;
            $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(function($c) use (&$b_count, $briefs) {
                $briefs->push(['title' => 'Birthday', 'message' => "It's {$c->name}'s birthday today!", 'type' => 'brand']);
                $b_count++;
            });
            $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(function($s) use (&$b_count, $briefs) {
                $briefs->push(['title' => 'Staff Birthday', 'message' => "{$s->name} celebrates today!", 'type' => 'brand']);
                $b_count++;
            });
            if ($context->dob && \Carbon\Carbon::parse($context->dob)->isBirthday()) {
                $briefs->push(['title' => 'Personal Milestone', 'message' => 'Happy Birthday!', 'type' => 'brand']);
                $b_count++;
            }

            $view->with('global_intel', $briefs);
        });
    }
}
