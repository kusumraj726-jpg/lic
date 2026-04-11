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

        $user = User::create([
            'company_name' => $request->company_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'unique_id' => $uniqueId,
        ]);

        event(new Registered($user));

        // If an admin is creating another admin, don't log them out.
        if (Auth::check()) {
            return back()->with('success', "Admin account created successfully with ID: {$uniqueId}");
        }

        // Auth::login($user);

        return redirect(route('login'))->with('status', 'Registration successful! Please login.');
    }
}
