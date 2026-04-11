<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\BelongsToTenant;

class Query extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['user_id', 'client_id', 'subject', 'description', 'priority', 'status', 'document'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
