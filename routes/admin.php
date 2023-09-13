<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function(){

    Route::get('/trashed' , [CategoriesController::class , 'trashed'])->name('trashed');
    Route::put('/categories/{category}/restore', [CategoriesController::class, 'restore'])->name('restore');
    Route::delete('/categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('forceDelete');
    Route::resource('/categories' ,CategoriesController::class);

});

