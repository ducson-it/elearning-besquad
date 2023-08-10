<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ForumCommentController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\Notifycaton;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UploadImageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\ForumPostController;
use App\Http\Controllers\Api\ForumFeedbackController;


use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');


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

    //quiz
    Route::post('quiz/questions/answer-check',[QuizController::class,'answerCheck'])->middleware('auth:sanctum');
    Route::post('quiz/questions/correct-answer',[QuizController::class,'viewAnswerCorrect'])->middleware('auth:sanctum');

});

Route::prefix('lesson')->group(function () {
    Route::get('trial-lesson', [LessonController::class, 'trailLesson']);
    Route::get('{lesson}', [LessonController::class, 'detailLesson'])->middleware('auth:sanctum');
});
Route::prefix('voucher')->group(function () {
    Route::get('list-system', [VoucherController::class, 'getVoucher'])->middleware('auth:sanctum');
    Route::post('checkVoucher', [VoucherController::class, 'checkVoucher'])->middleware('auth:sanctum');
});
Route::prefix('forum')->group(function () {
    Route::prefix('forum-cmt')->group(function () {
        Route::post('add', [ForumCommentController::class, 'addForumCmt'])->middleware('auth:sanctum');
        Route::post('reply', [ForumCommentController::class, 'replyForumCmt'])->middleware('auth:sanctum');
        Route::post('update/{id}', [ForumCommentController::class, 'updateForumCmt'])->middleware('auth:sanctum');
        Route::delete('delete/{id}', [ForumCommentController::class, 'deleteForumCmt'])->middleware('auth:sanctum');
    });
});
Route::prefix('notify')->group(function () {
    Route::get('list', [Notifycaton::class, 'getNotifys'])->middleware('auth:sanctum');
});
Route::fallback(function () {
    return response()->json([
        'message' => 'API endpoint not found.',
    ], 404);
});
// forum
Route::prefix('postforum')->group(function () {
    Route::get('/list', [ForumPostController::class, 'index'])->middleware('auth:sanctum');
    Route::get('/detail/{id}', [ForumPostController::class, 'detail'])->middleware('auth:sanctum');
    Route::post('/clickstar', [ForumPostController::class, 'clickStar'])->middleware('auth:sanctum');
    Route::post('/addpost', [ForumPostController::class, 'addpost'])->middleware('auth:sanctum');
    Route::post('/updatepost/{id}', [ForumPostController::class, 'updatepost'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [ForumPostController::class, 'deletePost'])->middleware('auth:sanctum');

    //api post mới nhất
    Route::get('/latest-posts', [ForumPostController::class, 'getLatestPosts'])->middleware('auth:sanctum');
    //api post hay nhất
    Route::get('/top-rated-posts', [ForumPostController::class, 'getTopRatedPosts'])->middleware('auth:sanctum');
    Route::get('/user-is-posts', [ForumPostController::class, 'getUserPosts'])->middleware('auth:sanctum');
    Route::get('/search-posts', [ForumPostController::class, 'searchPosts'])->middleware('auth:sanctum');
    Route::get('/postsCate', [ForumPostController::class, 'postsByCategory'])->middleware('auth:sanctum');

});
Route::prefix('feedbacks')->group(function () {
    Route::get('/list', [ForumFeedbackController::class, 'list'])->middleware('auth:sanctum');
    Route::get('/detail/{id}', [ForumFeedbackController::class, 'detail'])->middleware('auth:sanctum');
    Route::post('/addfeedback', [ForumFeedbackController::class, 'addfeedback'])->middleware('auth:sanctum');
    Route::post('/edit/{id}', [ForumFeedbackController::class, 'edit'])->middleware('auth:sanctum');
    Route::delete('/delete/{id}', [ForumFeedbackController::class, 'delete'])->middleware('auth:sanctum');
});




