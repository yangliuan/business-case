<?php

namespace App\Http\Controllers\FilesCase;

use App\Http\Controllers\Controller;
use App\Models\PictureDemo;
use Illuminate\Http\Request;

class UrlHandleController extends Controller
{
    public function index(Request $request)
    {
        $pic_demos = PictureDemo::get();
        $image_demos = PictureDemo::get();

        return compact('pic_demos', 'image_demos');
    }

    public function store(Request $request)
    {
    }
}
