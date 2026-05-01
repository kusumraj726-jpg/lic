<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // If not logged in or not a superadmin, return a hard 404 (no hints given)
        if (!auth()->check() || auth()->user()->role !== 'superadmin') {
            abort(404);
        }

        return $next($request);
    }
}
