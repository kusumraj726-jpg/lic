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

        // Global NexoraByte Intelligence View Composer
        view()->composer('layouts.app', function ($view) {
            $user = auth()->user();
            if (!$user) return;
            
            $context = $user->context();
            $now = \Carbon\Carbon::now();
            $briefs = collect();

            // Calculate Trends/Stats for logic (simplified for briefing)
            $open_queries = $context->queries()->whereIn('status', ['pending', 'open', 'in-progress'])->count();
            $pending_claims = $context->claims()->whereIn('status', ['pending', 'submitted'])->count();
            $overdue_renewals = $context->renewals()->where('status', 'pending')->whereDate('expiry_date', '<=', $now)->count();
            $upcoming_renewals_7d = $context->renewals()
                ->where('status', 'pending')
                ->whereBetween('expiry_date', [$now->copy()->startOfDay(), $now->copy()->addDays(7)->endOfDay()])
                ->count();

            // Intelligence Logic (Trigger on ANY critical pending to sync with Priority Diagnostic)
            if ($open_queries > 0) {
                $briefs->push(['title' => 'Pending Queries', 'message' => "{$open_queries} queries require your attention.", 'type' => 'warning', 'url' => route('queries.index')]);
            }
            if ($pending_claims > 0) {
                $briefs->push(['title' => 'Active Claims', 'message' => "{$pending_claims} cases pending resolution.", 'type' => 'info', 'url' => route('claims.index')]);
            }
            if ($overdue_renewals > 0) {
                $briefs->push(['title' => 'Overdue Renewals', 'message' => "{$overdue_renewals} renewals are past due.", 'type' => 'danger', 'url' => route('renewals.index')]);
            }
            if ($upcoming_renewals_7d > 0) {
                $briefs->push(['title' => 'Upcoming Renewals', 'message' => "{$upcoming_renewals_7d} renewals in 7 days.", 'type' => 'success', 'url' => route('renewals.index')]);
            }

            // High Priority Queries (Individual)
            $context->queries()->where('priority', 'High')->whereIn('status', ['pending', 'open', 'in-progress', 'Pending', 'Open', 'In-Progress'])->get()->each(function($q) use ($briefs) {
                $briefs->push(['title' => 'Urgent Query', 'message' => "High priority query: {$q->subject}", 'type' => 'danger', 'url' => route('queries.index', ['search' => $q->subject])]);
            });

            // Birthdays & Anniversaries
            $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(function($c) use ($briefs) {
                $briefs->push(['title' => 'Birthday', 'message' => "Today is {$c->name}'s birthday! Send a gift or greeting.", 'type' => 'brand', 'url' => '#', 'action_type' => 'message', 'name' => $c->name, 'phone' => $c->phone, 'event_type' => 'birthday']);
            });
            $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(function($s) use ($briefs) {
                $briefs->push(['title' => 'Staff Birthday', 'message' => "{$s->name} celebrates their birthday today!", 'type' => 'brand', 'url' => '#', 'action_type' => 'message', 'name' => $s->name, 'phone' => $s->phone, 'event_type' => 'birthday']);
            });
            if ($context->dob && \Carbon\Carbon::parse($context->dob)->isBirthday()) {
                $briefs->push(['title' => 'Team Milestone', 'message' => 'Happy Birthday! Wishing you a great day.', 'type' => 'brand', 'url' => '#']);
            }

            // Anniversaries
            $context->clients()->whereMonth('marriage_anniversary', $now->month)->whereDay('marriage_anniversary', $now->day)->get()->each(function($c) use ($briefs) {
                $briefs->push(['title' => 'Anniversary', 'message' => "Today is {$c->name}'s marriage anniversary! Send a flower or greeting.", 'type' => 'brand', 'url' => '#', 'action_type' => 'message', 'name' => $c->name, 'phone' => $c->phone, 'event_type' => 'anniversary']);
            });

            // Make templates globally available for the modal
            $birthday_template = $user->birthday_template ?? "Happy Birthday, [NAME]! 🎂 Wishing you a year filled with happiness and success. - Best regards, " . ($user->company_name ?? $user->name);
            $anniversary_template = $user->anniversary_template ?? "Happy Anniversary, [NAME]! 🥂 Wishing you many more years of love and togetherness. - Regards, " . ($user->company_name ?? $user->name);

            $view->with('global_intel', $briefs)
                 ->with('birthday_template', $birthday_template)
                 ->with('anniversary_template', $anniversary_template);
        });
    }
}
