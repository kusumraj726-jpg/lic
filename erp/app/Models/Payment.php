<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'razorpay_order_id', 'razorpay_payment_id', 'amount', 'plan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
