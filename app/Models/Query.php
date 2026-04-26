<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\BelongsToTenant;

class Query extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant, \App\Traits\LogsActivity;
    protected $fillable = ['user_id', 'client_id', 'subject', 'description', 'priority', 'status', 'document'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function getDocumentUrlAttribute(): ?string
    {
        if (!$this->document) return null;
        $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
        return \Illuminate\Support\Facades\Storage::disk($disk)->url($this->document);
    }
}
