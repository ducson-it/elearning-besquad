<?php

use App\Http\Controllers\CategoryController;

Route::get('categories',[CategoryController::class,'index'])->name('categories');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('categories/detail/{category_id}',[CategoryController::class,'show'])->name('categories.show');
Route::PUT('categories/update/{category}',[CategoryController::class,'update'])->name('categories.update');
Route::delete('categories/delete/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');
