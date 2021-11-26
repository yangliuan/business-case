<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait SaveBase64Image
{
    public function save(string $imgBase64String)
    {
        $imgBase64String = str_replace('data:image/jpeg;base64,', '', $imgBase64String);

        $imgBase64String = preg_replace("/\r\n/", "", $imgBase64String);

        $fileName = time() . '.jpg';

        $savePath = storage_path('app/public/' . $fileName);

        Image::make($imgBase64String)->save($savePath, 75, 'jpg');

        return asset('storage/' . $fileName);
    }
}
