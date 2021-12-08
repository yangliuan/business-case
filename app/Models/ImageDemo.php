<?php

namespace App\Models;

use App\Casts\ImageUrlDefault;

class ImageDemo extends BaseModel
{
    protected $table = 'image_demos';

    protected $fillable = ['path'];

    protected $dates = [];

    protected $casts = [
        'path' => ImageUrlDefault::class
    ];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
