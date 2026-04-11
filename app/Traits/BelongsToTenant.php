<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToTenant
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::addGlobalScope('tenant_isolation', function (Builder $builder) {
            if (auth()->check()) {
                $user = auth()->user();
                $context = $user->context();
                
                // If it is a User model being isolated, we use id. 
                // Otherwise we use user_id or advisor_id based on convention.
                if (static::class === User::class) {
                    $builder->where('id', $context->id)
                            ->orWhere('role', 'superadmin'); // Allow SuperAdmin to see all if we have one
                } else {
                    $column = (new static)->getTable() === 'staff' ? 'advisor_id' : 'user_id';
                    $builder->where($column, $context->id);
                }
            }
        });

        static::creating(function (Model $model) {
            if (auth()->check()) {
                $context = auth()->user()->context();
                $column = $model->getTable() === 'staff' ? 'advisor_id' : 'user_id';
                
                if (!$model->$column) {
                    $model->$column = $context->id;
                }
            }
        });
    }
}
