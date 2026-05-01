<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDirectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Get the 'referer' (where the user came from)
        $referer = $request->headers->get('referer');
        $host = $request->getHost();

        // 2. If there is NO referer (Direct Paste / Bookmark)
        // OR the referer is from a DIFFERENT domain (External Link)
        // AND we are not already on the homepage
        if (!$request->is('/') && (!$referer || !str_contains($referer, $host))) {
            
            // Allow login and get-started to be direct-accessed so users can actually enter
            if ($request->is('login') || $request->is('get-started') || $request->is('register')) {
                return $next($request);
            }

            return redirect('/')->with('error', 'Please navigate using the links on the website.');
        }

        return $next($request);
    }
}
