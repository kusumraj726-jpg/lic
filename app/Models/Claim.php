<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\BelongsToTenant;

class Claim extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant, \App\Traits\LogsActivity;
    protected $fillable = ['user_id', 'client_id', 'policy_number', 'policy_type', 'claim_amount', 'custom_commission_rate', 'incident_date', 'status', 'description'];
    protected $casts = ['incident_date' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
