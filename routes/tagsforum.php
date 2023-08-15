<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsForumController;

Route::group(['prefix' =>'tagsforum'], function () {
    Route::get('/list', [TagsForumController::class, 'index'])->name('tagsforum.list');
    Route::get('/create', [TagsForumController::class, 'create'])->name('tagsforum.create');
    Route::post('/store', [TagsForumController::class, 'store'])->name('tagsforum.store');
    Route::get('/edit/{id}', [TagsForumController::class, 'edit'])->name('tagsforum.edit');
    Route::post('/update/{id}', [TagsForumController::class, 'update'])->name('tagsforum.update');
    Route::get('/delete/{id}', [TagsForumController::class, 'delete'])->name('tagsforum.destroy');
});
