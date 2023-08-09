<?php
use App\Http\Controllers\ForumPostController;
Route::group(['prefix'=>"forum"],function(){
    Route::get('/list',[ForumPostController::class,'index'])->name('forum.list');
    Route::get('/create',[ForumPostController::class,'create'])->name('forum.create');
    Route::post('/store',[ForumPostController::class,'store'])->name('forum.store');
    Route::get('/edit{id}',[ForumPostController::class,'edit'])->name('forum.edit');
    Route::post('/update{id}',[ForumPostController::class,'update'])->name('forum.update');
    Route::delete('/destroy/{id}',[ForumPostController::class,'delete'])->name('forum.delete');
});

