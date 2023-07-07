<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;

Route::group(['prefix' =>'slider'], function () {
    Route::get('/list', [SliderController::class, 'index'])->name('slider.list');
    Route::post('/create/{id}', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/destroy/{id}', [SliderController::class, 'delete'])->name('slider.destroy');

});
