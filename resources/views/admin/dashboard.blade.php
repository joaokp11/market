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
            <a class="inline-flex items-center justify-center rounded-3xl bg-[#FF7A18] px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-[#FF7A1860] transition hover:bg-[#FF8B35]" href='{{ route('admin.products.create') }}'>+ Create product</a>
        </div>
    </header>

    <section class="rounded-[32px] bg-white p-6 shadow-[0_20px_60px_rgba(255,132,41,0.12)] ring-1 ring-[#F5C29A]">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-[#E05A00]">Product inventory</p>
                <h2 class="mt-2 text-2xl font-semibold text-[#2B1F14]">Current products</h2>
            </div>
            <div class="text-sm text-[#7D5A37]">Showing {{ count($products) }} products</div>
        </div>

        <div class="mt-6 overflow-hidden rounded-[24px] border border-[#F6D0A0]">
            <table class="min-w-full divide-y divide-[#FBE6CF] text-left text-sm">
                <thead class="bg-[#FFF7ED] text-[#8F6331]">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Product</th>
                        <th class="px-4 py-3 font-semibold">Category</th>
                        <th class="px-4 py-3 font-semibold">Price</th>
                        <th class="px-4 py-3 font-semibold">Stock</th>
                        <th class="px-4 py-3 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#FBE6CF] bg-white text-[#4B3420]">
                   @foreach ( $products as $product )
                     <tr>
                        <td class="px-4 py-4">{{ $product->name }}</td>
                        <td class="px-4 py-4">{{ $product->category }}</td>
                        <td class="px-4 py-4">{{ $product->price }}</td>
                        <td class="px-4 py-4">{{ $product->inventory }}</td>
                        <td class="px-4 py-4">
                            <div class="flex flex-wrap gap-2">
                                <a href= "{{ route('admin.products.edit', $product->id )}}" class="rounded-full bg-[#FFF0D8] px-3 py-2 text-xs font-semibold text-[#C35F00]">Edit</a>
                                <a class="rounded-full bg-[#FF7A18] px-3 py-2 text-xs font-semibold text-white" href= "{{ route('admin.products.show', $product->id) }}">View</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full bg-[#FF0000] px-3 py-2 text-xs font-semibold text-white">Delete</button>
                            </div>
                        </td>
                    </tr>
                       
                   @endforeach
                    
                </tbody>
            </table>
        </div>
    </section>

</div>
@endsection

