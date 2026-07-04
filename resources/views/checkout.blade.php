@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl space-y-8">
    <div class="flex flex-wrap items-center justify-between gap-4 rounded-[28px] border border-[#F2CFA4] bg-white/90 p-6 shadow-[0_18px_60px_rgba(255,133,34,0.12)]">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-[#E05B00]">Checkout</p>
            <h1 class="mt-2 text-3xl font-semibold text-[#1F1B16]">Complete your order</h1>
        </div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center border border-[#F2CFA4] bg-[#FFF7ED] px-5 py-3 text-sm font-semibold text-[#8D5B2C] transition hover:bg-[#FFE7CC]">Back to shop</a>
    </div>

    <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
        <section class="rounded-[32px] bg-white/95 p-8 shadow-[0_24px_80px_rgba(255,133,34,0.18)] ring-1 ring-[#F6D0A6]">
            <div class="mb-8">
                <p class="text-xs uppercase tracking-[0.3em] text-[#E05B00]">Selected item</p>
                <h2 class="mt-3 text-4xl font-semibold text-[#1F1B16]">{{ $product->name }}</h2>
                <p class="mt-3 text-sm leading-7 text-[#5D4A2D]">You are checking out for this product. Add your delivery details and place your order in one step.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
                <div class="overflow-hidden rounded-[24px] bg-[#FFF7ED] p-3">
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-64 w-full rounded-[18px] object-cover" />
                    @else
                        <div class="flex h-64 items-center justify-center rounded-[18px] border border-dashed border-[#F4D2A9] bg-[#FFF0D8] text-sm font-semibold text-[#A46C24]">
                            No image available
                        </div>
                    @endif
                </div>
                <div class="space-y-4">
                    <div class="rounded-[22px] bg-[#FFF7ED] p-5 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05B00]">Description</p>
                        <p class="mt-3 text-sm leading-7 text-[#5D4A2D]">{{ $product->description ?: 'No description available for this product.' }}</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[22px] bg-[#FFF7ED] p-5 ring-1 ring-[#F6D0A0]">
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E05B00]">Category</p>
                            <p class="mt-2 text-lg font-semibold text-[#1F1B16]">{{ $product->category ?? 'Uncategorized' }}</p>
                        </div>
                        <div class="rounded-[22px] bg-[#FFF7ED] p-5 ring-1 ring-[#F6D0A0]">
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E05B00]">Inventory</p>
                            <p class="mt-2 text-lg font-semibold text-[#1F1B16]">{{ $product->inventory }} in stock</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="#" method="POST" class="mt-8 space-y-6">
                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="full_name" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Full name</label>
                        <input id="full_name" name="full_name" type="text" placeholder="Ana Rivera" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                    </div>
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Email address</label>
                        <input id="email" name="email" type="email" placeholder="ana@example.com" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                    </div>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Phone number</label>
                        <input id="phone" name="phone" type="tel" placeholder="(555) 123-4567" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                    </div>
                    <div>
                        <label for="postal_code" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Postal code</label>
                        <input id="postal_code" name="postal_code" type="text" placeholder="12345" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                    </div>
                </div>

                <div>
                    <label for="address" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Shipping address</label>
                    <textarea id="address" name="address" rows="4" placeholder="123 Orange Avenue, Suite 5" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]"></textarea>
                </div>

                <button type="submit" class="w-full rounded-3xl bg-[#FF7A18] px-6 py-4 text-base font-semibold text-white shadow-md shadow-[#FF7A1866] transition hover:bg-[#FF8C28]">Complete order</button>
            </form>
        </section>

        <aside class="space-y-6 rounded-[32px] bg-[#FFF1DE] p-6 shadow-[0_20px_60px_rgba(255,133,34,0.12)] ring-1 ring-[#F5C39F]">
            <div class="rounded-[28px] bg-[#FFF7F0] p-6">
                <p class="text-xs uppercase tracking-[0.28em] text-[#E05B00]">Order summary</p>
                <div class="mt-5 space-y-4 text-sm text-[#5D4A2D]">
                    <div class="flex items-center justify-between">
                        <span>{{ $product->name }}</span>
                        <span class="font-semibold text-[#1F1B16]">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between border-t border-[#F2CFA4] pt-4 font-semibold text-[#1F1B16]">
                        <span>Total</span>
                        <span>${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </div>
            <div class="rounded-[28px] bg-[#FFF1DE] p-6 text-sm text-[#5D4A2D]">
                <p class="font-semibold text-[#BF5A00]">Need a faster delivery option?</p>
                <p class="mt-2">Select express shipping at checkout to receive your order in 1-2 business days.</p>
            </div>
        </aside>
    </div>
</div>
@endsection
