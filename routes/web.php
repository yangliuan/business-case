<?php

use App\Http\Controllers\ViewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/test', [ViewController::class,'testEcho']);
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/excel', function () {
        return Inertia::render('Excel');
    })->name('excel');

    Route::get('/image', function () {
        return Inertia::render('Image');
    })->name('image');

    Route::get('/image-compress', function () {
        return Inertia::render('ImageCompress');
    })->name('image-compress');

    Route::get('/image-thumbnail', function () {
        return Inertia::render('ImageThumbnail');
    })->name('image-thumbnail');

    Route::get('/image-convert', function () {
        return Inertia::render('ImageConvert');
    })->name('image-convert');

    Route::get('/word', function () {
        return Inertia::render('Word');
    })->name('word');
});
