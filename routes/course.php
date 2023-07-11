<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;

Route::group(['prefix'=>"courses","as"=>"courses."],function(){
    Route::get('/',[CourseController::class,'index'])->name('list');
    Route::get('/create',[CourseController::class,'create'])->name('create');
    Route::post('/store',[CourseController::class,'store'])->name('store');
    Route::get('/edit/{course}',[CourseController::class,'edit'])->name('edit');
    Route::put('/update/{course}',[CourseController::class,'update'])->name('update');
    Route::delete('/delete/{course_id}',[CourseController::class,'destroy'])->name('delete');
});