<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\BelongsToTenant;

class Renewal extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant, \App\Traits\LogsActivity;
    protected $fillable = ['user_id', 'client_id', 'policy_number', 'policy_type', 'premium_amount', 'custom_commission_rate', 'expiry_date', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    /**
     * Automatically generate or update a commission record for this renewal.
     */
    public function generateCommission()
    {
        $context = $this->user->context();
        $rates = $context->commission_rates ?? [];
        
        // Find matching rate or use default 15%
        $rate = 15; // Default fallback
        
        if ($this->custom_commission_rate !== null) {
            $rate = $this->custom_commission_rate;
        } else {
            $type = strtolower($this->policy_type);
            if (isset($rates[$type])) {
                $rate = $rates[$type];
            } elseif (isset($rates['default'])) {
                $rate = $rates['default'];
            }
        }

        $expected = ($this->premium_amount * $rate) / 100;

        return \App\Models\Commission::updateOrCreate(
            ['renewal_id' => $this->id],
            [
                'user_id' => $this->user_id,
                'client_id' => $this->client_id,
                'policy_number' => $this->policy_number,
                'provider' => $this->policy_type, // Assuming type is the provider or similar
                'expected_amount' => $expected,
                'status' => 'pending'
            ]
        );
    }
}
