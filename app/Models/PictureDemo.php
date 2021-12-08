<?php

namespace App\Models;

use App\Casts\ImageUrlByDisk;

class PictureDemo extends BaseModel
{
    protected $table = 'picture_demos';

    protected $fillable = ['disk', 'path'];

    protected $dates = [];

    protected $casts = [
        'path' => ImageUrlByDisk::class
    ];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
