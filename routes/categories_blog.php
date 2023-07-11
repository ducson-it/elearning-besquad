<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category_BlogController;

Route::group(['prefix' =>'category_blog'], function () {
    Route::get('/', [Category_BlogController::class, 'index'])->name('category_blog.list');
    Route::get('/create', [Category_BlogController::class, 'create'])->name('category_blog.create');
    Route::post('/store', [Category_BlogController::class, 'store'])->name('category_blog.store');
    Route::get('/edit/{id}', [Category_BlogController::class, 'edit'])->name('category_blog.edit');
    Route::post('/update/{id}', [Category_BlogController::class, 'update'])->name('category_blog.update');
    Route::get('/delete/{id}', [Category_BlogController::class, 'delete'])->name('category_blog.destroy');
});
