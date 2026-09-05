<?php

namespace App\Traits;

use App\Models\Image;

trait HasImage
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}