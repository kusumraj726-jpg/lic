<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('created', "New " . class_basename($model) . " record created.");
        });

        static::updated(function ($model) {
            $model->logActivity('updated', "Existing " . class_basename($model) . " record modified.");
        });

        static::deleted(function ($model) {
            $action = method_exists($model, 'isForceDeleting') && $model->isForceDeleting() ? 'permanently_deleted' : 'deleted';
            $model->logActivity($action, class_basename($model) . " record moved to trash.");
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->logActivity('restored', class_basename($model) . " record restored from trash.");
            });
        }
    }

    public function logActivity($action, $description = null)
    {
        $user = auth()->user();
        if (!$user) return; // Skip if no user (e.g., console)

        ActivityLog::create([
            'user_id' => $user->id,
            'context_id' => $user->context()->id,
            'action' => $action,
            'target_type' => get_class($this),
            'target_id' => $this->id,
            'description' => $description,
            'metadata' => [
                'attributes' => $this->getAttributes(),
                'changes' => $this->getChanges(),
            ],
            'ip_address' => Request::ip(),
        ]);
    }
}
