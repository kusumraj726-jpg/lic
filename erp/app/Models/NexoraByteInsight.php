<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NexoraByteInsight extends Model
{
    use HasFactory;
    protected $table = 'nexorabyte_insights';

    protected $fillable = ['user_id', 'category', 'content', 'importance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
