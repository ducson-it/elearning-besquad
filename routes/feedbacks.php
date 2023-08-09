<?php
use App\Http\Controllers\FeebackController;

Route::group(['prefix' => "feedback"], function () {
    Route::get('/list', [FeebackController::class, 'index'])->name('feedbacks.list');
    Route::get('/create', [FeebackController::class, 'create'])->name('feedbacks.create');
    Route::post('/store', [FeebackController::class, 'store'])->name('feedbacks.store');
    Route::get('/edit/{id}', [FeebackController::class, 'edit'])->name('feedbacks.edit');
    Route::post('/update/{id}', [FeebackController::class, 'update'])->name('feedbacks.update');
    Route::delete('/destroy/{id}', [FeebackController::class, 'destroy'])->name('feedbacks.delete');
});
?>





