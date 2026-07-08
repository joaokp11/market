@extends('layouts.app')

@section('content')
@php
    $cartQuantity = $cartQuantity ?? 0;
    $cartTotal = $cartTotal ?? 0;
@endphp

<div class="space-y-12">
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
                <a href="#collections" class="px-4 py-3 text-sm font-semibold text-[#5B4631] transition hover:bg-[#1F1B16] hover:text-white">Products</a>
                <a href="#workflow" class="px-4 py-3 text-sm font-semibold text-[#5B4631] transition hover:bg-[#1F1B16] hover:text-white">Workflow</a>
                <a href="{{ route('products.index') }}" class="px-4 py-3 text-sm font-semibold text-[#5B4631] transition hover:bg-[#1F1B16] hover:text-white">Shop</a>
                <a href="{{ route('checkout') }}" class="px-4 py-3 text-sm font-semibold text-[#5B4631] transition hover:bg-[#1F1B16] hover:text-white">Cart ({{ $cartQuantity }})</a>
                <a href="/admin/dashboard" class="ml-2 inline-flex items-center gap-2 bg-[#1F1B16] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#FF7A18]">
                    <svg class="h-4 w-4 animate-market-float" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 13h8V3H3v10Z" />
                        <path d="M13 21h8V3h-8v18Z" />
                        <path d="M3 21h8v-6H3v6Z" />
                    </svg>
                    Dashboard
                </a>
            </div>

            <details class="relative md:hidden">
                <summary class="list-none bg-[#1F1B16] px-4 py-3 text-sm font-bold text-white marker:hidden">Menu</summary>
                <div class="absolute right-0 mt-3 grid w-56 border border-[#D6C0A8] bg-white shadow-[8px_8px_0_rgba(31,27,22,0.08)]">
                    <a href="#collections" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Products</a>
                    <a href="#workflow" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Workflow</a>
                    <a href="{{ route('products.index') }}" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Shop</a>
                    <a href="{{ route('checkout') }}" class="border-b border-[#EFE0CF] px-4 py-3 text-sm font-semibold">Cart ({{ $cartQuantity }})</a>
                    <a href="/admin/dashboard" class="px-4 py-3 text-sm font-semibold text-[#C64E00]">Dashboard</a>
                </div>
            </details>
        </nav>
    </header>

    <header class="border border-[#D6C0A8] bg-[#FFF9F1] p-8 shadow-[14px_14px_0_rgba(31,27,22,0.08)]">
        <div class="grid gap-8 lg:grid-cols-[1.02fr_0.98fr] lg:items-center">
            <div class="space-y-6">
                <p class="text-sm uppercase tracking-[0.3em] text-[#E85F05]">Orange marketplace</p>
                <h1 class="max-w-3xl text-5xl font-semibold tracking-tight text-[#2B1F14] sm:text-6xl">Browse all products</h1>
                <p class="max-w-2xl text-base leading-8 text-[#59432A]">Discover curated products in a warm, polished listing page with full descriptions available in a modal.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#products" class="inline-flex items-center justify-center bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8F3A]">Browse products</a>
                    <a href="/" class="inline-flex items-center justify-center border border-[#F5B16A] bg-white px-6 py-4 text-sm font-semibold text-[#9D5A21] transition hover:bg-[#FFF0D8]">Back home</a>
                </div>
            </div>
            <div class="grid gap-4 bg-white p-6 shadow-[0_16px_56px_rgba(255,125,36,0.12)] ring-1 ring-[#F5C29A]">
                <div class="flex items-center gap-3 bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center bg-[#FF8F3A] text-white">1</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Product gallery</p>
                        <p class="text-sm text-[#806044]">Browse all available products in a clean, responsive layout.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center bg-[#FFB03D] text-white">2</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Quick details</p>
                        <p class="text-sm text-[#806044]">Open the full description in a modal without leaving the page.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="products" class="space-y-8">
        @if (session('success'))
            <div class="border border-[#D6C0A8] bg-white p-4 text-sm font-bold text-[#1F1B16] shadow-[8px_8px_0_rgba(31,27,22,0.08)]">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4 border border-[#D6C0A8] bg-[#1F1B16] p-5 text-white shadow-[10px_10px_0_rgba(31,27,22,0.10)] md:grid-cols-[1fr_auto] md:items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-[#FFB47B]">Cart status</p>
                <p class="mt-2 text-2xl font-black">{{ $cartQuantity }} {{ Str::plural('item', $cartQuantity) }} selected</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <span class="bg-white px-5 py-3 text-sm font-black text-[#1F1B16]">Total: ${{ number_format($cartTotal, 2) }}</span>
                <a href="{{ route('checkout') }}" class="bg-[#FF7A18] px-5 py-3 text-sm font-black text-white transition hover:bg-white hover:text-[#1F1B16]">Checkout</a>
            </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Products</p>
                @include('components.searchbar')
                <h2 class="mt-3 text-3xl font-semibold text-[#2B1F14]">All items</h2>
            </div>
            <div class="text-sm text-[#7D5A37]">Showing {{ $products->count() }} products.</div>
        </div>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="group overflow-hidden border border-[#D6C0A8] bg-white transition duration-300 hover:-translate-y-1 hover:shadow-[10px_10px_0_rgba(255,122,24,0.22)]">
                    <div class="relative aspect-[4/3] overflow-hidden bg-[#EFE0CF]">
                        @if ($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                        @else
                            <div class="flex h-64 items-center justify-center text-center text-sm text-[#A27B43]">
                                <div class="space-y-3">
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center bg-[#FFE3C2] text-[#E05A00]">IMG</div>
                                    <p class="font-semibold">Placeholder image</p>
                                </div>
                            </div>
                        @endif
                        <span class="absolute left-3 top-3 bg-[#1F1B16] px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-white">{{ $product->category ?? 'Uncategorized' }}</span>
                    </div>
                    <div class="space-y-4 p-5">
                        <div>
                            <h3 class="text-xl font-black text-[#1F1B16]">{{ $product->name }}</h3>
                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-[#6D5536]">{{ $product->description }}</p>
                        </div>
                        <div class="flex items-center justify-between gap-3 border-t border-[#EFE0CF] pt-4 text-sm text-[#1F1B16]">
                            <span class="font-black">${{ number_format($product->price, 2) }}</span>
                            @php
                        $productData = [
                        'name' => $product->name,
                        'category' => $product->category,
                        'price' => number_format($product->price, 2),
                        'inventory' => $product->inventory,
                        'description' => $product->description ?: 'No description available.',
                        'image' => $product->image_url ? asset('storage/' . $product->image_url) : null,
                        ];
            @endphp

                            <div class="flex flex-wrap items-center gap-2">
                                <button type="button"
                                        class="inline-flex items-center gap-2 bg-[#FF7A18] px-4 py-2 text-xs font-black text-white transition hover:bg-[#1F1B16]"
                                        data-product='@json($productData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)'
                                        onclick="openProductModal(this.dataset.product)">
                                    View
                                    <svg class="h-3.5 w-3.5 transition group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14" />
                                        <path d="m13 6 6 6-6 6" />
                                    </svg>
                                </button>
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <label class="sr-only" for="quantity-{{ $product->id }}">Quantity for {{ $product->name }}</label>
                                    <input id="quantity-{{ $product->id }}" type="number" name="quantity" min="1" max="{{ max(1, $product->inventory) }}" value="1" class="h-9 w-16 border border-[#D6C0A8] bg-white px-2 text-center text-xs font-black text-[#1F1B16] outline-none focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" {{ $product->inventory < 1 ? 'disabled' : '' }} />
                                    <button type="submit" class="inline-flex h-9 items-center justify-center bg-[#1F1B16] px-4 text-xs font-black uppercase tracking-[0.18em] text-white transition hover:bg-[#FF7A18] disabled:cursor-not-allowed disabled:bg-[#8A6B4E]" {{ $product->inventory < 1 ? 'disabled' : '' }}>
                                        {{ $product->inventory < 1 ? 'Out' : 'Add to cart' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[1fr_330px]">
        <div class="border border-[#D6C0A8] bg-[#FFF1DE] p-8 shadow-[0_24px_80px_rgba(255,122,29,0.12)] ring-1 ring-[#F6D0A0]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Why shop with us</p>
            <h2 class="mt-4 text-3xl font-semibold text-[#2B1F14]">A warm product browsing experience.</h2>
            <ul class="mt-6 space-y-4 text-base leading-7 text-[#5D4A2D]">
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Responsive product cards built with your marketplace palette.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Modal details let shoppers read full descriptions without leaving the page.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Clean, modern layout with bright orange accents and soft shadows.</li>
            </ul>
        </div>

        <div class="bg-white p-6 shadow-[0_20px_60px_rgba(255,132,41,0.12)] ring-1 ring-[#F5C29A]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Quick facts</p>
            <div class="mt-6 space-y-4 text-sm text-[#6D5536]">
                <div class="bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Live inventory</p>
                    <p class="mt-2">See stock counts and pricing clearly on every product card.</p>
                </div>
                <div class="bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Simple product browsing</p>
                    <p class="mt-2">A lightweight shopping experience that feels polished and modern.</p>
                </div>
            </div>
        </div>
    </section>
</div>

    <div id="product-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-4xl overflow-hidden bg-white p-6 shadow-[0_25px_80px_rgba(0,0,0,0.18)]">
        <div class="flex flex-col gap-4 border-b border-[#F2CFA4] pb-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-[#E05A00]">Product details</p>
                <h2 id="modal-title" class="mt-3 text-2xl font-semibold text-[#2B1F14]"></h2>
            </div>
            <button type="button" class="border border-[#F5C38B] px-4 py-2 text-sm font-semibold text-[#7D5A37] transition hover:bg-[#FFF0D8]" onclick="closeProductModal()">Close</button>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_1.1fr] mt-6">
            <div class="bg-[#FFF7ED] p-4">
                <div id="modal-image-wrapper" class="relative aspect-[4/3] overflow-hidden bg-[#FFE9BF]">
                    <img id="modal-image" class="hidden h-full w-full object-cover" src="" alt="" />
                    <div id="modal-image-fallback" class="flex h-full flex-col items-center justify-center gap-3 text-center text-[#A27B43]">
                        <div class="inline-flex h-16 w-16 items-center justify-center bg-[#FFE3C2] text-[#E05A00]">IMG</div>
                        <p class="text-sm font-semibold">Placeholder image</p>
                        <p class="max-w-xs text-xs text-[#8F6331]">Upload a product image later to replace this placeholder.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Category</p>
                    <p id="modal-category" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Price</p>
                        <p id="modal-price" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                    </div>
                    <div class="bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Stock</p>
                        <p id="modal-inventory" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                    </div>
                </div>
                <div class="bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Description</p>
                    <p id="modal-description" class="mt-2 text-sm leading-7 text-[#6D5536]"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openProductModal(productJson) {
        const product = typeof productJson === 'string' ? JSON.parse(productJson) : productJson;

        document.getElementById('modal-title').textContent = product.name;
        document.getElementById('modal-category').textContent = product.category || 'Uncategorized';
        document.getElementById('modal-price').textContent = product.price ? `$${product.price}` : '-';
        document.getElementById('modal-inventory').textContent = product.inventory ? `${product.inventory} units` : 'Out of stock';
        document.getElementById('modal-description').textContent = product.description;

        const image = document.getElementById('modal-image');
        const fallback = document.getElementById('modal-image-fallback');

        if (product.image) {
            image.src = product.image;
            image.alt = product.name;
            image.classList.remove('hidden');
            fallback.classList.add('hidden');
        } else {
            image.classList.add('hidden');
            fallback.classList.remove('hidden');
        }

        document.getElementById('product-modal').classList.remove('hidden');
    }

    function closeProductModal() {
        document.getElementById('product-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeProductModal();
        }
    });
</script>
@endsection
