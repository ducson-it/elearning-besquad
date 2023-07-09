  <?php

  use App\Http\Controllers\TagController;

  Route::group(['prefix' => 'tag'], function () {
      Route::match(['get', 'delete'], '/list', [TagController::class, 'show'])->name('show.tag');
      Route::post('/store-tag',[TagController::class,'storeTag'])->name('storeTag');
      Route::delete('/delete-tag/{id}',[TagController::class,'deleteTag'])->name('deleteTag');
  });
