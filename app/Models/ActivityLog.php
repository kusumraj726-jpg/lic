<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'context_id',
        'action',
        'target_type',
        'target_id',
        'description',
        'metadata',
        'ip_address'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function context()
    {
        return $this->belongsTo(User::class, 'context_id');
    }

    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('context_id', $tenantId);
    }

    public function scopeStaffLogs($query)
    {
        return $query->whereHas('user', function($q) {
            $q->where('role', 'staff');
        });
    }

    public function scopeAdminLogs($query)
    {
        return $query->whereHas('user', function($q) {
            $q->whereIn('role', ['admin', 'advisor']);
        });
    }
}
