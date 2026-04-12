<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        // All admin/superadmin tenants (not staff)
        $tenants = User::whereIn('role', ['admin', 'superadmin'])
            ->orderByDesc('created_at')
            ->get();

        // Revenue calculation
        $activeMonthly = $tenants->where('subscription_status', 'active')->where('subscription_plan', 'monthly')->count();
        $activeYearly  = $tenants->where('subscription_status', 'active')->where('subscription_plan', 'yearly')->count();
        $activeTrial   = $tenants->where('subscription_status', 'active')->where('subscription_plan', 'trial')->count();

        $stats = [
            'total'           => $tenants->where('role', 'admin')->count(),
            'active'          => $tenants->filter(fn($u) => $u->hasActiveSubscription() && $u->role === 'admin')->count(),
            'expired'         => $tenants->where('role', 'admin')->filter(fn($u) => !$u->hasActiveSubscription())->count(),
            'monthly_mrr'     => $activeMonthly * 999,
            'yearly_arr'      => $activeYearly * 9990,
            'trial_revenue'   => $activeTrial * 99,
        ];

        $stats['total_revenue'] = $stats['monthly_mrr'] + $stats['yearly_arr'] + $stats['trial_revenue'];

        return view('superadmin.index', compact('tenants', 'stats'));
    }

    public function toggleStatus(Request $request, User $user)
    {
        if ($user->role === 'superadmin') {
            return back()->with('error', 'Cannot modify superadmin account.');
        }

        if ($user->subscription_status === 'active') {
            $user->subscription_status = 'inactive';
        } else {
            $user->subscription_status = 'active';
            if (!$user->subscription_ends_at || $user->subscription_ends_at->isPast()) {
                $user->subscription_ends_at = now()->addDays(30);
            }
        }

        $user->save();
        return back()->with('success', "Account for {$user->company_name} has been updated.");
    }
}
