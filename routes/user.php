<?php

use App\Http\Controllers\UserController;

Route::group(['prefix' => 'user'], function () {
    Route::match(['get', 'delete','put','post'],'/list',[UserController::class,'showListUser'])->name('show.user');
    Route::delete('/delete-user/{user_id}',[UserController::class,'deleteUser'])->name('deleteUser');
    Route::get('/user-add',[UserController::class,'addUser'])->name('addUser');
    Route::get('/user-edit/{id}',[UserController::class,'editUser'])->name('editUser');
    Route::post('/user-update/{id}',[UserController::class,'updateUser'])->name('updateUser');
    Route::post('/user-store',[UserController::class,'storeUser'])->name('store.user');
    Route::post('/upload',[UserController::class,'UserUpload'])->name('uploadFileUser');
    Route::post('/user-active/{id}',[UserController::class,'activeUser'])->name('activeUser');
    Route::post('/user-search', [UserController::class, 'searchUser'])->name('search.user');
    Route::get('/editprofile', [UserController::class, 'editprofile'])->name('editprofile');
    Route::post('/updateprofile', [UserController::class, 'updateprofile'])->name('updateprofile');
    Route::get('/editpass', [UserController::class, 'editpass'])->name('editpass');
    Route::post('/updatepass', [UserController::class, 'changepass'])->name('changepass');
});
