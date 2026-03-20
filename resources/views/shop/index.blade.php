@extends('layouts.app')
@section('title', 'Shop — CoirFurnitures')
@section('content')

{{-- Header --}}
<section class="w-full bg-[#2C2416] px-6 py-10">
    <div class="max-w-7xl mx-auto">
        <p class="text-xs text-[#4A6741] font-semibold tracking-widest uppercase mb-1">Our Collection</p>
        <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl lg:text-4xl font-bold text-white">
            All <span class="italic text-[#C4A882]">Products</span>
        </h1>
    </div>
</section>

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Category Filter --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('shop.index') }}"
            class="px-4 py-1.5 rounded-full text-sm font-medium border transition-all duration-200
            {{ !request('category') ? 'bg-[#4A6741] text-white border-[#4A6741]' : 'border-[#D5C9B8] text-[#5C4F3D] hover:border-[#4A6741] bg-white' }}">
            All
        </a>
        @foreach ($categories as $cat)
            <a href="{{ route('shop.index', ['category' => $cat]) }}"
                class="px-4 py-1.5 rounded-full text-sm font-medium border transition-all duration-200
                {{ request('category') == $cat ? 'bg-[#4A6741] text-white border-[#4A6741]' : 'border-[#D5C9B8] text-[#5C4F3D] hover:border-[#4A6741] bg-white' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    {{-- Grid --}}
    @php $filtered = request('category') ? $products->where('category', request('category')) : $products; @endphp

    @if ($filtered->isEmpty())
        <div class="text-center py-20 text-[#9C8B75]">
            <p class="text-xl mb-1">No products found</p>
            <p class="text-sm">Try a different category.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach ($filtered as $product)
                <a href="{{ route('shop.show', $product) }}"
                    class="group bg-white rounded-2xl overflow-hidden border border-[#E8E0D5] hover:border-[#C4A882] hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-[#F5EFE6] overflow-hidden relative">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-4xl">🪑</div>
                        @endif
                        @if ($product->stock == 0)
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <span class="bg-white text-[#2C2416] text-xs font-bold px-3 py-1 rounded-full">Out of Stock</span>
                            </div>
                        @elseif ($product->stock < 5)
                            <div class="absolute top-2 right-2">
                                <span class="bg-[#B85C38] text-white text-xs font-semibold px-2 py-0.5 rounded-full">Low Stock</span>
                            </div>
                        @endif
                        @if ($product->is_featured)
                            <div class="absolute top-2 left-2">
                                <span class="bg-[#4A6741] text-white text-xs font-semibold px-2 py-0.5 rounded-full">Featured</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-[#9C8B75] uppercase tracking-wider mb-0.5">{{ $product->category }}</p>
                        <h3 style="font-family: 'Playfair Display', serif;" class="font-semibold text-[#2C2416] text-sm leading-tight mb-2 group-hover:text-[#4A6741] transition-colors">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between">
                            <p class="text-[#4A6741] font-bold">₱{{ number_format($product->price, 2) }}</p>
                            <span class="text-xs {{ $product->stock > 0 ? 'text-[#9C8B75]' : 'text-[#B85C38]' }}">
                                {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Unavailable' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection