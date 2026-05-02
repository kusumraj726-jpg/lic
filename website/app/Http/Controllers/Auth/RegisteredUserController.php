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
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Log;

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
            return redirect()->intended('https://erp.nexorabyte.in/dashboard');
        }

        // Force payment-first: Redirect to Insurance ERP pricing if no payment done
        if (!session('nexorabyte_payment_done')) {
            return redirect()->route('services.insurance-erp', ['#pricing'])
                ->with('error', 'Please select a plan and complete payment first.');
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

        $plan = session('nexorabyte_payment_plan', 'monthly');
        $daysToAdd = match($plan) {
            'trial'  => 30,
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

        // Send welcome email via Brevo REST API (fast, reliable, no SMTP timeout)
        dispatch(new SendWelcomeEmail($user))->afterResponse();

        // Clear the one-time payment session
        session()->forget([
            'nexorabyte_payment_done',
            'nexorabyte_payment_plan',
            'nexorabyte_payment_id',
            'nexorabyte_payment_order_id',
        ]);

        return redirect()->route('login', ['flow' => 'onboarding', 'step' => 3])
            ->with('status', 'Registration complete! Please login to access your workspace.');
    }
}
