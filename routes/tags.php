  <?php

  use App\Http\Controllers\TagController;

  Route::group(['prefix' => 'tag'], function () {
      Route::get('/list',[TagController::class,'show'])->name('show.tag');
      Route::post('/store-tag',[TagController::class,'storeTag'])->name('storeTag');
  });
