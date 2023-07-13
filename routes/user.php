<?php

use App\Http\Controllers\UserController;

Route::group(['prefix' => 'user'], function () {
    Route::match(['get', 'delete','put'],'/list',[UserController::class,'showListUser'])->name('show.user');
    Route::delete('/delete-user/{user_id}',[UserController::class,'deleteUser'])->name('deleteUser');
    Route::post('/delete-user-checkbox',[UserController::class,'deleteCheckbox'])->name('deleteUser_Checkbox');
    Route::get('/user-add',[UserController::class,'addUser'])->name('addUser');
    Route::get('/user-edit/{id}',[UserController::class,'editUser'])->name('editUser');
    Route::post('/user-update/{id}',[UserController::class,'updateUser'])->name('updateUser');
    Route::post('/user-store',[UserController::class,'storeUser'])->name('store.user');
    Route::post('/upload',[UserController::class,'UserUpload'])->name('uploadFileUser');
    Route::post('/user-active/{id}',[UserController::class,'activeUser'])->name('activeUser');
});
<?php

use App\Http\Controllers\UserController;

Route::group(['prefix' => 'user'], function () {
    Route::match(['get', 'delete','put'],'/list',[UserController::class,'showListUser'])->name('show.user');
    Route::delete('/delete-user/{user_id}',[UserController::class,'deleteUser'])->name('deleteUser');
    Route::post('/delete-user-checkbox',[UserController::class,'deleteCheckbox'])->name('deleteUser_Checkbox');
    Route::get('/user-add',[UserController::class,'addUser'])->name('addUser');
    Route::get('/user-edit/{id}',[UserController::class,'editUser'])->name('editUser');
    Route::post('/user-update/{id}',[UserController::class,'updateUser'])->name('updateUser');
    Route::post('/user-store',[UserController::class,'storeUser'])->name('store.user');
    Route::post('/upload',[UserController::class,'UserUpload'])->name('uploadFileUser');
    Route::post('/user-active/{id}',[UserController::class,'activeUser'])->name('activeUser');
});
