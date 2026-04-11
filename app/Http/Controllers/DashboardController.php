<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Query;
use App\Models\Claim;
use App\Models\Renewal;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();
        $now = \Carbon\Carbon::now();
        
        // 1. Core Statistics
        $stats = [
            'clients_count' => $context->clients()->count(),
            'open_queries' => $context->queries()->whereIn('status', ['pending', 'open', 'in-progress'])->count(),
            'pending_claims' => $context->claims()->whereIn('status', ['pending', 'submitted'])->count(),
            'upcoming_renewals' => $context->renewals()->where('status', 'pending')->whereDate('expiry_date', '>=', $now)->count(),
        ];

        // 2. Chart Data (Last 6 Months)
        $months = collect(range(5, 0))->map(function ($i) use ($now) {
            return $now->copy()->subMonths($i)->format('M');
        });

        $chartData = [
            'labels' => $months,
            'queries' => collect(range(5, 0))->map(function ($i) use ($context, $now) {
                return $context->queries()->whereMonth('created_at', $now->copy()->subMonths($i)->month)->count();
            }),
            'claims' => collect(range(5, 0))->map(function ($i) use ($context, $now) {
                return $context->claims()->whereMonth('created_at', $now->copy()->subMonths($i)->month)->count();
            }),
        ];

        // 3. Combined Recent Activity
        $recent_queries = $context->queries()->with('client')->latest()->take(5)->get()->map(function($q) {
            $q->activity_type = 'Query';
            $q->activity_url = route('queries.index', ['id' => $q->id]);
            $q->activity_icon = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>';
            $q->activity_color = 'rose';
            return $q;
        });

        $recent_claims = $context->claims()->with('client')->latest()->take(5)->get()->map(function($c) {
            $c->activity_type = 'Claim';
            $c->activity_url = route('claims.index', ['id' => $c->id]);
            $c->activity_icon = '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>';
            $c->activity_color = 'amber';
            return $c;
        });

        $activities = $recent_queries->concat($recent_claims)->sortByDesc('created_at')->take(8);

        // 4. Attention Required — all active queries and claims
        $urgent_queries = $context->queries()->with('client')->whereIn('status', ['pending', 'open', 'in-progress'])->latest()->get()->map(function($q) {
            $q->type = 'Query';
            $q->color = 'rose';
            $q->url = route('queries.index', ['id' => $q->id]);
            return $q;
        });

        $urgent_claims = $context->claims()->with('client')->whereIn('status', ['pending', 'submitted'])->latest()->get()->map(function($c) {
            $c->type = 'Claim';
            $c->color = 'amber';
            $c->url = route('claims.index', ['id' => $c->id]);
            return $c;
        });

        $urgent_items = $urgent_queries->concat($urgent_claims)->sortByDesc('created_at')->take(8);

        // 5. Calendar Events (Birthdays + Renewals)
        $calendar_events = collect();
        
        // Add Birthdays to Calendar
        $context->clients()->whereNotNull('dob')->get()->each(function($client) use ($calendar_events) {
            $dob = \Carbon\Carbon::parse($client->dob);
            $calendar_events->push([
                'day' => (int)$dob->day,
                'month' => (int)$dob->month,
                'type' => 'birthday',
                'title' => "{$client->name}'s Birthday",
                'color' => 'indigo'
            ]);
        });

        // Add Renewals to Calendar
        $context->renewals()->get()->each(function($renewal) use ($calendar_events) {
            $expiry = \Carbon\Carbon::parse($renewal->expiry_date);
            $calendar_events->push([
                'day' => (int)$expiry->day,
                'month' => (int)$expiry->month,
                'type' => 'renewal',
                'title' => "Renewal: {$renewal->policy_type}",
                'color' => 'rose'
            ]);
        });

        $birthdays = $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get();
        $upcoming_birthdays = $context->clients()
            ->where(function($q) use ($now) {
                $start = $now->copy()->addDay();
                $end = $now->copy()->addDays(7);
                
                if ($start->month == $end->month) {
                    $q->whereMonth('dob', $start->month)
                      ->whereDay('dob', '>=', $start->day)
                      ->whereDay('dob', '<=', $end->day);
                } else {
                    $q->where(function($sub) use ($start) {
                        $sub->whereMonth('dob', $start->month)->whereDay('dob', '>=', $start->day);
                    })->orWhere(function($sub) use ($end) {
                        $sub->whereMonth('dob', $end->month)->whereDay('dob', '<=', $end->day);
                    });
                }
            })
            ->orderByRaw("MONTH(dob), DAY(dob)")
            ->take(3)
            ->get();

        return view('dashboard', compact('stats', 'chartData', 'activities', 'urgent_items', 'birthdays', 'calendar_events', 'upcoming_birthdays'));
    }
}
