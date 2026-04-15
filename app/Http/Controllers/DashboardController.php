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
            
            'total_expected_comm' => $context->commissions()->where('status', 'pending')->sum('expected_amount'),
            'received_comm_month' => $context->commissions()->where('status', 'received')->whereMonth('received_at', $now->month)->sum('received_amount'),
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

        // Add Birthdays to Velora Intelligence
        $today_birthdays = collect();
        $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(fn($c) => $today_birthdays->push($c->name));
        $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(fn($s) => $today_birthdays->push($s->name));
        if ($context->dob && \Carbon\Carbon::parse($context->dob)->isBirthday()) {
            $today_birthdays->push("You (Admin)");
        }

        if ($today_birthdays->count() > 0) {
            $executive_briefs->push([
                'title' => 'Birthday',
                'message' => "Today is " . $today_birthdays->implode(', ') . "'s birthday! Send a gift or greeting.",
                'type' => 'brand',
                'id' => 'brief_birthdays'
            ]);
        }

        // Add Anniversaries to Velora Intelligence
        $today_anniversaries = collect();
        $context->clients()->whereMonth('marriage_anniversary', $now->month)->whereDay('marriage_anniversary', $now->day)->get()->each(fn($c) => $today_anniversaries->push($c->name));

        if ($today_anniversaries->count() > 0) {
            $executive_briefs->push([
                'title' => 'Anniversary',
                'message' => "Today is " . $today_anniversaries->implode(', ') . "'s anniversary! Send a flower or greeting.",
                'type' => 'brand',
                'id' => 'brief_anniversaries'
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

        // 3. Financial Forecast (Next 12 Months)
        $forecastMonths = collect(range(0, 11))->map(function ($i) use ($now) {
            return $now->copy()->addMonths($i)->format('M y');
        });

        $rates = $context->commission_rates ?? ['default' => 15];
        $forecastData = collect(range(0, 11))->map(function ($i) use ($context, $now, $rates) {
            $monthStart = $now->copy()->addMonths($i)->startOfMonth();
            $monthEnd = $now->copy()->addMonths($i)->endOfMonth();
            
            $renewals = $context->renewals()
                ->whereBetween('expiry_date', [$monthStart, $monthEnd])
                ->get();
            
            return $renewals->sum(function($r) use ($rates) {
                $type = strtolower($r->policy_type);
                $rate = $rates[$type] ?? ($rates['default'] ?? 15);
                return ($r->premium_amount * $rate) / 100;
            });
        });

        $revenueForecast = [
            'labels' => $forecastMonths,
            'data' => $forecastData
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
                'title' => 'Birthday',
                'message' => "Today is {$client->name}'s birthday! Send a gift or greeting.",
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
                'title' => 'Anniversary Milestone',
                'message' => "Today is {$client->name}'s marriage anniversary! Send a flower or greeting.",
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
                'title' => 'Staff Birthday',
                'message' => "{$staff->name} celebrates their birthday today!",
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
                'title' => 'Personal Milestone',
                'message' => 'Happy Birthday! Wishing you a great day.',
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

        $user = auth()->user();
        $birthday_template = $user->birthday_template ?? "Happy Birthday, [NAME]! 🎂 Wishing you a year filled with happiness and success. - Best regards, " . ($user->company_name ?? $user->name);
        $anniversary_template = $user->anniversary_template ?? "Happy Anniversary, [NAME]! 🥂 Wishing you many more years of love and togetherness. - Regards, " . ($user->company_name ?? $user->name);

        return view('dashboard', compact('stats', 'chartData', 'urgent_items', 'birthdays', 'calendar_events', 'upcoming_birthdays', 'executive_briefs', 'birthday_template', 'anniversary_template', 'revenueForecast'));
    }

    public function updateTemplate(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'type' => 'required|in:birthday,anniversary',
            'template' => 'required|string'
        ]);

        $user = auth()->user();
        if ($request->type === 'birthday') {
            $user->update(['birthday_template' => $request->template]);
        } else {
            $user->update(['anniversary_template' => $request->template]);
        }

        return response()->json(['success' => true, 'message' => 'Template updated successfully!']);
    }

    private function calculateTrend($current, $previous)
    {
        if ($previous == 0) return $current > 0 ? 100 : 0;
        return round((($current - $previous) / $previous) * 100);
    }
}
