<?php

use App\Http\Controllers\VoucherController;

Route::group(['prefix' => 'voucher'], function () {
    Route::match(['get', 'delete','put','post'],'/list',[VoucherController::class,'showVoucher'])->name('show.voucher');
    Route::delete('/voucher-delete/{id}',[VoucherController::class,'deleteVoucher'])->name('delete.voucher');
    Route::get('/voucher-add',[VoucherController::class,'addVoucher'])->name('add.voucher');
    Route::get('/voucher-edit/{id}',[VoucherController::class,'editVoucher'])->name('edit.voucher');
    Route::put('/voucher-update/{id}',[VoucherController::class,'updateVoucher'])->name('update.voucher');
    Route::post('/voucher-store',[VoucherController::class,'storeVoucher'])->name('store.voucher');
});
