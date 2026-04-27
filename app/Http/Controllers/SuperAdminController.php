<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudioInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Fetch tenants with their usage stats (simplified)
        $tenants = User::where('role', 'admin')->get()->map(function($tenant) {
            // In a real app, you'd use a more efficient query with counts
            $tenant->stats = [
                'clients' => \DB::table('clients')->where('user_id', $tenant->id)->count(),
                'staff'   => \DB::table('users')->where('advisor_id', $tenant->id)->count(),
                'queries' => \DB::table('queries')->where('user_id', $tenant->id)->count(),
            ];
            return $tenant;
        });

        // Safe Stats Calculation
        $stats = [
            'total'   => $tenants->count(),
            'active'  => 0,
            'expired' => 0,
            'monthly_mrr'   => 0,
            'yearly_arr'    => 0,
            'trial_revenue' => 0,
            'total_revenue' => 0,
        ];

        foreach ($tenants as $tenant) {
            $isActive = $tenant->hasActiveSubscription();
            
            if ($isActive) {
                $stats['active']++;
                if ($tenant->subscription_plan === 'monthly') $stats['monthly_mrr'] += 1999;
                if ($tenant->subscription_plan === 'yearly') $stats['yearly_arr'] += 14999;
            } else {
                $stats['expired']++;
            }
        }

        $stats['total_revenue'] = $stats['monthly_mrr'] + $stats['yearly_arr'];

        return view('superadmin.index', compact('tenants', 'stats'));
    }

    public function inquiries()
    {
        $inquiries = StudioInquiry::latest()->get();
        return view('superadmin.inquiries', compact('inquiries'));
    }

    public function inquiryUpdate(Request $request, StudioInquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,closed',
            'internal_notes' => 'nullable|string',
        ]);

        $inquiry->update($validated);
        return back()->with('success', "Lead for {$inquiry->name} updated successfully.");
    }

    public function inquiryDestroy(StudioInquiry $inquiry)
    {
        $inquiry->delete(); // Soft delete
        return back()->with('success', "Lead moved to trash.");
    }

    public function trash()
    {
        $deletedInquiries = StudioInquiry::onlyTrashed()->latest()->get();
        return view('superadmin.trash', compact('deletedInquiries'));
    }

    public function inquiryRestore($id)
    {
        $inquiry = StudioInquiry::onlyTrashed()->findOrFail($id);
        $inquiry->restore();
        return back()->with('success', "Lead restored.");
    }

    public function inquiryForceDelete($id)
    {
        $inquiry = StudioInquiry::onlyTrashed()->findOrFail($id);
        $inquiry->forceDelete();
        return back()->with('success', "Lead permanently deleted.");
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

    public function impersonate(User $user)
    {
        if (Auth::user()->role !== 'superadmin') abort(403);
        
        session(['impersonated_by' => Auth::id()]);
        Auth::login($user);
        
        return redirect()->route('dashboard')->with('success', "You are now impersonating {$user->name}");
    }

    public function stopImpersonating()
    {
        if (!session()->has('impersonated_by')) return redirect()->route('dashboard');
        
        $adminId = session()->pull('impersonated_by');
        $admin = User::find($adminId);
        Auth::login($admin);
        
        return redirect()->route('superadmin.index')->with('success', "Returned to Master Control.");
    }
}
