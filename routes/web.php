<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
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
    $cart = session('cart', []);
    $cartProducts = \App\Models\Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
    $cartTotal = collect($cart)->sum(fn ($quantity, $productId) => optional($cartProducts->get((int) $productId))->price * (int) $quantity);
    $cartQuantity = collect($cart)->sum();

    return view('show-products', compact('products', 'cartTotal', 'cartQuantity'));
})->name('products.index');

Route::post('/cart/{product}', function (Request $request, \App\Models\Product $product) {
    if ($product->inventory < 1) {
        return redirect()->route('products.index')->with('success', "{$product->name} is out of stock.");
    }

    $quantity = max(1, (int) $request->input('quantity', 1));
    $cart = session('cart', []);
    $currentQuantity = (int) ($cart[$product->id] ?? 0);
    $cart[$product->id] = min($product->inventory, $currentQuantity + $quantity);

    session(['cart' => $cart]);

    return redirect()->route('products.index')->with('success', "{$product->name} added to cart.");
})->name('cart.add');

Route::patch('/cart/{product}', function (Request $request, \App\Models\Product $product) {
    $action = $request->input('action');
    $cart = session('cart', []);
    $quantity = (int) ($cart[$product->id] ?? 0);

    if ($action === 'increase') {
        $quantity = min($product->inventory, $quantity + 1);
    } elseif ($action === 'decrease') {
        $quantity = max(0, $quantity - 1);
    } else {
        $quantity = max(0, min($product->inventory, (int) $request->input('quantity', $quantity)));
    }

    if ($quantity > 0) {
        $cart[$product->id] = $quantity;
    } else {
        unset($cart[$product->id]);
    }

    session(['cart' => $cart]);

    return redirect()->route('checkout');
})->name('cart.update');

Route::delete('/cart/{product}', function (\App\Models\Product $product) {
    $cart = session('cart', []);
    unset($cart[$product->id]);
    session(['cart' => $cart]);

    return redirect()->route('checkout');
})->name('cart.remove');

Route::get('/checkout', function () {
    $cart = session('cart', []);
    $products = \App\Models\Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

    $cartItems = collect($cart)
        ->map(function ($quantity, $productId) use ($products) {
            $product = $products->get((int) $productId);

            if (! $product) {
                return null;
            }

            if ($product->inventory < 1) {
                return null;
            }

            $quantity = max(1, min((int) $quantity, $product->inventory));

            return [
                'product' => $product,
                'quantity' => $quantity,
                'lineTotal' => $product->price * $quantity,
            ];
        })
        ->filter()
        ->values();

    $cartTotal = $cartItems->sum('lineTotal');
    $cartQuantity = $cartItems->sum('quantity');

    return view('checkout', compact('cartItems', 'cartTotal', 'cartQuantity'));
})->name('checkout');

Route::get('/checkout/{product}', function (\App\Models\Product $product) {
    $quantity = $product->inventory > 0 ? 1 : 0;
    $cartItems = collect();

    if ($quantity > 0) {
        $cartItems->push([
            'product' => $product,
            'quantity' => $quantity,
            'lineTotal' => $product->price * $quantity,
        ]);
    }

    $cartTotal = $cartItems->sum('lineTotal');
    $cartQuantity = $cartItems->sum('quantity');

    return view('checkout', compact('cartItems', 'cartTotal', 'cartQuantity'));
});

Route::post('/payment/initialize', [PaymentController::class, 'initialize'])->name('payment.initialize');
Route::get('/payment/verify/{reference?}', [PaymentController::class, 'verify'])->name('payment.verify');

Route::get('/products/search', function (Request $request) {
    $query = $request->input('query');
    $products = \App\Models\Product::where('name', 'like', "%$query%")->latest()->get();
    $cart = session('cart', []);
    $cartProducts = \App\Models\Product::whereIn('id', array_keys($cart))->get()->keyBy('id');
    $cartTotal = collect($cart)->sum(fn ($quantity, $productId) => optional($cartProducts->get((int) $productId))->price * (int) $quantity);
    $cartQuantity = collect($cart)->sum();

    return view('show-products', compact('products', 'cartTotal', 'cartQuantity'));
})->name('products.search');

Route::post('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/products/{product}/', [ProductController::class, 'delete'] )->name('admin.products.destroy');
