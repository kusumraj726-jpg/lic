<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudioInquiry;
use App\Models\Payment;
use App\Models\PlatformExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
        $tenants = User::where('role', 'admin')->get()->map(function($tenant) {
            $tenant->stats = [
                'clients' => \DB::table('clients')->where('user_id', $tenant->id)->count(),
                'staff'   => \DB::table('staff')->where('advisor_id', $tenant->id)->count(),
                'queries' => \DB::table('queries')->where('user_id', $tenant->id)->count(),
            ];
            return $tenant;
        });

        $stats = [
            'total'   => $tenants->count(),
            'active'  => 0,
            'expired' => 0,
            'monthly_mrr'   => 0,
            'yearly_arr'    => 0,
            'total_revenue' => Payment::where('status', 'success')->sum('amount'),
            'total_expenses' => PlatformExpense::sum('amount'),
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

        return view('superadmin.index', compact('tenants', 'stats'));
    }

    public function transactions()
    {
        $payments = Payment::with('user')->latest()->get();
        return view('superadmin.transactions', compact('payments'));
    }

    public function expenses()
    {
        $expenses = PlatformExpense::latest()->get();
        return view('superadmin.expenses', compact('expenses'));
    }

    public function storeExpense(Request $request)
    {
        $validated = $request->validate([
            'service_name' => 'required|string',
            'amount' => 'required|numeric',
            'billing_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        PlatformExpense::create($validated);
        return back()->with('success', "Expense for {$validated['service_name']} logged.");
    }

    public function deleteExpense(PlatformExpense $expense)
    {
        $expense->delete();
        return back()->with('success', "Expense record deleted.");
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
        $inquiry->delete();
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
