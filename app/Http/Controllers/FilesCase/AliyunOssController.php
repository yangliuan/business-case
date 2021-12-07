<?php

namespace App\Http\Controllers\FilesCase;

use App\Http\Controllers\Controller;
use App\Models\PictureDemo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AliyunOssController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'disk'=>'bail|required|in:public,oss',
            'file'=>'bail|required|file',
        ]);
        $path = 'test/'.date('Y-m-d');
        $file_name = Storage::disk($request->input('disk'))->put($path, $request->file('file'));
        $picture_demo = PictureDemo::create([
            'disk'=>$request->input('disk'),
            'path'=>$file_name,
        ]);

        return $picture_demo;
    }
}
