<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows an add to cart action next to the view button on the products page', function () {
    Product::create([
        'name' => 'Velvet Lamp',
        'description' => 'A cozy reading lamp.',
        'category' => 'Home',
        'price' => 49.99,
        'inventory' => 12,
        'slug' => 'velvet-lamp',
    ]);

    $response = $this->get('/products');

    $response->assertOk();
    $response->assertSee('View');
    $response->assertSee('Add to cart');
});

it('renders the checkout page for a selected product', function () {
    $product = Product::create([
        'name' => 'Stone Mug',
        'description' => 'A handcrafted ceramic mug.',
        'category' => 'Kitchen',
        'price' => 18.5,
        'inventory' => 8,
        'slug' => 'stone-mug',
    ]);

    $response = $this->get('/checkout/' . $product->id);

    $response->assertOk();
    $response->assertSee('Checkout');
    $response->assertSee($product->name);
});
