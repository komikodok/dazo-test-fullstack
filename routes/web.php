<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/products');

// Route::resource("/products", ProductController::class);

Route::get("category/", [CategoryController::class, "index"])->name("category.index");
Route::get("category/{id}", [CategoryController::class, "show"])->name("category.show");
Route::post("category/", [CategoryController::class, "store"])->name("category.store");

Route::get("products/", [ProductController::class, "index"])->name("products.index");
Route::get("products/create", [ProductController::class, "create"])->name("products.create");
Route::post("products/", [ProductController::class, "store"])->name("products.store");

