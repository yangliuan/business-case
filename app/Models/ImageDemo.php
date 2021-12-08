<?php

namespace App\Models;

class ImageDemo extends BaseModel
{   
    protected $table = 'image_demos';

    protected $fillable = ['path'];

    protected $dates = [];

    protected $casts = [];

    protected $appends = [];

    protected $hidden = [
        'pivot'
    ];
}
