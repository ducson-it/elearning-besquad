<?php

use App\Http\Controllers\LessonController;

Route::group(['prefix'=>"lessons","as"=>"lessons."],function(){
        Route::get('/',[LessonController::class,'index'])->name('list');
        Route::get('/create',[LessonController::class,'create'])->name('create');
        Route::post('/store',[LessonController::class,'store'])->name('store');
        Route::get('/edit/{lesson}',[LessonController::class,'edit'])->name('edit');
        Route::put('/update/{lesson}',[LessonController::class,'update'])->name('update');
        Route::delete('/delete/{lesson_id}',[LessonController::class,'destroy'])->name('delete');
        Route::post('/select/course',[LessonController::class,'selectCourse']);
        Route::get('/select/video/{video_id}',[LessonController::class,'selectVideo']);

        //video
        Route::post('/video/upload',[LessonController::class,'uploadVideo'])->name('uploadVideo');
        Route::get('/download/{file}',[LessonController::class,'downloadDoc'])->name('downloadDoc');
    });
