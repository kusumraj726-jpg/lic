<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        // 1. Fetch all relevant users
        $tenants = User::whereIn('role', ['admin', 'superadmin'])->get();

        // 2. Safe Stats Calculation
        $stats = [
            'total'   => $tenants->where('role', 'admin')->count(),
            'active'  => 0,
            'expired' => 0,
            'monthly_mrr'   => 0,
            'yearly_arr'    => 0,
            'trial_revenue' => 0,
            'total_revenue' => 0,
        ];

        foreach ($tenants as $tenant) {
            if ($tenant->role !== 'admin') continue;

            $isActive = $tenant->hasActiveSubscription();
            
            if ($isActive) {
                $stats['active']++;
                // Add to revenue based on plan
                if ($tenant->subscription_plan === 'monthly') $stats['monthly_mrr'] += 1999;
                if ($tenant->subscription_plan === 'yearly') $stats['yearly_arr'] += 14999;
                if ($tenant->subscription_plan === 'trial') $stats['trial_revenue'] += 0;
            } else {
                $stats['expired']++;
            }
        }

        $stats['total_revenue'] = $stats['monthly_mrr'] + $stats['yearly_arr'] + $stats['trial_revenue'];

        $inquiries = \App\Models\StudioInquiry::latest()->get();

        return view('superadmin.index', compact('tenants', 'stats', 'inquiries'));
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
