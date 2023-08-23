<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->group(function(){

    Route::resource('/categories' ,CategoriesController::class);

});

