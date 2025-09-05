<?php

namespace App\Traits;


//trait to save image in folder written by abed
 trait UploadImageTrait
 {

   protected function saveImages($photo, $folder)
    {
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }

 }