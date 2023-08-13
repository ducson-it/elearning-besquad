<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::group(['prefix' =>'comment'], function () {
    Route::get('/', [CommentController::class, 'index'])->name('comment.list');
    Route::get('/create/', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/delete/{id}', [CommentController::class, 'delete'])->name('comment.destroy');
    Route::post('/repcomment/{id}', [CommentController::class, 'rep_comment'])->name('comment.repcomment');

});
