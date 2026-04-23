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
        $cacheKey = "nexorabyte_stats_{$context->id}";
        $now = \Carbon\Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $lastMonth = $now->copy()->subMonth();

        // 1 & 2. Stats and Briefs (Cached for 10 mins)
        $data = \Cache::remember($cacheKey, 600, function() use ($context, $now, $lastMonth, $startOfMonth) {
            
            // Core Statistics 
            $currentClients = $context->clients()->count();
            $prevClients = $context->clients()->whereDate('created_at', '<', $startOfMonth)->count();
            
            $queryCounts = $context->queries()
                ->selectRaw("count(case when status in ('pending', 'open', 'in-progress') then 1 end) as open")
                ->selectRaw("count(case when month(created_at) = ? then 1 end) as current_month", [$now->month])
                ->selectRaw("count(case when month(created_at) = ? then 1 end) as last_month", [$lastMonth->month])
                ->first();

            $claimCounts = $context->claims()
                ->selectRaw("count(case when status in ('pending', 'submitted') then 1 end) as pending")
                ->selectRaw("count(case when month(created_at) = ? then 1 end) as current_month", [$now->month])
                ->selectRaw("count(case when month(created_at) = ? then 1 end) as last_month", [$lastMonth->month])
                ->first();

            $stats = [
                'clients_count' => $currentClients,
                'clients_trend' => $this->calculateTrend($currentClients, $prevClients),
                'open_queries' => $queryCounts->open ?? 0,
                'queries_trend' => $this->calculateTrend($queryCounts->current_month ?? 0, $queryCounts->last_month ?? 0),
                'pending_claims' => $claimCounts->pending ?? 0,
                'claims_trend' => $this->calculateTrend($claimCounts->current_month ?? 0, $claimCounts->last_month ?? 0),
                'upcoming_renewals' => $context->renewals()->where('status', 'pending')->whereDate('expiry_date', '>=', $now)->count(),
                'total_expected_comm' => $context->commissions()->where('status', 'pending')->sum('expected_amount'),
                'received_comm_month' => $context->commissions()->where('status', 'received')->whereMonth('received_at', $now->month)->sum('received_amount'),
            ];

            // Briefs
            $executive_briefs = collect();
            if ($stats['open_queries'] > 5) $executive_briefs->push(['title' => 'High Query Volume', 'message' => 'Incoming communication is trending above average. Consider reallocating staff resources.', 'type' => 'warning', 'id' => 'brief_queries']);
            if ($stats['pending_claims'] > 3) $executive_briefs->push(['title' => 'Claim Pulse Detected', 'message' => 'Multiple cases are awaiting resolution. Early intervention today will improve weekly resolution rates.', 'type' => 'info', 'id' => 'brief_claims']);
            
            $renewalsSevenDays = $context->renewals()->where('status', 'pending')->whereBetween('expiry_date', [$now->copy()->startOfDay(), $now->copy()->addDays(7)->endOfDay()])->count();
            if ($renewalsSevenDays > 0) $executive_briefs->push(['title' => 'Renewal Alert', 'message' => "{$renewalsSevenDays} renewals approaching in the next 7 days.", 'type' => 'success', 'id' => 'brief_renewals']);

            // Chart Data
            $sixMonthsAgo = $now->copy()->subMonths(5)->startOfMonth();
            $queryChart = $context->queries()->where('created_at', '>=', $sixMonthsAgo)->selectRaw("count(*) as count, DATE_FORMAT(created_at, '%b') as month, MONTH(created_at) as month_num")->groupBy('month', 'month_num')->orderBy('month_num')->get()->pluck('count', 'month');
            $claimChart = $context->claims()->where('created_at', '>=', $sixMonthsAgo)->selectRaw("count(*) as count, DATE_FORMAT(created_at, '%b') as month, MONTH(created_at) as month_num")->groupBy('month', 'month_num')->orderBy('month_num')->get()->pluck('count', 'month');
            $months = collect(range(5, 0))->map(fn($i) => $now->copy()->subMonths($i)->format('M'));
            $chartData = ['labels' => $months, 'queries' => $months->map(fn($m) => $queryChart->get($m, 0)), 'claims' => $months->map(fn($m) => $claimChart->get($m, 0))];

            // Forecast
            $forecastMonths = collect(range(0, 11))->map(fn($i) => $now->copy()->addMonths($i)->format('M y'));
            $rates = $context->commission_rates ?? ['default' => 15];
            $futureRenewals = $context->renewals()->whereBetween('expiry_date', [$now->copy()->startOfMonth(), $now->copy()->addMonths(11)->endOfMonth()])->get()->groupBy(fn($r) => \Carbon\Carbon::parse($r->expiry_date)->format('M y'));
            $forecastData = $forecastMonths->map(function ($m) use ($futureRenewals, $rates) {
                return $futureRenewals->get($m, collect())->sum(fn($r) => ($r->premium_amount * ($rates[strtolower($r->policy_type)] ?? ($rates['default'] ?? 15))) / 100);
            });

            return compact('stats', 'executive_briefs', 'chartData', 'forecastMonths', 'forecastData');
        });

        // 3. Dynamic Data (Always Fresh)
        $urgent_queries = $context->queries()->with('client')->whereIn('status', ['pending', 'open', 'in-progress'])->latest()->take(5)->get()->map(function($q) {
            $q->type = 'Query'; $q->color = 'rose'; $q->url = route('queries.index', ['id' => $q->id]); return $q;
        });

        $urgent_claims = $context->claims()->with('client')->whereIn('status', ['pending', 'submitted'])->latest()->take(5)->get()->map(function($c) {
            $c->type = 'Claim'; $c->color = 'amber'; $c->url = route('claims.index', ['id' => $c->id]); return $c;
        });

        $urgent_renewals = $context->renewals()->with('client')->where('status', 'pending')->whereDate('expiry_date', '<=', $now)->latest()->take(5)->get()->map(function($r) {
            $r->type = 'Renewal'; $r->color = 'emerald'; $r->url = route('renewals.index'); return $r;
        });

        $urgent_commissions = $context->commissions()->with('client')->where('status', '!=', 'received')->latest()->take(5)->get()->map(function($c) {
            $c->type = 'Commission'; $c->color = 'fuchsia'; $c->url = route('commissions.index'); return $c;
        });

        $urgent_items = $urgent_queries->concat($urgent_claims)->concat($urgent_renewals)->concat($urgent_commissions)->sortByDesc('created_at')->take(8);

        // 4. Birthdays & Events (Optimized DB Query)
        $targetMonths = [$now->month, $now->copy()->addMonth()->month];
        $calendar_events = collect();
        $context->clients()->whereIn(\DB::raw('MONTH(dob)'), $targetMonths)->select('name', 'phone', 'dob')->get()->each(function($c) use ($calendar_events) {
            $dob = \Carbon\Carbon::parse($c->dob); $calendar_events->push(['day' => (int)$dob->day, 'month' => (int)$dob->month, 'type' => 'birthday', 'title' => 'Birthday', 'message' => "Today is {$c->name}'s birthday!", 'color' => 'indigo', 'name' => $c->name, 'phone' => $c->phone]);
        });
        $context->clients()->whereIn(\DB::raw('MONTH(marriage_anniversary)'), $targetMonths)->select('name', 'phone', 'marriage_anniversary')->get()->each(function($c) use ($calendar_events) {
            $ann = \Carbon\Carbon::parse($c->marriage_anniversary); $calendar_events->push(['day' => (int)$ann->day, 'month' => (int)$ann->month, 'type' => 'anniversary', 'title' => 'Anniversary', 'message' => "Today is {$c->name}'s anniversary!", 'color' => 'pink', 'name' => $c->name, 'phone' => $c->phone]);
        });

        $birthdays = $context->clients()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get();
        $context->staff()->whereMonth('dob', $now->month)->whereDay('dob', $now->day)->get()->each(function($s) use ($birthdays) {
            $s->type = 'Staff'; $birthdays->push($s);
        });

        $upcoming_birthdays = $context->clients()->whereBetween(\DB::raw("DATE_FORMAT(dob, '%m-%d')"), [$now->copy()->addDay()->format('m-d'), $now->copy()->addDays(7)->format('m-d')])->orderByRaw("MONTH(dob), DAY(dob)")->take(3)->get();

        $revenueForecast = ['labels' => $data['forecastMonths'], 'data' => $data['forecastData']];
        $birthday_template = $user->birthday_template ?? "Happy Birthday, [NAME]! 🎂 - Best regards, " . ($user->company_name ?? $user->name);
        $anniversary_template = $user->anniversary_template ?? "Happy Anniversary, [NAME]! 🥂 - Regards, " . ($user->company_name ?? $user->name);

        return view('dashboard', array_merge($data, compact('urgent_items', 'birthdays', 'calendar_events', 'upcoming_birthdays', 'birthday_template', 'anniversary_template', 'revenueForecast')));
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
