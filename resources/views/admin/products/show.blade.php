@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <header class="rounded-[36px] bg-[#FFF3E8] p-8 shadow-[0_24px_70px_rgba(255,122,24,0.14)] ring-1 ring-[#F5C38B]">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-[#E05A00]">Admin dashboard</p>
                <h1 class="mt-3 text-4xl font-semibold tracking-tight text-[#2B1F14]">Manage products with ease</h1>
                <p class="mt-3 max-w-2xl text-base leading-7 text-[#6A4A2D]">A polished admin view for viewing, creating, and editing marketplace products without touching controllers or models.</p>
            </div>
            <a class="inline-flex items-center justify-center rounded-3xl bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8B35]" href="{{ route('admin.products.index') }}">Back to products</a>
        </div>
    </header>

    <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-[32px] bg-white p-6 shadow-[0_20px_60px_rgba(255,132,41,0.12)] ring-1 ring-[#F5C29A]">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-[#E05A00]">Product details</p>
                    <h2 class="mt-2 text-2xl font-semibold text-[#2B1F14]">{{ $product->name }}</h2>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="rounded-full bg-[#FFF0D8] px-4 py-2 text-sm font-semibold text-[#C35F00] transition hover:bg-[#FFE3C2]">Edit</a>
                    <a href="{{ route('admin.products.index') }}" class="rounded-full border border-[#F2CFA4] px-4 py-2 text-sm font-semibold text-[#7D5A37] transition hover:bg-[#FFF7ED]">Back</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-full bg-[#FF0000] px-3 py-2 text-xs font-semibold text-white">Delete</button>
                </div>
            </div>

            <div class="mt-6 grid gap-6 md:grid-cols-[240px_minmax(0,1fr)]">
                <div class="flex aspect-square items-center justify-center overflow-hidden rounded-[28px] border border-[#F6D0A0] bg-[#FFF7ED] p-4 text-center">
                    
                            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('images/placeholder.png') }}" alt="{{ $product->name }}" class="object-cover" />
                        </div>
                       
                   

                <div class="space-y-4">
                    <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Category</p>
                        <p class="mt-2 text-lg font-semibold text-[#2B1F14]">{{ $product->category ?? 'Uncategorized' }}</p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Price</p>
                            <p class="mt-2 text-lg font-semibold text-[#2B1F14]">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                            <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Stock</p>
                            <p class="mt-2 text-lg font-semibold text-[#2B1F14]">{{ $product->inventory }} units</p>
                        </div>
                    </div>

                    <div class="rounded-[24px] bg-[#FFF7ED] p-4 ring-1 ring-[#F6D0A0]">
                        <p class="text-xs uppercase tracking-[0.25em] text-[#E05A00]">Description</p>
                        <p class="mt-2 text-sm leading-7 text-[#6A4A2D]">
                            {{ $product->description ?? 'No description provided for this product yet.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

