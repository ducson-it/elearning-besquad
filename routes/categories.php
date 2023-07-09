<?php

use App\Http\Controllers\CategoryController;

Route::get('categories',[CategoryController::class,'index'])->name('categories');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::put('categories/update/{cateogry}',[CategoryController::class,'update'])->name('categories.update');
Route::delete('categories/delete/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');