@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header class="sticky top-4 z-50 border border-[#D6C0A8] bg-[#FFF9F1]/95 shadow-[8px_8px_0_rgba(31,27,22,0.08)] backdrop-blur">
        <nav class="flex min-h-16 items-center justify-between gap-4 px-4 sm:px-6">
            <a href="{{ url('/') }}" class="group inline-flex items-center gap-3 text-sm font-black uppercase tracking-[0.22em] text-[#1F1B16]">
                <span class="relative grid h-10 w-10 place-items-center bg-[#FF7A18] text-white">
                    <svg class="h-5 w-5 animate-market-draw" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 7h15l-2 9H8L6 7Z" />
                        <path d="M6 7 5 3H2" />
                        <circle cx="9" cy="20" r="1" />
                        <circle cx="18" cy="20" r="1" />
                    </svg>
                    <span class="absolute -right-1 -top-1 h-2.5 w-2.5 bg-[#1F1B16] animate-market-pulse"></span>
                </span>
                Market
            </a>

            <div class="hidden items-center gap-1 md:flex">
                <a href="{{ route('products.index') }}" class="px-4 py-3 text-sm font-semibold text-[#5B4631] transition hover:bg-[#1F1B16] hover:text-white">Shop</a>
                <a href="{{ route('checkout') }}" class="bg-[#1F1B16] px-4 py-3 text-sm font-bold text-white">Cart ({{ $cartQuantity }})</a>
                <a href="/admin/dashboard" class="ml-2 inline-flex items-center gap-2 bg-[#FF7A18] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#1F1B16]">Dashboard</a>
            </div>

            <details class="relative md:hidden">
                <summary class="list-none bg-[#1F1B16] px-4 py-3 text-sm font-bold text-white marker:hidden">Menu</summary>
                <div class="absolute right-0 mt-3 grid w-56 border border-[#D6C0A8] bg-white shadow-[8px_8px_0_rgba(31,27,22,0.08)]">
                    <a href="{{ route('products.index') }}" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Shop</a>
                    <a href="{{ route('checkout') }}" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Cart ({{ $cartQuantity }})</a>
                    <a href="/admin/dashboard" class="px-4 py-3 text-sm font-semibold text-[#C64E00]">Dashboard</a>
                </div>
            </details>
        </nav>
    </header>

    <section class="border border-[#D6C0A8] bg-[#FFF9F1] p-6 shadow-[14px_14px_0_rgba(31,27,22,0.08)]">
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Checkout</p>
                <h1 class="mt-3 text-4xl font-black tracking-tight text-[#1F1B16]">Review your cart</h1>
                <p class="mt-3 max-w-2xl text-base leading-7 text-[#6A4A2D]">Adjust quantities, review totals, and add delivery details before placing your order.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="inline-flex items-center bg-[#FF7A18] px-5 py-3 text-sm font-black text-white transition hover:bg-[#1F1B16]">Continue shopping</a>
                <span class="inline-flex items-center border border-[#BFA98F] bg-white px-5 py-3 text-sm font-black text-[#1F1B16]">${{ number_format($cartTotal, 2) }}</span>
            </div>
        </div>
    </section>

    @if ($cartItems->isEmpty())
        <section class="border border-[#D6C0A8] bg-white p-8 text-center shadow-[10px_10px_0_rgba(31,27,22,0.08)]">
            <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Empty cart</p>
            <h2 class="mt-3 text-3xl font-black text-[#1F1B16]">No products selected yet</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-[#6A4A2D]">Add products from the shop page and they will appear here with quantity controls and totals.</p>
            <a href="{{ route('products.index') }}" class="mt-6 inline-flex bg-[#1F1B16] px-5 py-3 text-sm font-black text-white transition hover:bg-[#FF7A18]">Go to shop</a>
        </section>
    @else
        <div class="grid gap-5 lg:grid-cols-[1fr_360px]">
            <main class="space-y-5">
                <section class="border border-[#D6C0A8] bg-white">
                    <div class="flex flex-col gap-2 border-b border-[#D6C0A8] p-5 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Cart items</p>
                            <h2 class="mt-2 text-2xl font-black text-[#1F1B16]">Selected products</h2>
                        </div>
                        <p class="text-sm font-semibold text-[#7D5A37]">{{ $cartQuantity }} {{ Str::plural('item', $cartQuantity) }}</p>
                    </div>

                    <div class="divide-y divide-[#EFE0CF]">
                        @foreach ($cartItems as $item)
                            @php
                                $product = $item['product'];
                                $quantity = $item['quantity'];
                                $lineTotal = $item['lineTotal'];
                            @endphp

                            <article class="grid gap-4 p-5 lg:grid-cols-[120px_1fr_auto] lg:items-center">
                                <div class="aspect-square overflow-hidden bg-[#EFE0CF]">
                                    @if ($product->image_url)
                                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                                    @else
                                        <div class="grid h-full place-items-center text-xs font-black text-[#A27B43]">IMG</div>
                                    @endif
                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-[#C64E00]">{{ $product->category ?? 'Uncategorized' }}</p>
                                    <h3 class="mt-2 text-xl font-black text-[#1F1B16]">{{ $product->name }}</h3>
                                    <p class="mt-2 line-clamp-2 text-sm leading-6 text-[#6D5536]">{{ $product->description ?: 'No description available.' }}</p>
                                    <p class="mt-3 text-sm font-black text-[#1F1B16]">${{ number_format($product->price, 2) }} each</p>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-[auto_auto] sm:items-center lg:grid-cols-1 lg:justify-items-end">
                                    <div class="flex items-center border border-[#D6C0A8] bg-[#FFF8EF]">
                                        <form action="{{ route('cart.update', $product) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="decrease" />
                                            <button type="submit" class="grid h-10 w-10 place-items-center text-lg font-black text-[#1F1B16] transition hover:bg-[#1F1B16] hover:text-white" aria-label="Reduce {{ $product->name }} quantity">-</button>
                                        </form>

                                        <form action="{{ route('cart.update', $product) }}" method="POST" class="border-x border-[#D6C0A8]">
                                            @csrf
                                            @method('PATCH')
                                            <label class="sr-only" for="checkout-quantity-{{ $product->id }}">Quantity for {{ $product->name }}</label>
                                            <input id="checkout-quantity-{{ $product->id }}" type="number" name="quantity" min="1" max="{{ $product->inventory }}" value="{{ $quantity }}" class="h-10 w-16 bg-white text-center text-sm font-black text-[#1F1B16] outline-none focus:ring-4 focus:ring-[#FF7A1833]" onchange="this.form.submit()" />
                                        </form>

                                        <form action="{{ route('cart.update', $product) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="increase" />
                                            <button type="submit" class="grid h-10 w-10 place-items-center text-lg font-black text-[#1F1B16] transition hover:bg-[#FF7A18] hover:text-white" aria-label="Increase {{ $product->name }} quantity">+</button>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-between gap-3 sm:justify-end lg:w-full">
                                        <p class="text-lg font-black text-[#1F1B16]">${{ number_format($lineTotal, 2) }}</p>
                                        <form action="{{ route('cart.remove', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-[#B42318] px-3 py-2 text-xs font-black text-white transition hover:bg-[#7A1210]">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="border border-[#D6C0A8] bg-white">
                    <div class="border-b border-[#D6C0A8] p-5">
                        <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Delivery details</p>
                        <h2 class="mt-2 text-2xl font-black text-[#1F1B16]">Shipping information</h2>
                    </div>

                    <form action="#" method="POST" class="space-y-5 p-5">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="full_name" class="mb-2 block text-sm font-bold text-[#6A4A2D]">Full name</label>
                                <input id="full_name" name="full_name" type="text" placeholder="Ana Rivera" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm text-[#3B2800] outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-sm font-bold text-[#6A4A2D]">Email address</label>
                                <input id="email" name="email" type="email" placeholder="ana@example.com" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm text-[#3B2800] outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="phone" class="mb-2 block text-sm font-bold text-[#6A4A2D]">Phone number</label>
                                <input id="phone" name="phone" type="tel" placeholder="(555) 123-4567" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm text-[#3B2800] outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                            </div>
                            <div>
                                <label for="postal_code" class="mb-2 block text-sm font-bold text-[#6A4A2D]">Postal code</label>
                                <input id="postal_code" name="postal_code" type="text" placeholder="12345" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm text-[#3B2800] outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                            </div>
                        </div>

                        <div>
                            <label for="address" class="mb-2 block text-sm font-bold text-[#6A4A2D]">Shipping address</label>
                            <textarea id="address" name="address" rows="4" placeholder="123 Orange Avenue, Suite 5" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm text-[#3B2800] outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#FF7A18] px-6 py-4 text-base font-black text-white transition hover:bg-[#1F1B16]">Complete order</button>
                    </form>
                </section>
            </main>

            <aside class="lg:sticky lg:top-28 lg:self-start">
                <div class="border border-[#D6C0A8] bg-[#1F1B16] p-5 text-white shadow-[10px_10px_0_rgba(31,27,22,0.10)]">
                    <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#FFB47B]">Order summary</p>
                    <div class="mt-5 space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/65">Items</span>
                            <span class="font-black">{{ $cartQuantity }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-white/65">Subtotal</span>
                            <span class="font-black">${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between border-t border-white/15 pt-5 text-lg">
                            <span class="font-black">Total</span>
                            <span class="font-black text-[#FFB47B]">${{ number_format($cartTotal, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('products.index') }}" class="mt-6 flex justify-center bg-white px-5 py-3 text-sm font-black text-[#1F1B16] transition hover:bg-[#FF7A18] hover:text-white">Add more items</a>
                </div>
            </aside>
        </div>
    @endif
</div>
@endsection
