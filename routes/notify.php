<?php

use App\Http\Controllers\NotifyControler;

Route::group(['prefix' => 'notify'], function () {
    Route::match(['get', 'delete', 'put'], '/list', [NotifyControler::class, 'showNotify'])->name('show.notify');
    Route::get('/add-notify', [NotifyControler::class, 'addNotify'])->name('add.notify');
    Route::post('/store-notify', [NotifyControler::class, 'storeNotify'])->name('store.notify');
    Route::delete('/delete-notify/{id}',[NotifyControler::class,'deleteNotify'])->name('delete.notify');
    Route::post('/delete-notify-checkbox',[NotifyControler::class,'deleteCheckbox'])->name('deleteNotify_Checkbox');
    Route::get('/notify-edit/{id}',[NotifyControler::class,'editNotify'])->name('edit.notify');
    Route::post('/notify-update/{id}',[NotifyControler::class,'updateNotify'])->name('update.notify');
    Route::post('/notify-search', [NotifyControler::class, 'searchNotify'])->name('search.notify');
});
