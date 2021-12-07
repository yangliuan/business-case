<?php

namespace App\Http\Controllers\FilesCase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AliyunOssController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file'=>'bail|required|file',
        ]);
        $path = 'test/'.date('Y-m-d');
        $res = Storage::disk('oss')->put($path, $request->file('file'));

        dd($res);
    }
}
