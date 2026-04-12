<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Block registration if payment has not been completed first
        if (!session('velora_payment_done')) {
            return redirect()->route('get.started')->with('error', 'Please complete payment first to create your account.');
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Generate unique Admin ID (e.g., NX-ADM-0001)
        $lastAdmin = User::where('unique_id', 'like', 'NX-ADM-%')->latest('id')->first();
        $nextId = 1;
        if ($lastAdmin) {
            $lastIdNumber = (int) str_replace('NX-ADM-', '', $lastAdmin->unique_id);
            $nextId = $lastIdNumber + 1;
        }
        $uniqueId = 'NX-ADM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        $plan = session('velora_payment_plan', 'monthly');
        $daysToAdd = match($plan) {
            'trial'  => 60,
            'yearly' => 365,
            default  => 30,
        };

        $user = User::create([
            'company_name'        => $request->company_name,
            'name'                => $request->name,
            'email'               => $request->email,
            'password'            => Hash::make($request->password),
            'role'                => 'admin',
            'unique_id'           => $uniqueId,
            'subscription_status' => 'active',
            'subscription_plan'   => $plan,
            'subscription_ends_at'=> now()->addDays($daysToAdd),
        ]);

        event(new Registered($user));

        // If an admin is creating a staff member from within the portal (already logged in)
        if (Auth::check()) {
            return back()->with('success', "Account created successfully with ID: {$uniqueId}");
        }

        // Clear the one-time payment session so the same payment cannot be reused
        session()->forget(['velora_payment_done', 'velora_payment_plan', 'velora_payment_id', 'velora_payment_order_id']);

        // Don't auto-login — redirect to login page so they can consciously log in
        return redirect()->route('login')->with('status', 'Registration complete! Please login to access your workspace.');
    }
}
