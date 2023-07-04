<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
require __DIR__ .'/route-layout.php';
//Upload image in  blog content
Route::post('/blog/media/upload',[\App\Http\Controllers\Controller::class,'mediaUpload'])->name('media.upload');
require __DIR__ .'/categories.php';
require __DIR__ .'/course.php';
require __DIR__ .'/slider.php';
require __DIR__ .'/categories_blog.php';
require __DIR__ .'/blog.php';
require __DIR__ .'/comments.php';
require __DIR__ .'/notify.php';
require __DIR__ .'/tags.php';
require __DIR__ .'/user.php';


