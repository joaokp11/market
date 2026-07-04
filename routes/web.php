<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    $products = \App\Models\Product::latest()->get();
    return view('welcome', compact('products'));
});

Route::get('/admin/dashboard', function () {
    $products = \App\Models\Product::latest()->get();
    return view('admin.dashboard', compact('products'));
});

Route::get('/admin/products', function () {
    $products = \App\Models\Product::latest()->get();
    return view('admin.products.index', compact('products'));
})->name('admin.products.index');

Route::get('/admin/products/create', function () {
    $products = \App\Models\Product::latest()->get();
    return view('admin.products.create', compact('products'));
})->name('admin.products.create');

Route::post('/admin/products/create', [ProductController::class, 'store'])->name('admin.products.store');

Route::get('/admin/products/{product}/edit', function (\App\Models\Product $product) {
    $products = \App\Models\Product::latest()->get();
    return view('admin.products.edit', compact('product', 'products'));
})->name('admin.products.edit');

Route::get('/admin/products/{product}', function (\App\Models\Product $product) {
    return view('admin.products.show', compact('product'));
})->name('admin.products.show');

Route::get('/products', function () {
    $products = \App\Models\Product::latest()->get();
    return view('show-products', compact('products'));
})->name('products.index');

Route::get('/checkout/{product}', function (\App\Models\Product $product) {
    return view('checkout', compact('product'));
})->name('checkout');

Route::get('/products/search', function (Request $request) {
    $query = $request->input('query');
    $products = \App\Models\Product::where('name', 'like', "%$query%")->latest()->get();
    return view('show-products', compact('products'));
})->name('products.search');

Route::post('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/products/{product}/', [ProductController::class, 'delete'] )->name('admin.products.destroy');



