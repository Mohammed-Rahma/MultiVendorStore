<?php

use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('admin/products/' , [ProductsController::class , 'index']);