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
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between bg-white px-4 py-3 text-sm font-black text-[#1F1B16]">
                    Products
                    <span class="h-2 w-2 bg-[#FF7A18] animate-market-pulse"></span>
                </a>
                <a href="{{ route('admin.products.create') }}" class="flex items-center justify-between border border-white/15 px-4 py-3 text-sm font-semibold text-white/75 transition hover:bg-white hover:text-[#1F1B16]">Create</a>
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
                    <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Product inventory</p>
                    <h1 class="mt-3 text-4xl font-black tracking-tight text-[#1F1B16]">Current products</h1>
                    <p class="mt-3 max-w-2xl text-base leading-7 text-[#6A4A2D]">View, edit, and remove marketplace listings from the same operational workspace as the dashboard.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a class="inline-flex items-center gap-2 bg-[#FF7A18] px-5 py-3 text-sm font-black text-white transition hover:bg-[#1F1B16]" href="{{ route('admin.products.create') }}">
                        <svg class="h-4 w-4 animate-market-float" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create product
                    </a>
                    <a class="inline-flex items-center border border-[#BFA98F] bg-white px-5 py-3 text-sm font-black text-[#1F1B16] transition hover:border-[#1F1B16]" href="{{ url('/') }}">View store</a>
                </div>
            </div>
        </header>

        @if (session('success'))
            <div class="border border-[#D6C0A8] bg-white p-4 text-sm font-bold text-[#1F1B16]">
                {{ session('success') }}
            </div>
        @endif

        <section class="grid gap-4 md:grid-cols-3">
            <div class="border border-[#D6C0A8] bg-white p-5">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#8A6B4E]">Products</p>
                <p class="mt-3 text-4xl font-black text-[#1F1B16]">{{ $productCount }}</p>
            </div>
            <div class="border border-[#D6C0A8] bg-white p-5">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#8A6B4E]">Units in stock</p>
                <p class="mt-3 text-4xl font-black text-[#1F1B16]">{{ $inventoryTotal }}</p>
            </div>
            <div class="border border-[#D6C0A8] bg-white p-5">
                <p class="text-xs font-bold uppercase tracking-[0.24em] text-[#8A6B4E]">Low stock</p>
                <p class="mt-3 text-4xl font-black text-[#C64E00]">{{ $lowStockCount }}</p>
            </div>
        </section>

        <section class="border border-[#D6C0A8] bg-white">
            <div class="flex flex-col gap-3 border-b border-[#D6C0A8] p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.3em] text-[#C64E00]">Product inventory</p>
                    <h2 class="mt-2 text-2xl font-black text-[#1F1B16]">Current products</h2>
                </div>
                <div class="text-sm font-semibold text-[#7D5A37]">Showing {{ $productCount }} products</div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[760px] w-full divide-y divide-[#EFE0CF] text-left text-sm">
                    <thead class="bg-[#FFF8EF] text-[#6A4A2D]">
                        <tr>
                            <th class="px-4 py-3 font-black">Product</th>
                            <th class="px-4 py-3 font-black">Category</th>
                            <th class="px-4 py-3 font-black">Price</th>
                            <th class="px-4 py-3 font-black">Stock</th>
                            <th class="px-4 py-3 font-black">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EFE0CF] bg-white text-[#4B3420]">
                        @foreach ($products as $product)
                            <tr class="transition hover:bg-[#FFF8EF]">
                                <td class="px-4 py-4 font-bold text-[#1F1B16]">{{ $product->name }}</td>
                                <td class="px-4 py-4">{{ $product->category }}</td>
                                <td class="px-4 py-4">{{ $product->price }}</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex min-w-12 justify-center border px-2 py-1 text-xs font-black {{ $product->inventory <= 5 ? 'border-[#FF7A18] bg-[#FFF1E5] text-[#C64E00]' : 'border-[#D6C0A8] bg-white text-[#1F1B16]' }}">{{ $product->inventory }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="inline-flex items-center bg-[#1F1B16] px-3 py-2 text-xs font-black text-white transition hover:bg-[#FF7A18]">View</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="inline-flex items-center border border-[#D6C0A8] bg-white px-3 py-2 text-xs font-black text-[#1F1B16] transition hover:border-[#1F1B16]">Edit</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center bg-[#B42318] px-3 py-2 text-xs font-black text-white transition hover:bg-[#7A1210]">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
@endsection
