@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <header class="rounded-[36px] bg-[#FFF3E8] p-8 shadow-[0_30px_80px_rgba(255,115,27,0.12)] ring-1 ring-[#F9D1B0]">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div class="space-y-6">
                <p class="text-sm uppercase tracking-[0.3em] text-[#E85F05]">Orange marketplace</p>
                <h1 class="max-w-3xl text-5xl font-semibold tracking-tight text-[#2B1F14] sm:text-6xl">Shop premium products with bright, bold style.</h1>
                <p class="max-w-2xl text-base leading-8 text-[#59432A]">Browse curated goods, discover fresh arrivals, and complete checkout with ease. Designed for a warm shopping experience using rich shades of orange and soft gold tones.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-3xl bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8F3A]">Start shopping</a>
                    <a href="#collections" class="inline-flex items-center justify-center rounded-3xl border border-[#F5B16A] bg-white px-6 py-4 text-sm font-semibold text-[#9D5A21] transition hover:bg-[#FFF0D8]">View collections</a>
                    <a href="/admin/dashboard" class="inline-flex items-center justify-center rounded-3xl border border-[#F5B16A] bg-[#FFF0D8] px-6 py-4 text-sm font-semibold text-[#9D5A21] transition hover:bg-[#FFE4BF]">Admin dashboard</a>
                </div>
            </div>

            <div class="grid gap-4 rounded-[32px] bg-white p-6 shadow-[0_16px_56px_rgba(255,125,36,0.12)] ring-1 ring-[#F5C29A]">
                <div class="flex items-center gap-3 rounded-3xl bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center rounded-3xl bg-[#FF8F3A] text-white">1</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Fast search</p>
                        <p class="text-sm text-[#806044]">Find products instantly with the marketplace search.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-3xl bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center rounded-3xl bg-[#FFB03D] text-white">2</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Secure checkout</p>
                        <p class="text-sm text-[#806044]">Complete your order using a clean, guided checkout form.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @include('components.searchbar')

    <section id="collections" class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Featured products</p>
                <h2 class="mt-3 text-3xl font-semibold text-[#2B1F14]">Popular items you’ll love</h2>
            </div>
            <div class="text-sm text-[#7D5A37]">All prices shown in USD.</div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
           @foreach ($products as $product )
               <article class="overflow-hidden rounded-[32px] bg-white shadow-[0_22px_60px_rgba(255,128,41,0.12)] ring-1 ring-[#F9D7BB] transition hover:-translate-y-1">
                <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/placeholder.png') }}" alt="{{ $product->name }}" class="object-cover }}" />
                <div class="space-y-4 p-6">
                    <span class="inline-flex rounded-full bg-[#FFF0D8] px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#D15E00]">{{ $product->category }}</span>
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold text-[#2B1F14]">{{ $product->name }}</h3>
                        <p class="text-sm leading-6 text-[#6D5536]">{{ $product->description }}</p>
                    </div>
                    <div class="flex items-center justify-between text-sm text-[#2B1F14]">
                        <span class="font-semibold">{{ $product->price }}</span>
                        <a href="" class="rounded-full bg-[#FF7A18] px-4 py-2 text-white transition hover:bg-[#FF8F3A]">View product</a>
                    </div>
                </div>
            </article>
           @endforeach 
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[1fr_330px]">
        <div class="rounded-[32px] bg-[#FFF1DE] p-8 shadow-[0_24px_80px_rgba(255,122,29,0.12)] ring-1 ring-[#F6D0A0]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Why shop with us</p>
            <h2 class="mt-4 text-3xl font-semibold text-[#2B1F14]">A warm marketplace built for productivity.</h2>
            <ul class="mt-6 space-y-4 text-base leading-7 text-[#5D4A2D]">
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Curated product collections with modern orange accents.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Clean checkout and registration forms designed around your guide.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Responsive layouts for desktop and mobile browsing.</li>
            </ul>
        </div>

        <div class="rounded-[32px] bg-white p-6 shadow-[0_20px_60px_rgba(255,132,41,0.12)] ring-1 ring-[#F5C29A]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Highlights</p>
            <div class="mt-6 space-y-4 text-sm text-[#6D5536]">
                <div class="rounded-[24px] bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Checkout preview</p>
                    <p class="mt-2">A friendly order summary with pricing that fits the marketplace theme.</p>
                </div>
                <div class="rounded-[24px] bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Product discovery</p>
                    <p class="mt-2">A bright search experience helps customers find products quickly.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
