<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/products');

Route::resource("/products", ProductController::class);
