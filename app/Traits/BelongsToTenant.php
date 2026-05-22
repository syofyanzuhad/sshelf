<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check()) {
                // Only scope in SaaS mode
                if (config('sshelf.mode') === 'saas') {
                    $builder->where('user_id', auth()->user()->owner()->id);
                }
            }
        });

        static::creating(function ($model) {
            if (auth()->check() && empty($model->user_id)) {
                // Always set user_id to the owner in both modes
                // In self-host, owner() is just the current user
                $model->user_id = auth()->user()->owner()->id;
            }
        });
    }
}
