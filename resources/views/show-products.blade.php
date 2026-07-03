@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <header class="rounded-[36px] bg-[#FFF3E8] p-8 shadow-[0_30px_80px_rgba(255,115,27,0.12)] ring-1 ring-[#F9D1B0]">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div class="space-y-6">
                <p class="text-sm uppercase tracking-[0.3em] text-[#E85F05]">Orange marketplace</p>
                <h1 class="max-w-3xl text-5xl font-semibold tracking-tight text-[#2B1F14] sm:text-6xl">Browse all products</h1>
                <p class="max-w-2xl text-base leading-8 text-[#59432A]">Discover curated products in a warm, polished listing page with full descriptions available in a modal.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#products" class="inline-flex items-center justify-center rounded-3xl bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8F3A]">Browse products</a>
                    <a href="/" class="inline-flex items-center justify-center rounded-3xl border border-[#F5B16A] bg-white px-6 py-4 text-sm font-semibold text-[#9D5A21] transition hover:bg-[#FFF0D8]">Back home</a>
                </div>
            </div>

            <div class="grid gap-4 rounded-[32px] bg-white p-6 shadow-[0_16px_56px_rgba(255,125,36,0.12)] ring-1 ring-[#F5C29A]">
                <div class="flex items-center gap-3 rounded-3xl bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center rounded-3xl bg-[#FF8F3A] text-white">1</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Product gallery</p>
                        <p class="text-sm text-[#806044]">Browse all available products in a clean, responsive layout.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-3xl bg-[#FFF0D8] p-5">
                    <div class="grid h-14 w-14 place-items-center rounded-3xl bg-[#FFB03D] text-white">2</div>
                    <div>
                        <p class="text-sm font-semibold text-[#3C2410]">Quick details</p>
                        <p class="text-sm text-[#806044]">Open the full description in a modal without leaving the page.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="products" class="space-y-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Products</p>
                <h2 class="mt-3 text-3xl font-semibold text-[#2B1F14]">All items</h2>
            </div>
            <div class="text-sm text-[#7D5A37]">Showing {{ $products->count() }} products.</div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="overflow-hidden rounded-[32px] bg-white shadow-[0_22px_60px_rgba(255,128,41,0.12)] ring-1 ring-[#F9D7BB] transition hover:-translate-y-1">
                    <div class="relative overflow-hidden bg-[#FFF7ED]">
                        @if ($product->image_url)
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="h-64 w-full object-cover" loading="lazy" />
                        @else
                            <div class="flex h-64 items-center justify-center text-center text-sm text-[#A27B43]">
                                <div class="space-y-3">
                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FFE3C2] text-[#E05A00]">IMG</div>
                                    <p class="font-semibold">Placeholder image</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-4 p-6">
                        <span class="inline-flex rounded-full bg-[#FFF0D8] px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-[#D15E00]">{{ $product->category ?? 'Uncategorized' }}</span>
                        <div class="space-y-2">
                            <h3 class="text-xl font-semibold text-[#2B1F14]">{{ $product->name }}</h3>
                            <p class="text-sm leading-6 text-[#6D5536]">{{ Illuminate\Support\Str::limit($product->description ?? 'No description available.', 100) }}</p>
                        </div>
                        <div class="flex items-center justify-between text-sm text-[#2B1F14]">
                            <span class="font-semibold">${{ number_format($product->price, 2) }}</span>
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

<button type="button"
        class="rounded-full bg-[#FF7A18] px-4 py-2 text-white transition hover:bg-[#FF8F3A]"
        data-product='@json($productData, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)'
        onclick="openProductModal(this.dataset.product)">
    View product
</button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="grid gap-6 lg:grid-cols-[1fr_330px]">
        <div class="rounded-[32px] bg-[#FFF1DE] p-8 shadow-[0_24px_80px_rgba(255,122,29,0.12)] ring-1 ring-[#F6D0A0]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Why shop with us</p>
            <h2 class="mt-4 text-3xl font-semibold text-[#2B1F14]">A warm product browsing experience.</h2>
            <ul class="mt-6 space-y-4 text-base leading-7 text-[#5D4A2D]">
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Responsive product cards built with your marketplace palette.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Modal details let shoppers read full descriptions without leaving the page.</li>
                <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-[#FF7A18] text-xs font-semibold text-white">✓</span>Clean, modern layout with bright orange accents and soft shadows.</li>
            </ul>
        </div>

        <div class="rounded-[32px] bg-white p-6 shadow-[0_20px_60px_rgba(255,132,41,0.12)] ring-1 ring-[#F5C29A]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E65800]">Quick facts</p>
            <div class="mt-6 space-y-4 text-sm text-[#6D5536]">
                <div class="rounded-[24px] bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Live inventory</p>
                    <p class="mt-2">See stock counts and pricing clearly on every product card.</p>
                </div>
                <div class="rounded-[24px] bg-[#FFF6ED] p-5">
                    <p class="font-semibold text-[#2B1F14]">Simple product browsing</p>
                    <p class="mt-2">A lightweight shopping experience that feels polished and modern.</p>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="product-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="w-full max-w-4xl overflow-hidden rounded-[32px] bg-white p-6 shadow-[0_25px_80px_rgba(0,0,0,0.18)]">
        <div class="flex flex-col gap-4 border-b border-[#F2CFA4] pb-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-[#E05A00]">Product details</p>
                <h2 id="modal-title" class="mt-3 text-2xl font-semibold text-[#2B1F14]"></h2>
            </div>
            <button type="button" class="rounded-full border border-[#F5C38B] px-4 py-2 text-sm font-semibold text-[#7D5A37] transition hover:bg-[#FFF0D8]" onclick="closeProductModal()">Close</button>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_1.1fr] mt-6">
            <div class="overflow-hidden rounded-[28px] bg-[#FFF7ED] p-4">
                <div id="modal-image-wrapper" class="relative aspect-[4/3] overflow-hidden rounded-[24px] bg-[#FFE9BF]">
                    <img id="modal-image" class="hidden h-full w-full object-cover" src="" alt="" />
                    <div id="modal-image-fallback" class="flex h-full flex-col items-center justify-center gap-3 text-center text-[#A27B43]">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-[#FFE3C2] text-[#E05A00]">IMG</div>
                        <p class="text-sm font-semibold">Placeholder image</p>
                        <p class="max-w-xs text-xs text-[#8F6331]">Upload a product image later to replace this placeholder.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                    <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Category</p>
                    <p id="modal-category" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Price</p>
                        <p id="modal-price" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                    </div>
                    <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Stock</p>
                        <p id="modal-inventory" class="mt-2 text-lg font-semibold text-[#2B1F14]"></p>
                    </div>
                </div>
                <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
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
