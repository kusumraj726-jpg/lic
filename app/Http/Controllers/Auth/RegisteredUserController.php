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
    public function create(): RedirectResponse|View
    {
        // If someone is already logged in (e.g. superadmin testing), send them to dashboard
        // The only logged-in users allowed to /register are admins creating staff — but that uses a different internal form
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // Block guest registration if payment has not been completed first
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

        // ── PAYMENT FLOW (highest priority) ──────────────────────────────
        // If this registration came from the /get-started payment flow,
        // clear the one-time session immediately — no second account can be made
        if (session('velora_payment_done')) {
            session()->forget([
                'velora_payment_done',
                'velora_payment_plan',
                'velora_payment_id',
                'velora_payment_order_id',
            ]);
            return redirect()->route('login', ['flow' => 'onboarding', 'step' => 3])
                ->with('status', 'Registration complete! Please login to access your workspace.');
        }

        // ── INTERNAL FLOW (admin creating staff from inside portal) ───────
        if (Auth::check()) {
            return back()->with('success', "Account created successfully with ID: {$uniqueId}");
        }

        return redirect()->route('login')
            ->with('status', 'Registration complete! Please login to access your workspace.');
    }
}
