@extends('layouts.app')
@section('title', $product->name . ' — CoirFurnitures')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-1 text-sm text-[#5C4F3D] hover:text-[#4A6741] transition-colors mb-6">
        ← Back to Shop
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

        {{-- Image --}}
        <div class="bg-[#F5EFE6] rounded-2xl overflow-hidden aspect-square border border-[#E8E0D5]">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-5xl">🪑</div>
            @endif
        </div>

        {{-- Details --}}
        <div class="py-2">
            <div class="flex items-center gap-2 mb-2">
                <span class="text-xs text-[#9C8B75] uppercase tracking-wider font-medium">{{ $product->category }}</span>
                @if ($product->is_featured)
                    <span class="bg-[#4A6741] text-white text-xs font-semibold px-2 py-0.5 rounded-full">Featured</span>
                @endif
            </div>

            <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl lg:text-4xl font-bold text-[#2C2416] leading-tight mb-3">
                {{ $product->name }}
            </h1>

            <p class="text-2xl font-bold text-[#4A6741] mb-4">₱{{ number_format($product->price, 2) }}</p>

            <p class="text-[#5C4F3D] leading-relaxed mb-5 text-sm">{{ $product->description }}</p>

            {{-- Stock --}}
            <div class="flex items-center gap-2 mb-6">
                @if ($product->stock > 5)
                    <span class="w-2 h-2 rounded-full bg-[#4A6741] inline-block"></span>
                    <span class="text-sm text-[#4A6741] font-medium">In Stock ({{ $product->stock }} available)</span>
                @elseif ($product->stock > 0)
                    <span class="w-2 h-2 rounded-full bg-[#B85C38] inline-block"></span>
                    <span class="text-sm text-[#B85C38] font-medium">Low Stock — only {{ $product->stock }} left</span>
                @else
                    <span class="w-2 h-2 rounded-full bg-gray-400 inline-block"></span>
                    <span class="text-sm text-gray-400 font-medium">Out of Stock</span>
                @endif
            </div>

            {{-- Add to Cart --}}
            @auth
                @if ($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center gap-3 mb-4">
                            <label class="text-sm font-medium text-[#5C4F3D]">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                class="w-20 border border-[#D5C9B8] rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]">
                        </div>
                        <button type="submit"
                            class="w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-bold py-3 rounded-full text-sm transition-all duration-200">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-[#E8E0D5] text-[#9C8B75] font-semibold py-3 rounded-full text-sm cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="block text-center w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-bold py-3 rounded-full text-sm transition-all duration-200">
                    Log in to Add to Cart
                </a>
            @endauth

            {{-- Tags --}}
            <div class="mt-6 pt-5 border-t border-[#E8E0D5]">
                <p class="text-xs text-[#9C8B75] uppercase tracking-wider font-medium mb-2">Materials</p>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-[#F5EFE6] text-[#5C4F3D] text-xs px-3 py-1 rounded-full border border-[#E8E0D5]">🌿 Coconut Coir Fiber</span>
                    <span class="bg-[#F5EFE6] text-[#5C4F3D] text-xs px-3 py-1 rounded-full border border-[#E8E0D5]">♻️ Eco-Friendly</span>
                    <span class="bg-[#F5EFE6] text-[#5C4F3D] text-xs px-3 py-1 rounded-full border border-[#E8E0D5]">🇵🇭 Made in PH</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection