<?php

namespace App\Models;

use App\Casts\ImageUrlDefault;

class PictureDemo extends BaseModel
{
    protected $table = 'picture_demos';

    protected $fillable = ['disk', 'path'];

    protected $dates = [];

    protected $casts = [
        'path' => ImageUrlDefault::class
    ];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
