<?php

use App\Http\Controllers\ModuleController;
Route::group(['prefix'=>"modules","as"=>"modules."],function(){
        Route::get('/',[ModuleController::class,'index'])->name('list');
        Route::get('/create',[ModuleController::class,'create'])->name('create');
        Route::post('/store',[ModuleController::class,'store'])->name('store');
        Route::get('/edit/{module}',[ModuleController::class,'edit'])->name('edit');
        Route::put('/update/{module}',[ModuleController::class,'update'])->name('update');
        Route::delete('/delete/{module_id}',[ModuleController::class,'destroy'])->name('delete');
        Route::get('/search/course',[ModuleController::class,'searchCourse']);
    });