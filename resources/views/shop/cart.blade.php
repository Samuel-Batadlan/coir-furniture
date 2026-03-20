@extends('layouts.app')
@section('title', 'Cart — CoirFurnitures')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416] mb-6">Your Cart</h1>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-4">{{ session('success') }}</div>
    @endif

    @if ($items->isEmpty())
        <div class="bg-white rounded-2xl border border-[#E8E0D5] p-12 text-center text-[#9C8B75]">
            <p class="text-lg mb-4">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}"
                class="inline-block bg-[#4A6741] text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-[#3A5232] transition">
                Browse Products
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Items --}}
            <div class="lg:col-span-2 space-y-3">
                @foreach ($items as $item)
                    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-4 flex flex-col sm:flex-row gap-4 items-start sm:items-center">
                        <div class="h-18 w-18 bg-[#F5EFE6] rounded-xl overflow-hidden flex-shrink-0" style="width:72px;height:72px;">
                            @if ($item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-xs">No img</div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="text-xs text-[#9C8B75] uppercase tracking-wider">{{ $item->product->category }}</p>
                            <h3 style="font-family: 'Playfair Display', serif;" class="font-semibold text-[#2C2416] text-sm">{{ $item->product->name }}</h3>
                            <p class="text-[#4A6741] font-bold text-sm mt-0.5">₱{{ number_format($item->product->price, 2) }}</p>
                        </div>
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2">
                            @csrf @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                class="w-14 border border-[#D5C9B8] rounded-lg px-2 py-1 text-sm text-center focus:outline-none focus:ring-2 focus:ring-[#4A6741]">
                            <button type="submit" class="text-xs text-[#4A6741] border border-[#4A6741] px-2 py-1 rounded-lg hover:bg-[#4A6741] hover:text-white transition">Update</button>
                        </form>
                        <form method="POST" action="{{ route('cart.remove', $item) }}">
                            @csrf @method('DELETE')
                            <button class="text-xs text-[#B85C38] hover:text-[#8B3A1F] transition">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Summary --}}
            <div class="bg-white rounded-2xl border border-[#E8E0D5] p-5 h-fit">
                <h2 style="font-family: 'Playfair Display', serif;" class="text-lg font-bold text-[#2C2416] mb-4">Order Summary</h2>
                <div class="space-y-2 text-sm text-[#5C4F3D] mb-4">
                    @foreach ($items as $item)
                        <div class="flex justify-between">
                            <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span>₱{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-[#E8E0D5] pt-3 flex justify-between font-bold text-[#2C2416] mb-4">
                    <span>Total</span>
                    <span>₱{{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('checkout.index') }}"
                    class="block text-center w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-bold py-2.5 rounded-full text-sm transition">
                    Proceed to Checkout
                </a>
                <a href="{{ route('shop.index') }}" class="block text-center text-sm text-[#4A6741] hover:underline mt-2">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif
</div>

@endsection