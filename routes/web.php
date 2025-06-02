<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });

route::get("/", [ProductController::class, 'index'])->name('index.index');
route::get("/produk", [ProductController::class, 'index'])->name('index.index');
route::get('/produk/create', [ProductController::class, 'create'])->name('index.create');
route::post('/produk/store', [ProductController::class, 'store'])->name('index.store');
route::get('/produk/edit{id}', [ProductController::class, 'edit'])->name('index.edit');
route::put('/produk/update{id}', [ProductController::class, 'update'])->name('index.update');
route::delete('/produk/delete{id}', [ProductController::class, 'destroy'])->name('index.destroy');

// Route::get('/product', function () {
//     return view('product.hello');
// });



Route::get('/product-1', function () {
    return view('product.index');
});

