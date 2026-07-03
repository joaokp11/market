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
            <button type="button" class="inline-flex items-center justify-center rounded-3xl bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8B35]">+ Create product</button>
        </div>
    </header>

    <section class="grid gap-6 lg:grid-cols-2">
               <div class="rounded-[32px] bg-[#FFF7ED] p-6 shadow-[0_20px_60px_rgba(255,132,41,0.1)] ring-1 ring-[#F6D0A0]">
            <p class="text-sm uppercase tracking-[0.3em] text-[#E05A00]">Edit product</p>
            <h3 class="mt-3 text-2xl font-semibold text-[#2B1F14]">Update an existing item</h3>
            <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Product name</label>
                    <input type="text" placeholder="Enter product name" class="w-full rounded-3xl border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" value="{{ old('name', $product->name) }}" name='name'/>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Updated price</label>
                    <input type="text" placeholder="$0.00" class="w-full rounded-3xl border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" value="{{ old('price', $product->price) }}" name='price'/>
                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                        <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Category</label>
                        <input type="text" name="category" placeholder="Category" class="w-full rounded-3xl border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" value="{{ old('category', $product->category) }}" name='category'/>
                            @error('category')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Inventory</label>
                    <input type="text" placeholder="Enter stock" class="w-full rounded-3xl border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" value="{{ old('inventory', $product->inventory) }}" name='inventory'/>
                    @error('inventory')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Description</label>
                    <textarea rows="4" name="description" placeholder="Write a short description" class="w-full rounded-[24px] border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" value="">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-[#6A4A2D]">Product image</label>
                    <input type="file" name="image" class="w-full rounded-3xl border border-[#F2CFA4] bg-white px-4 py-3 text-sm outline-none focus:border-[#FF7A18] focus:ring-4 focus:ring-[#FF7A1833]" />
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="rounded-3xl bg-[#FF7A18] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#FF8B35]">Update product</button>
            </form>
        </div>
    </section>
</div>
@endsection
