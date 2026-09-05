<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the trait to handle automatic slug generation.
     */
    protected static function bootHasSlug()
    {
        static::saving(function ($model) {
            $sourceField = $model->slugSource ?? 'name';

            if ($model->isDirty($sourceField)) {
                $model->slug = Str::slug($model->$sourceField);
            }
        });
    }
}
