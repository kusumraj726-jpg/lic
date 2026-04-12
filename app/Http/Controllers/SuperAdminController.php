<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SuperAdminController extends Controller
{
    public function index()
    {
        try {
            $count = User::count();
            return "Control Panel Debug: Connection OK. Total Users: " . $count;
        } catch (\Exception $e) {
            return "Database Error: " . $e->getMessage();
        }
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
