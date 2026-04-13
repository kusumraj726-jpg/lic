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
        
        // 1. Core Statistics & Trend Analysis
        $lastMonth = $now->copy()->subMonth();
        
        $currentClients = $context->clients()->count();
        $prevClients = $context->clients()->whereDate('created_at', '<', $now->copy()->startOfMonth())->count();
        
        $stats = [
            'clients_count' => $currentClients,
            'clients_trend' => $this->calculateTrend($currentClients, $prevClients),
            
            'open_queries' => $context->queries()->whereIn('status', ['pending', 'open', 'in-progress'])->count(),
            'queries_trend' => $this->calculateTrend(
                $context->queries()->whereMonth('created_at', $now->month)->count(),
                $context->queries()->whereMonth('created_at', $lastMonth->month)->count()
            ),
            
            'pending_claims' => $context->claims()->whereIn('status', ['pending', 'submitted'])->count(),
            'claims_trend' => $this->calculateTrend(
                $context->claims()->whereMonth('created_at', $now->month)->count(),
                $context->claims()->whereMonth('created_at', $lastMonth->month)->count()
            ),
            
            'upcoming_renewals' => $context->renewals()->where('status', 'pending')->whereDate('expiry_date', '>=', $now)->count(),
        ];

        // 2. Executive Insights (Premium Intelligence)
        $executive_briefs = collect();
        
        if ($stats['open_queries'] > 5) {
            $executive_briefs->push([
                'title' => 'High Query Volume',
                'message' => 'Incoming communication is trending above average. Consider reallocating staff resources to the query desk.',
                'type' => 'warning',
                'id' => 'brief_queries'
            ]);
        }

        if ($stats['pending_claims'] > 3) {
            $executive_briefs->push([
                'title' => 'Claim Pulse Detected',
                'message' => 'Multiple cases are awaiting resolution. Early intervention today will improve weekly resolution rates.',
                'type' => 'info',
                'id' => 'brief_claims'
            ]);
        }

        $upcoming_renewals_seven_days = $context->renewals()
            ->where('status', 'pending')
            ->whereBetween('expiry_date', [$now->copy()->startOfDay(), $now->copy()->addDays(7)->endOfDay()])
            ->count();

        if ($upcoming_renewals_seven_days > 0) {
            $executive_briefs->push([
                'title' => 'Renewal Alert',
                'message' => "{$upcoming_renewals_seven_days} renewals approaching in the next 7 days.",
                'type' => 'success',
                'id' => 'brief_renewals'
            ]);
        }

        // Add Birthdays and Anniversaries to Velora Intelligence
        $today_birthdays = collect();
        
        $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(fn($c) => $today_birthdays->push($c->name));
        $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(fn($s) => $today_birthdays->push($s->name));
        if ($context->dob && \Carbon\Carbon::parse($context->dob)->isBirthday()) {
            $today_birthdays->push("You (Admin)");
        }
        $context->clients()->whereMonth('marriage_anniversary', $now->month)->whereDay('marriage_anniversary', $now->day)->get()->each(fn($c) => $today_birthdays->push($c->name . " (Anniv.)"));

        if ($today_birthdays->count() > 0) {
            $executive_briefs->push([
                'title' => 'Celebration Milestone',
                'message' => "It's " . $today_birthdays->implode(', ') . "'s special day! Reach out to celebrate.",
                'type' => 'brand',
                'id' => 'brief_birthdays'
            ]);
        }

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

        $urgent_renewals = $context->renewals()->with('client')->where('status', 'pending')->whereDate('expiry_date', '<=', $now)->latest()->get()->map(function($r) {
            $r->type = 'Renewal';
            $r->color = 'emerald';
            $r->url = route('renewals.index');
            return $r;
        });

        $urgent_items = $urgent_queries->concat($urgent_claims)->concat($urgent_renewals)->sortByDesc('created_at')->take(8);

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
                'color' => 'indigo',
                'name' => $client->name,
                'phone' => $client->phone
            ]);
        });

        // Add Anniversaries to Calendar
        $context->clients()->whereNotNull('marriage_anniversary')->get()->each(function($client) use ($calendar_events) {
            $ann = \Carbon\Carbon::parse($client->marriage_anniversary);
            $calendar_events->push([
                'day' => (int)$ann->day,
                'month' => (int)$ann->month,
                'type' => 'anniversary',
                'title' => "{$client->name}'s Anniversary",
                'color' => 'pink',
                'name' => $client->name,
                'phone' => $client->phone
            ]);
        });

        // Add Staff Birthdays to Calendar
        $context->staff()->whereNotNull('dob')->get()->each(function($staff) use ($calendar_events) {
            $dob = \Carbon\Carbon::parse($staff->dob);
            $calendar_events->push([
                'day' => (int)$dob->day,
                'month' => (int)$dob->month,
                'type' => 'birthday',
                'title' => "Staff Birthday: {$staff->name}",
                'color' => 'indigo',
                'name' => $staff->name,
                'phone' => $staff->phone
            ]);
        });

        // Add Advisor Birthday to Calendar
        if ($context->dob) {
            $dob = \Carbon\Carbon::parse($context->dob);
            $calendar_events->push([
                'day' => (int)$dob->day,
                'month' => (int)$dob->month,
                'type' => 'birthday',
                'title' => "Team Birthday: {$context->name}",
                'color' => 'indigo',
                'name' => $context->name,
                'phone' => $context->phone
            ]);
        }


        $birthdays = $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get();
        
        // Add current staff birthdays to today's list
        $staff_birthdays = $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get();
        foreach($staff_birthdays as $sb) {
            $sb->type = 'Staff';
            $birthdays->push($sb);
        }

        // Add current admin birthday to today's list
        if ($context->dob && \Carbon\Carbon::parse($context->dob)->isBirthday()) {
            $birthdays->push((object)[
                'name' => $context->name,
                'type' => 'Admin'
            ]);
        }
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

        return view('dashboard', compact('stats', 'chartData', 'urgent_items', 'birthdays', 'calendar_events', 'upcoming_birthdays', 'executive_briefs'));
    }

    private function calculateTrend($current, $previous)
    {
        if ($previous == 0) return $current > 0 ? 100 : 0;
        return round((($current - $previous) / $previous) * 100);
    }
}
