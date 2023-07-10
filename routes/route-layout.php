<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

//category
Route::view('/categories','categories')->name('categories');
Route::group(["prefix"=>"courses","as"=>"courses."],function(){
    Route::view('/', 'courses.list')->name('list');
    Route::view('create','courses.create')->name('create');
    Route::view('edit/{course}','courses.edit')->name('edit');
    Route::view('select','topics.course_select')->name('topics.select');
    Route::post('/selected',function(Request $request){
        $course_id = $request->input('course');
        return redirect()->route('courses.topics.list',$course_id);
    })->name('topics.selected');
    Route::view('/{course}/topics','topics.list')->name('topics.list');
    Route::view('lessons/select','lessons.lessons_selected')->name('lessons.select');
    Route::post('/topic/selected',function(Request $request){
        $course_id = $request->input('course');
        $topic_id = $request->input('topic');
        return redirect()->route('courses.lessons.list',[$course_id,$topic_id]);
    })->name('lessons.selected');
    Route::get('/topic/{course}/{topic}/lessons',function($course,$topic){
        return view('lessons.list',compact('course','topic'));
    })->name('lessons.list');
    Route::get('/topic/{course}/{topic}/lessons/create',function($course,$topic){
        return view('lessons.create',compact('course','topic'));
    })->name('lessons.create');
    Route::get('/topic/{course}/{topic}/lessons/edit/{lesson}',function($course,$topic,$lesson){
        return view('lessons.edit',compact('course','topic','lesson'));
    })->name('lessons.edit');
});
Route::view('/blog-categories','blog-categories')->name('blog-categories');
Route::view('blog','blog.list')->name('blog.list');
Route::view('blog/create','blog.create')->name('blog.create');
Route::view('blog/edit/{blog}','blog.edit')->name('blog.edit');

Route::view('users/create','users.create')->name('user.create');
Route::view('users/edit/{user}','users.edit')->name('user.edit');
