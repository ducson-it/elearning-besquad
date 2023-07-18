<?php

use App\Http\Controllers\OrderController;

Route::group(['prefix'=>"orders","as"=>"orders."],function(){
        Route::get('/',[OrderController::class,'index'])->name('list');
        Route::get('/create',[OrderController::class,'create'])->name('create');
        Route::post('/store',[OrderController::class,'store'])->name('store');
        Route::put('/detail/{order}',[OrderController::class,'detail'])->name('detail');
        Route::put('/update/{order}',[OrderController::class,'update'])->name('update');

        Route::get('/select/course/{course_id}',[OrderController::class,'selectCourse']);
        Route::get('/search/user',[OrderController::class,'searchUser']);
        Route::get('/search/order',[OrderController::class,'searchorder']);
    });