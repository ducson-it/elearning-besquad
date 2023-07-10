<?php

use App\Http\Controllers\UserController;

Route::group(['prefix' => 'user'], function () {
    Route::match(['get', 'delete','put'],'/list',[UserController::class,'showListUser'])->name('showUser');
    Route::delete('/delete-user/{user_id}',[UserController::class,'deleteUser'])->name('deleteUser');
    Route::post('/delete-user-checkbox',[UserController::class,'deleteCheckbox'])->name('deleteUser_Checkbox');
});
