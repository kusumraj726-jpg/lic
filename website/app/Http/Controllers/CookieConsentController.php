<?php

namespace App\Http\Controllers;

use App\Models\CookieConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $token = Str::uuid();

        CookieConsent::create([
            'consent_token' => $token,
            'status' => $request->status,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Set cookie for 1 year
        return response()->json(['success' => true])
            ->withCookie(cookie()->forever('cookie-consent', $request->status))
            ->withCookie(cookie()->forever('cookie-consent-token', $token));
    }
}
