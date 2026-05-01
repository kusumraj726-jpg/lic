<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
        $middleware->redirectTo(fn () => 'https://nexorabyte.in/login');

        $middleware->web(append: [
            //
        ]);
        $middleware->validateCsrfTokens(except: [
            '/get-started/checkout',
            '/get-started/verify',
        ]);
        $middleware->alias([
            'checkModule'  => \App\Http\Middleware\CheckModuleAccess::class,
            'ensureActive' => \App\Http\Middleware\EnsureUserIsActive::class,
            'subscribed'   => \App\Http\Middleware\EnsureActiveSubscription::class,
            'superadmin'   => \App\Http\Middleware\SuperAdminOnly::class,
            'noDirect'     => \App\Http\Middleware\PreventDirectAccess::class,
            'noCache'      => \App\Http\Middleware\NoCache::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, \Illuminate\Http\Request $request) {
            return redirect()->route('login')->with('error', 'Your session has expired. For security reasons, please log in again to continue.');
        });
    })->create();
