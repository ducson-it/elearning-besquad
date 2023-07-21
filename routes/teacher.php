<?php

use App\Http\Controllers\TeacherController;

Route::group(['prefix' => 'teacher'], function () {
    Route::match(['get', 'delete','put','post'],'/list',[TeacherController::class,'showListTeacher'])->name('show.teacher');
    Route::delete('/delete-teacher/{id}',[TeacherController::class,'deleteTeacher'])->name('delete.teacher');
    Route::post('/delete-teacher-checkbox',[TeacherController::class,'deleteCheckbox'])->name('deleteUser_Checkbox');
    Route::get('/teacher-add',[TeacherController::class,'addUser'])->name('add.teacher');
    Route::get('/teacher-edit/{id}',[TeacherController::class,'editTeacher'])->name('edit.teacher');
    Route::post('/teacher-update/{id}',[TeacherController::class,'updateTeacher'])->name('update.teacher');
    Route::post('/teacher-store',[TeacherController::class,'storeTeacher'])->name('store.teacher');
    Route::post('/teacher-active/{id}',[TeacherController::class,'activeTeacher'])->name('active.teacher');
    Route::post('/teacher-search', [TeacherController::class, 'searchTeacher'])->name('search.teacher');
    ///
    ///
});
