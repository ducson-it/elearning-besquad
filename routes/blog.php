<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::group(['prefix' =>'blogs'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blogs.list');
    Route::get('/create/', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/store/{id}', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/destroy/{id}', [BlogController::class, 'delete'])->name('blogs.destroy');

});
