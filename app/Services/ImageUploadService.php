<?php

namespace App\Services;

class ImageUploadService
{
    public static function upload($img): string
    {
        $imageName = time().'.'.$img->extension();
        $img->move(public_path('images'), $imageName);
        return 'images/' . $imageName;
    }
}
