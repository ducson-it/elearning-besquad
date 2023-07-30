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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/statistic-business', [App\Http\Controllers\HomeController::class, 'statistic'])->middleware('auth');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web','auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
require __DIR__ .'/route-layout.php';
//Upload image in  blog content

Route::post('/media/upload',[\App\Http\Controllers\Controller::class,'mediaUpload'])->name('media.upload');
//upload sliders
Route::post('/sliders/upload2',[\App\Http\Controllers\Controller::class,'mediaUpload2'])->name('sliders.upload');
//upload file blogs
Route::post('/blogs/upload3',[\App\Http\Controllers\Controller::class,'mediaUpload3'])->name('blogs.upload');


Route::post('/media/upload',[\App\Http\Controllers\Controller::class,'mediaUpload'])->name('media.upload');
require __DIR__ .'/categories.php';
require __DIR__ .'/course.php';
require __DIR__ .'/module.php';
require __DIR__ .'/lessons.php';
require __DIR__ .'/slider.php';
require __DIR__ .'/categories_blog.php';
require __DIR__ .'/blog.php';
require __DIR__ .'/comments.php';
require __DIR__ .'/notify.php';
require __DIR__ .'/tags.php';
require __DIR__ .'/user.php';
require __DIR__ .'/teacher.php';
require __DIR__ .'/order.php';
require __DIR__ .'/quiz.php';


