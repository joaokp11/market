@extends('layouts.app')

@section('content')
<div class="mx-auto grid max-w-5xl gap-8 lg:grid-cols-[1fr_360px]">
    <section class="rounded-[32px] bg-white/95 p-8 shadow-[0_24px_80px_rgba(255,133,34,0.18)] ring-1 ring-[#F6D0A6]">
        <div class="mb-8">
            <p class="text-xs uppercase tracking-[0.3em] text-[#E05B00]">Checkout details</p>
            <h1 class="mt-3 text-4xl font-semibold text-[#1F1B16]">Secure your order</h1>
            <p class="mt-3 text-sm leading-7 text-[#5D4A2D]">Enter shipping details and complete your purchase in one smooth step.</p>
        </div>

        <form action="#" method="POST" class="space-y-6">
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

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label for="city" class="mb-2 block text-sm font-medium text-[#5D4A2D]">City</label>
                    <input id="city" name="city" type="text" placeholder="Austin" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                </div>
                <div>
                    <label for="country" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Country</label>
                    <input id="country" name="country" type="text" placeholder="United States" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                </div>
            </div>

            <button type="submit" class="w-full rounded-3xl bg-[#FF7A18] px-6 py-4 text-base font-semibold text-white shadow-md shadow-[#FF7A1866] transition hover:bg-[#FF8C28]">Complete order</button>
        </form>
    </section>

    <aside class="space-y-6 rounded-[32px] bg-[#FFF1DE] p-6 shadow-[0_20px_60px_rgba(255,133,34,0.12)] ring-1 ring-[#F5C39F]">
        <div class="rounded-[28px] bg-[#FFF7F0] p-6">
            <p class="text-xs uppercase tracking-[0.28em] text-[#E05B00]">Order summary</p>
            <div class="mt-5 space-y-4 text-sm text-[#5D4A2D]">
                <div class="flex items-center justify-between">
                    <span>Amber Luxe Backpack</span>
                    <span class="font-semibold text-[#1F1B16]">$74.50</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Citrus Dash Watch</span>
                    <span class="font-semibold text-[#1F1B16]">$159.95</span>
                </div>
                <div class="flex items-center justify-between border-t border-[#F2CFA4] pt-4 font-semibold text-[#1F1B16]">
                    <span>Total</span>
                    <span>$234.45</span>
                </div>
            </div>
        </div>
        <div class="rounded-[28px] bg-[#FFF1DE] p-6 text-sm text-[#5D4A2D]">
            <p class="font-semibold text-[#BF5A00]">Need a faster delivery option?</p>
            <p class="mt-2">Select express shipping at checkout to receive your order in 1-2 business days.</p>
        </div>
    </aside>
</div>
@endsection
