<?php

namespace App\Models;

use App\Casts\ImageUrlDefault;
use App\Casts\ImageUrlGroup;

class ImageDemo extends BaseModel
{
    protected $table = 'image_demos';

    protected $fillable = ['path','path_group'];

    protected $dates = [];

    protected $casts = [
        'path' => ImageUrlDefault::class,
        'path_group' => ImageUrlGroup::class
    ];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
