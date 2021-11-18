<?php

namespace App\Http\Controllers\FilesCase;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function upload(Request $request)
    {
        $subpath = date('Ymd');
        $disk = $request->input('disk') ?? config('filesystems.default');
        $storage = Storage::disk($disk);

        try {
            if ($savePath = $storage->put($subpath, $request->file('file'), 'public')) {
                return response()->json(['url' => $storage->url($savePath), 'path' => $savePath]);
            }
        } catch (\Throwable $th) {
            throw ValidationException::withMessages(['file' => [$th->getMessage()]]);
        }
    }
}
