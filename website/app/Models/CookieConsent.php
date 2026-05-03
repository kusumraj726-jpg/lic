<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CookieConsent extends Model
{
    protected $fillable = [
        'consent_token',
        'status',
        'ip_address',
        'user_agent',
    ];
}
