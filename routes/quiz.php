<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;

Route::group(['prefix'=>"quiz","as"=>"quiz."],function(){
        Route::get('/',[QuizController::class,'index'])->name('list');
        Route::get('/create',[QuizController::class,'create'])->name('create');
        Route::post('/store',[QuizController::class,'store'])->name('store');
        Route::get('/edit/{quiz}',[QuizController::class,'edit'])->name('edit');
        Route::put('/update/{quiz}',[QuizController::class,'update'])->name('update');
        Route::delete('/delete/{quiz}',[QuizController::class,'destroy'])->name('delete');
        //question
        Route::get('/{quiz_id}/questions',[QuestionController::class,'index'])->name('questions.index');
        Route::get('/{quiz_id}/questions/create',[QuestionController::class,'create'])->name('questions.create');
        Route::post('/{quiz_id}/questions/store',[QuestionController::class,'store'])->name('questions.store');
        Route::put('/{quiz_id}/questions/update/{question}',[QuestionController::class,'update'])->name('questions.update');
        Route::delete('/{quiz_id}/questions/delete/{question}',[QuestionController::class,'destroy'])->name('questions.delete');
    });
//answer
Route::group(['prefix'=>"questions","as"=>"questions."],function(){
    Route::get('/{question_id}/answers',[AnswerController::class,'index'])->name('answers.index');
        Route::get('/{question_id}/answers/create',[AnswerController::class,'create'])->name('answers.create');
        Route::post('/{question_id}/answers/store',[AnswerController::class,'store'])->name('answers.store');
        Route::get('/{question_id}/answers/edit/{answer}',[AnswerController::class,'edit'])->name('answers.edit');
        Route::put('/{question_id}/answers/update/{answer}',[AnswerController::class,'update'])->name('answers.update');
        Route::delete('/{question_id}/answers/delete/{answer}',[AnswerController::class,'destroy'])->name('answers.delete');
});