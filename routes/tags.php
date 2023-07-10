  <?php

  use App\Http\Controllers\TagController;
  use App\Http\Controllers\TaggableController;

  Route::group(['prefix' => 'tag'], function () {
      Route::match(['get', 'delete','put'], '/list', [TagController::class, 'show'])->name('show.tag');
      Route::post('/store-tag',[TagController::class,'storeTag'])->name('storeTag');
      Route::delete('/delete-tag/{id}',[TagController::class,'deleteTag'])->name('deleteTag');
      Route::post('/edit-tag/{id}',[TagController::class,'editTag'])->name('editTag');
      /// Taggable
      Route::get('taggable/{tag_id}',[TaggableController::class,'getTaggable'])->name('show.taggable');
      Route::delete('/delete-taggable/{id}',[TaggableController::class,'deleteTaggable'])->name('deleteTaggable');
      Route::post('/delete-taggable-checkbox',[TaggableController::class,'deleteCheckbox'])->name('deleteTaggable_Checkbox');
  });
