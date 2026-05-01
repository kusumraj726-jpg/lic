<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;
use App\Traits\LogsActivity;

class Commission extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant, LogsActivity;

    protected $fillable = [
        'user_id',
        'client_id',
        'renewal_id',
        'policy_number',
        'provider',
        'expected_amount',
        'received_amount',
        'status',
        'received_at',
        'notes'
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'expected_amount' => 'decimal:2',
        'received_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function renewal()
    {
        return $this->belongsTo(Renewal::class);
    }
}
