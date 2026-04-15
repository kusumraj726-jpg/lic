<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\BelongsToTenant;

class Client extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant, \App\Traits\LogsActivity;
    protected $fillable = ['user_id', 'name', 'email', 'dob', 'gender', 'phone', 'address', 'marriage_anniversary', 'photo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function queries()
    {
        return $this->hasMany(Query::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function renewals()
    {
        return $this->hasMany(Renewal::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
}
