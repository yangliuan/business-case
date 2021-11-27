<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilesCase\UploadsController;
use App\Http\Controllers\ExcelCase\ExportController;
use App\Http\Controllers\FilesCase\DownloadController;
use App\Http\Controllers\ImageCase\InterventionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('files')->group(function () {
    Route::post('upload', [UploadsController::class,'upload']);//上传文件
    Route::get('download', [DownloadController::class,'store']);//下载文件
});
Route::prefix('excel')->group(function () {
    Route::prefix('export')->group(function () {
        Route::any('download', [ExportController::class,'download']);//下载导出
        Route::any('store', [ExportController::class,'storeDisk']);//存储到磁盘
        Route::any('queue', [ExportController::class,'queue']);//队列导出
        Route::any('download-sheets', [ExportController::class,'downloadMutilSheet']);//导出多个工作表
        Route::any('download-images', [ExportController::class,'downloadImages']);//下载导出图片
        Route::any('queue-images', [ExportController::class,'queueImages']);//队列导出图片并发送广播
        Route::any('test', [ExportController::class,'test']);
    });
    Route::prefix('import')->group(function () {
    });
});
Route::prefix('image')->group(function () {
    Route::group(['prefix' => 'intervertion'], function () {
        Route::any('water-marker', [InterventionController::class,'waterMarker']);//生成水印
        Route::any('picword-watermark', [InterventionController::class,'picwordWatermark']);//图文混合水印
        Route::any('drawtext', [InterventionController::class,'drawText']);//基于背景图片添加图片和文字绘制,海报
        Route::any('mask-cut-round', [InterventionController::class,'maskCutRound']);//使用图层蒙版裁切成圆形,其它图形原理相同
        Route::any('draw-graphics', [InterventionController::class,'drawGraphics']);//海报绘制圆形头像
        Route::any('response-img', [InterventionController::class,'responseImg']);//绘制图形并响应为图片
        Route::any('tile', [InterventionController::class,'tile']);//平铺填充图片
        Route::any('readbase64', [InterventionController::class,'readBase64']);//读取base64格式图片
        Route::any('compress', [InterventionController::class,'compress']);//压缩图片
        Route::any('thumbnail', [InterventionController::class,'thumbnail']);//缩略图
        Route::any('convert', [InterventionController::class,'convert']);//转换为webp
    });
});
