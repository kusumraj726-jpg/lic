<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // If the user has an active subscription, let them proceed
        if ($user && $user->hasActiveSubscription()) {
            return $next($request);
        }

        // If inactive, check their role
        if ($user->isAdvisor()) {
            // Allow them to visit the billing page
            return redirect()->route('billing.index');
        }

        // For staff, they can't pay, so show a suspended message
        if ($user->isStaff()) {
            Auth::logout();
            return redirect()->away('https://nexorabyte.in/login')->withErrors([
                'email' => 'Your organization\'s workspace is currently suspended. Please contact your administrator.'
            ]);
        }

        return $next($request);
    }
}
