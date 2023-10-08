<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/categories/trashed', [CategoriesController::class, 'trashed'])->name('trashed');
    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('forceDelete');
    Route::resource('/categories', CategoriesController::class);
    //->where('category' , '/d+') نسمح فقط لاعداد في الباراميتر الي سميته كاتيقوري\


    Route::get('/products/trashed', [ProductsController::class, 'trashed'])->name('products.trashed');
    Route::put('/products/{product}/restore', [ProductsController::class, 'restore'])->name('products.restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('forceDelete');
    Route::resource('/products', ProductsController::class);
});
