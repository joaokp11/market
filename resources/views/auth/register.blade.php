@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl rounded-[32px] bg-white/95 p-8 shadow-[0_24px_80px_rgba(255,133,34,0.18)] ring-1 ring-[#F5C39F]">
    <div class="mb-8 grid gap-6 md:grid-cols-[1fr_280px] md:items-center">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-[#E05B00]">Create your account</p>
            <h1 class="mt-3 text-4xl font-semibold text-[#1F1B16]">Register for the marketplace</h1>
            <p class="mt-3 text-sm leading-7 text-[#5D4A2D]">Join now to save favorites, manage checkout details, and get early access to deals.</p>
        </div>
        <div class="rounded-[24px] bg-[#FFF0D9] p-5 text-sm text-[#5D4A2D]">
            <p class="font-semibold text-[#BF5A00]">Need help?</p>
            <p class="mt-2">Use a working email and a secure password with at least 8 characters.</p>
        </div>
    </div>

    <form action="#" method="POST" class="space-y-6">
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Name</label>
                <input id="name" name="name" type="text" placeholder="Ana Rivera" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
            </div>
            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Email address</label>
                <input id="email" name="email" type="email" placeholder="ana@example.com" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Password</label>
                <input id="password" name="password" type="password" placeholder="Enter password" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
            </div>
            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-medium text-[#5D4A2D]">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password" class="w-full rounded-3xl border border-[#F2CFA4] bg-[#FFF5E8] px-5 py-4 text-base text-[#3B2800] outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
            </div>
        </div>

        <div class="rounded-[28px] border border-[#F5C39F] bg-[#FFF8EE] p-5 text-sm text-[#6C5231]">
            <p class="font-semibold text-[#C65A00]">Why register?</p>
            <ul class="mt-3 space-y-2 list-disc pl-5">
                <li>Save shipping details for faster checkout</li>
                <li>Track orders from your dashboard</li>
                <li>Receive promotional offers and alerts</li>
            </ul>
        </div>

        <button type="submit" class="w-full rounded-3xl bg-[#FF7A18] px-6 py-4 text-base font-semibold text-white shadow-md shadow-[#FF7A1866] transition hover:bg-[#FF8C28]">Create account</button>
    </form>
</div>
@endsection
