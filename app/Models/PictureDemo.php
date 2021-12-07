<?php

namespace App\Models;

class PictureDemo extends BaseModel
{
    protected $table = 'picture_demos';

    protected $fillable = ['disk', 'path'];

    protected $dates = [];

    protected $casts = [];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
