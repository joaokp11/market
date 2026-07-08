<?php

use App\Models\Product;
use App\Models\PaymentTransaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

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

it('initializes a paystack payment from the checkout cart', function () {
    config(['services.paystack.secret_key' => 'sk_test_example']);

    Http::fake([
        'api.paystack.co/transaction/initialize' => Http::response([
            'status' => true,
            'message' => 'Authorization URL created',
            'data' => [
                'authorization_url' => 'https://checkout.paystack.com/test-access-code',
                'access_code' => 'test-access-code',
                'reference' => 'paystack-reference',
            ],
        ]),
    ]);

    $product = Product::create([
        'name' => 'Market Tote',
        'description' => 'A durable shopping tote.',
        'category' => 'Bags',
        'price' => 25,
        'inventory' => 5,
        'slug' => 'market-tote',
    ]);

    $response = $this
        ->withSession(['cart' => [$product->id => 2]])
        ->post(route('payment.initialize'), [
            'full_name' => 'Ana Rivera',
            'email' => 'ana@example.com',
            'phone' => '5551234567',
            'address' => '123 Orange Avenue',
            'city' => 'Lagos',
            'postal_code' => '100001',
            'country' => 'Nigeria',
        ]);

    $response->assertRedirect('https://checkout.paystack.com/test-access-code');

    $this->assertDatabaseHas('orders', [
        'user_id' => null,
        'status' => 'pending_payment',
        'total' => 50,
        'shipping_email' => 'ana@example.com',
    ]);

    $this->assertDatabaseHas('payment_transactions', [
        'user_id' => null,
        'provider' => 'paystack',
        'status' => 'pending',
        'amount' => 50,
    ]);
});

it('verifies a successful paystack payment and updates inventory', function () {
    config(['services.paystack.secret_key' => 'sk_test_example']);

    Http::fake([
        'api.paystack.co/transaction/verify/MARKET-REFERENCE' => Http::response([
            'status' => true,
            'message' => 'Verification successful',
            'data' => [
                'id' => 4099260516,
                'status' => 'success',
                'reference' => 'MARKET-REFERENCE',
                'amount' => 3000,
                'currency' => 'NGN',
                'paid_at' => '2024-08-22T09:15:02.000Z',
            ],
        ]),
    ]);

    $product = Product::create([
        'name' => 'Stone Mug',
        'description' => 'A handcrafted ceramic mug.',
        'category' => 'Kitchen',
        'price' => 15,
        'inventory' => 8,
        'slug' => 'stone-mug-verify',
    ]);

    $order = \App\Models\Order::create([
        'status' => 'pending_payment',
        'total' => 30,
        'shipping_name' => 'Ana Rivera',
        'shipping_email' => 'ana@example.com',
        'shipping_address' => '123 Orange Avenue',
        'shipping_city' => 'Lagos',
        'shipping_postal_code' => '100001',
        'shipping_country' => 'Nigeria',
    ]);

    $order->items()->create([
        'product_id' => $product->id,
        'quantity' => 2,
        'unit_price' => 15,
    ]);

    PaymentTransaction::create([
        'order_id' => $order->id,
        'provider' => 'paystack',
        'reference' => 'MARKET-REFERENCE',
        'status' => 'pending',
        'amount' => 30,
        'currency' => 'NGN',
    ]);

    $response = $this
        ->withSession(['cart' => [$product->id => 2]])
        ->get(route('payment.verify', ['reference' => 'MARKET-REFERENCE']));

    $response->assertRedirect(route('checkout'));

    expect($product->fresh()->inventory)->toBe(6);

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'status' => 'paid',
    ]);

    $this->assertDatabaseHas('payment_transactions', [
        'reference' => 'MARKET-REFERENCE',
        'status' => 'success',
        'provider_transaction_id' => '4099260516',
    ]);
});
