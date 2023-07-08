<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\SliderController;
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
//Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('slider', [SliderController::class, 'slider']);
Route::get('blog', [BlogController::class, 'blog']);

Route::prefix('course')->group(function () {
    Route::get('category-course', [CourseController::class, 'categoryCourse']);
    Route::get('{course}', [CourseController::class, 'detailCourse']);
    // Route::get('my-course', [CourseController::class, 'myCourse'])->middleware('auth');
});

Route::prefix('lesson')->group(function () {
    Route::get('trial-lesson', [LessonController::class, 'trailLesson']);
    Route::get('{lesson}', [LessonController::class, 'detailLesson']);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'API endpoint not found.'
    ], 404);
});





