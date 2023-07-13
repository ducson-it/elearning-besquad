<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;

Route::group(['prefix' =>'slider'], function () {
    Route::get('/list', [SliderController::class, 'index'])->name('slider.list');
    Route::get('/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/update/{$id}', [SliderController::class, 'update'])->name('slider_update');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.destroy');
});
