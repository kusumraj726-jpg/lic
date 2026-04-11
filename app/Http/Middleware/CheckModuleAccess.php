<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }


        // If user is staff, check specific module permission
        if ($user->isStaff()) {
            $staff = $user->linkedStaffProfile;
            
            // Check if the permission flag ($module) is false
            if (!$staff || !$staff->$module) {
                \Illuminate\Support\Facades\Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Unauthorized module access attempt detected.');
            }
        }

        return $next($request);
    }
}
