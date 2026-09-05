<?php

namespace App\Traits\Models;



trait HandlesImages
{
    /**
     * Boot the trait to handle image deletion on force delete.
     */
    protected static function bootHandlesImages()
    {
        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && $model->isForceDeleting()) {
                $imageService = app(\App\Services\ImageService::class);

                $folder = $model->imageFolder ?? 'products';

                foreach ($model->images as $image) {
                    $imageService->deleteImage($image->url, $folder);
                    $image->delete();
                }
            }
        });
    }
}
