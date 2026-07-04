@extends('layouts.app')

@section('content')
@php
    $productCount = count($products);
    $inventoryTotal = $products->sum('inventory');
    $lowStockCount = $products->filter(fn ($product) => $product->inventory <= 5)->count();
@endphp

<div class="grid gap-5 lg:grid-cols-[280px_1fr]">
    <aside class="lg:sticky lg:top-5 lg:self-start">
        <div class="border border-[#D6C0A8] bg-[#1F1B16] p-5 text-white shadow-[10px_10px_0_rgba(31,27,22,0.10)]">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-sm font-black uppercase tracking-[0.2em]">
                <span class="grid h-10 w-10 place-items-center bg-[#FF7A18]">
                    <svg class="h-5 w-5 animate-market-draw" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 13h8V3H3v10Z" />
                        <path d="M13 21h8V3h-8v18Z" />
                        <path d="M3 21h8v-6H3v6Z" />
                    </svg>
                </span>
                Admin
            </a>

            <div class="mt-8 space-y-2">
                <a href="/admin/dashboard" class="flex items-center justify-between border border-white/15 px-4 py-3 text-sm font-semibold text-white/75 transition hover:bg-white hover:text-[#1F1B16]">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between border border-white/15 px-4 py-3 text-sm font-semibold text-white/75 transition hover:bg-white hover:text-[#1F1B16]">Products</a>
                <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between bg-white px-4 py-3 text-sm font-black text-[#1F1B16]">
                    Create
                    <span class="h-2 w-2 bg-[#FF7A18] animate-market-pulse"></span>
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center justify-between border border-white/15 px-4 py-3 text-sm font-semibold text-white/75 transition hover:bg-white hover:text-[#1F1B16]">Storefront</a>
            </div>

            <div class="mt-8 border-t border-white/15 pt-5">
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-[#FFB47B]">Quick status</p>
                <div class="mt-4 grid gap-3 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-white/60">Products</span>
                        <span class="font-black">{{ $productCount }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/60">Inventory</span>
                        <span class="font-black">{{ $inventoryTotal }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-white/60">Low stock</span>
                        <span class="font-black text-[#FFB47B]">{{ $lowStockCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="space-y-5">
        <header class="border border-[#D6C0A8] bg-[#FFF9F1] p-6 shadow-[10px_10px_0_rgba(31,27,22,0.08)]">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Create product</p>
                    <h1 class="mt-3 text-4xl font-black tracking-tight text-[#1F1B16]">Add a new item</h1>
                    <p class="mt-3 max-w-2xl text-base leading-7 text-[#6A4A2D]">Create a product record using the same focused admin workspace as the dashboard.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a class="inline-flex items-center bg-[#FF7A18] px-5 py-3 text-sm font-black text-white transition hover:bg-[#1F1B16]" href="{{ route('admin.products.index') }}">All products</a>
                    <a class="inline-flex items-center border border-[#BFA98F] bg-white px-5 py-3 text-sm font-black text-[#1F1B16] transition hover:border-[#1F1B16]" href="{{ url('/') }}">View store</a>
                </div>
            </div>
        </header>

        <section class="border border-[#D6C0A8] bg-white">
            <div class="border-b border-[#D6C0A8] p-5">
                <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Product details</p>
                <h2 class="mt-2 text-2xl font-black text-[#1F1B16]">Listing information</h2>
            </div>

            <form class="space-y-5 p-5" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Product name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter product name" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                    @error('name')
                        <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}" placeholder="Category" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                        @error('category')
                            <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="0.00" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                        @error('price')
                            <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Inventory</label>
                        <input type="number" name="inventory" value="{{ old('inventory') }}" placeholder="10" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                        @error('inventory')
                            <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Description</label>
                    <textarea rows="5" name="description" placeholder="Write a short description" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-[#6A4A2D]">Product image</label>
                    <input type="file" name="image" class="w-full border border-[#D6C0A8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#1F1B16] focus:ring-4 focus:ring-[#FF7A1833]" />
                    @error('image')
                        <p class="mt-2 text-sm font-semibold text-[#B42318]">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-wrap gap-3 border-t border-[#EFE0CF] pt-5">
                    <button type="submit" class="bg-[#FF7A18] px-5 py-3 text-sm font-black text-white transition hover:bg-[#1F1B16]">Save product</button>
                    <a href="{{ route('admin.products.index') }}" class="border border-[#BFA98F] bg-white px-5 py-3 text-sm font-black text-[#1F1B16] transition hover:border-[#1F1B16]">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</div>
@endsection
