<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // If the user is a staff member, check their profile status
            if ($user->isStaff()) {
                $staff = $user->linkedStaffProfile;
                if (!$staff || $staff->status !== 'active') {
                    \Illuminate\Support\Facades\Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('login')->with('error', 'Your account is currently locked or inactive.');
                }
            }
        }

        return $next($request);
    }
}
