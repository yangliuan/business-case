<?php

use App\Http\Controllers\FilesCase\UploadsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('upload', [UploadsController::class,'upload']);
});
Route::prefix('excel')->group(function () {
    Route::post('export', 'ExportController@export');
});
