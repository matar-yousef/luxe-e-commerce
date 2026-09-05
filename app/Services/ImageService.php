<?php

namespace App\Services;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function handleImage($file, $folder){
        $filename = time().'-'.$file->getClientOriginalName();
        $fullpath = public_path('images/full/'.$filename);
        $thumbpath = public_path('images/100_100/'.$filename);

        \Image::make($file)->resize(800, null, function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($fullpath);

        \Image::make($file)->fit(100, 100)->save($thumbpath);

        return $filename;
    }

    public function deleteImage($filename, $folder){
        $fullpath = public_path('images/full/'.$filename);
        $thumbpath = public_path('images/100_100/'.$filename);

        if(file_exists($fullpath)) unlink($fullpath);
        if(file_exists($thumbpath)) unlink($thumbpath);
    }
}

        

        

        