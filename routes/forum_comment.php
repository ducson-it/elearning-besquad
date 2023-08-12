<?php

use App\Http\Controllers\ForumCommentController;

Route::group(['prefix' => 'forum-comment'], function () {
Route::match(['get', 'delete','put','post'],'/list',[ForumCommentController::class,'showForumCmt'])->name('show.forumCmt');
Route::delete('/forumCmt-delete/{id}',[ForumCommentController::class,'deleteForumCmt'])->name('delete.forumCmt');
Route::get('/forumCmt-add',[ForumCommentController::class,'addForumCmt'])->name('add.forumCmt');
Route::get('/forumCmt-edit/{id}',[ForumCommentController::class,'editForumCmt'])->name('edit.forumCmt');
Route::post('/forumCmt-update/{id}',[ForumCommentController::class,'updateForumCmt'])->name('update.forumCmt');
Route::post('/forumCmt-store',[ForumCommentController::class,'storeForumCmt'])->name('store.forumCmt');
Route::post('/forumCmt-active/{id}',[ForumCommentController::class,'activeForumCmt'])->name('active.forumCmt');
Route::post('/forumCmt-search', [ForumCommentController::class, 'searchForumCmt'])->name('search.forumCmt');
///
});
