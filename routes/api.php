<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UploadImageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherController;
use App\Models\Course;
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

//refresh token
Route::post('refresh-token', [AuthController::class, 'refresh'])->middleware('auth:sanctum')->name('token.refresh');

//info
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// change user
Route::post('changeUser', [UserController::class, 'changeUser'])->middleware('auth:sanctum');



Route::get('/slider', [SliderController::class, 'slider']);
Route::get('/search', [SearchController::class, 'search']);
Route::post('/upload-image', [UploadImageController::class, 'uploadImage']);

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'blog']);
    Route::get('/category-blog', [BlogController::class, 'categoryBlog']);
    Route::get('/{blog}', [BlogController::class, 'detailBlog']);
});
Route::prefix('course')->group(function () {
    Route::get('category-course', [CourseController::class, 'categoryCourse']);
    Route::get('studies-course', [CourseController::class, 'getCourse'])->middleware('auth:sanctum');
    Route::get('my-course', [CourseController::class, 'myCourse'])->middleware('auth:sanctum');
    Route::post('register-course', [CourseController::class, 'registerCourse'])->middleware('auth:sanctum');
    Route::post('check-payment', [CourseController::class, 'checkPayment'])->middleware('auth:sanctum');
    Route::get('historyCourse', [CourseController::class, 'historyCourse'])->middleware('auth:sanctum');
    Route::post('historyCourseUpdate', [CourseController::class, 'historyCourseUpdate'])->middleware('auth:sanctum');
    Route::get('{course}', [CourseController::class, 'detailCourse']);
    //Payment by VNPay
    Route::post('/vnpay/redirect-url', [CourseController::class, 'redirectUrl'])->middleware('auth:sanctum');
    Route::get('/vnpay/callback', [CourseController::class, 'callback'])->name('callback');



});

Route::prefix('lesson')->group(function () {
    Route::get('trial-lesson', [LessonController::class, 'trailLesson']);
    Route::get('{lesson}', [LessonController::class, 'detailLesson'])->middleware('auth:sanctum');
});
Route::prefix('voucher')->group(function () {
    Route::get('list-system', [VoucherController::class, 'getVoucher'])->middleware('auth:sanctum');
});
Route::fallback(function () {
    return response()->json([
        'message' => 'API endpoint not found.',
    ], 404);
});
