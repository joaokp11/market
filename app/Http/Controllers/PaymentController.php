<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentTransaction;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function initialize(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:2000'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $secretKey = config('services.paystack.secret_key');

        if (! $secretKey) {
            return back()->withInput()->with('error', 'Paystack is not configured yet.');
        }

        $cartItems = $this->cartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        $order = DB::transaction(function () use ($cartItems, $validated) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending_payment',
                'total' => $cartItems->sum('lineTotal'),
                'shipping_name' => $validated['full_name'],
                'shipping_email' => $validated['email'],
                'shipping_phone' => $validated['phone'] ?? null,
                'shipping_address' => $validated['address'],
                'shipping_city' => $validated['city'],
                'shipping_postal_code' => $validated['postal_code'],
                'shipping_country' => $validated['country'] ?? 'United States',
                'notes' => $validated['notes'] ?? null,
            ]);

            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['product']->price,
                ]);
            }

            return $order;
        });

        $reference = 'MARKET-' . Str::upper(Str::random(18));
        $amountInSubunits = (int) round((float) $order->total * 100);

        $response = Http::withoutVerifying()->withToken($secretKey)
            ->acceptJson()
            ->post('https://api.paystack.co/transaction/initialize', [
                'email' => $order->shipping_email,
                'amount' => (string) $amountInSubunits,
                'currency' => config('services.paystack.currency', 'NGN'),
                'reference' => $reference,
                'callback_url' => route('payment.verify', ['reference' => $reference]),
                'metadata' => json_encode([
                    'order_id' => $order->id,
                    'user_id' => auth()->id(),
                    'cart' => $order->items->map(fn ($item) => [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                    ])->values(),
                ]),
            ]);

        if (! $response->successful() || ! $response->json('status')) {
            $order->update(['status' => 'payment_initialization_failed']);

            return back()->withInput()->with('error', $response->json('message', 'Unable to initialize payment.'));
        }

        PaymentTransaction::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'provider' => 'paystack',
            'reference' => $reference,
            'status' => 'pending',
            'amount' => $order->total,
            'currency' => config('services.paystack.currency', 'NGN'),
            'authorization_url' => $response->json('data.authorization_url'),
            'access_code' => $response->json('data.access_code'),
            'payload' => $response->json(),
        ]);

        return redirect()->away($response->json('data.authorization_url'));
    }

    public function verify(Request $request, ?string $reference = null): RedirectResponse
    {
        $reference = $reference ?: $request->query('reference');

        if (! $reference) {
            return redirect()->route('checkout')->with('error', 'Missing payment reference.');
        }

        $transaction = PaymentTransaction::with('order.items')->where('reference', $reference)->first();

        if (! $transaction) {
            return redirect()->route('checkout')->with('error', 'Payment reference was not found.');
        }

        if ($transaction->status === 'success') {
            session()->forget('cart');

            return redirect()->route('checkout')->with('success', 'Payment already verified.');
        }

        if (! config('services.paystack.secret_key')) {
            return redirect()->route('checkout')->with('error', 'Paystack is not configured yet.');
        }

        $response = Http::withoutVerifying()->withToken(config('services.paystack.secret_key'))
            ->acceptJson()
            ->get("https://api.paystack.co/transaction/verify/{$reference}");

        if (! $response->successful() || ! $response->json('status')) {
            $transaction->update([
                'status' => 'verification_failed',
                'payload' => $response->json(),
            ]);

            return redirect()->route('checkout')->with('error', $response->json('message', 'Unable to verify payment.'));
        }

        $data = $response->json('data', []);

        if (($data['status'] ?? null) !== 'success') {
            $transaction->update([
                'status' => $data['status'] ?? 'failed',
                'payload' => $response->json(),
            ]);

            return redirect()->route('checkout')->with('error', 'Payment was not successful.');
        }

        try {
            DB::transaction(function () use ($transaction, $data, $response) {
                $order = Order::with('items')->lockForUpdate()->findOrFail($transaction->order_id);

                foreach ($order->items as $item) {
                    $product = Product::whereKey($item->product_id)->lockForUpdate()->firstOrFail();

                    if ($product->inventory < $item->quantity) {
                        $transaction->update([
                            'status' => 'paid_stock_unavailable',
                            'provider_transaction_id' => isset($data['id']) ? (string) $data['id'] : null,
                            'payload' => $response->json(),
                        ]);

                        $order->update(['status' => 'stock_unavailable']);

                        throw new \RuntimeException("Insufficient inventory for {$product->name}.");
                    }

                    $product->decrement('inventory', $item->quantity);
                }

                $order->update(['status' => 'paid']);

                $transaction->update([
                    'status' => 'success',
                    'provider_transaction_id' => isset($data['id']) ? (string) $data['id'] : null,
                    'paid_at' => $data['paid_at'] ?? $data['paidAt'] ?? now(),
                    'payload' => $response->json(),
                ]);
            });
        } catch (\RuntimeException $exception) {
            $transaction->order()->update(['status' => 'stock_unavailable']);
            $transaction->update([
                'status' => 'paid_stock_unavailable',
                'provider_transaction_id' => isset($data['id']) ? (string) $data['id'] : null,
                'payload' => $response->json(),
            ]);

            return redirect()->route('checkout')->with('error', $exception->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('checkout')->with('success', 'Payment verified and order completed.');
    }

    private function cartItems()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        return collect($cart)
            ->map(function ($quantity, $productId) use ($products) {
                $product = $products->get((int) $productId);

                if (! $product || $product->inventory < 1) {
                    return null;
                }

                $quantity = max(1, min((int) $quantity, $product->inventory));

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'lineTotal' => (float) $product->price * $quantity,
                ];
            })
            ->filter()
            ->values();
    }
}
