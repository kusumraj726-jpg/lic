<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudioInquiry extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'service', 'message', 'status', 'internal_notes'];
}
