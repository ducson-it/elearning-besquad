<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudyController;

Route::group(['prefix'=>"courses","as"=>"courses."],function(){
    Route::get('/',[CourseController::class,'index'])->name('list');
    Route::get('/create',[CourseController::class,'create'])->name('create');
    Route::post('/store',[CourseController::class,'store'])->name('store');
    Route::get('/edit/{course}',[CourseController::class,'edit'])->name('edit');
    Route::put('/update/{course}',[CourseController::class,'update'])->name('update');
    Route::delete('/delete/{course_id}',[CourseController::class,'destroy'])->name('delete');

    //filter by category
    Route::get('/select/category/{category_id}',[CourseController::class,'showCourseCate']);
    Route::get('/select/category/',[CourseController::class,'showAllCourseCate']);
});
//learning management
Route::get('/studies',[StudyController::class,'index'])->name('studies.list');
//courses history
Route::get('/histories',[HistoryController::class,'index'])->name('histories.list');