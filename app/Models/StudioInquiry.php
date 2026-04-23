<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudioInquiry extends Model
{
    protected $fillable = ['name', 'email', 'service', 'message', 'status'];
}
