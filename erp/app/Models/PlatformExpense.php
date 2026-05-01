<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformExpense extends Model
{
    protected $fillable = ['service_name', 'amount', 'billing_date', 'notes'];

    protected $casts = [
        'billing_date' => 'date',
    ];
}
