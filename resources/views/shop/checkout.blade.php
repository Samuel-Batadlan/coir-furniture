@extends('layouts.app')
@section('title', 'Checkout — CoirFurnitures')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416] mb-6">Checkout</h1>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-4">

                {{-- Delivery Method --}}
                <div class="bg-white rounded-2xl border border-[#E8E0D5] p-5">
                    <h2 class="font-bold text-[#2C2416] mb-3 text-sm uppercase tracking-wider">Delivery Method</h2>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer flex-1 hover:border-[#4A6741] transition">
                            <input type="radio" name="delivery_method" value="Pickup"
                                {{ old('delivery_method') == 'Pickup' ? 'checked' : '' }}
                                class="accent-[#4A6741]" onchange="toggleAddress(this)">
                            <div>
                                <p class="font-semibold text-sm text-[#2C2416]">Pickup</p>
                                <p class="text-xs text-[#9C8B75]">Pick up at our store</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer flex-1 hover:border-[#4A6741] transition">
                            <input type="radio" name="delivery_method" value="Delivery"
                                {{ old('delivery_method') == 'Delivery' ? 'checked' : '' }}
                                class="accent-[#4A6741]" onchange="toggleAddress(this)">
                            <div>
                                <p class="font-semibold text-sm text-[#2C2416]">Delivery</p>
                                <p class="text-xs text-[#9C8B75]">Delivered to your address</p>
                            </div>
                        </label>
                    </div>
                    <div id="address-field" class="{{ old('delivery_method') == 'Delivery' ? '' : 'hidden' }} mt-3">
                        <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Delivery Address</label>
                        <input type="text" name="delivery_address" value="{{ old('delivery_address') }}"
                            class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]"
                            placeholder="Enter your full delivery address">
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl border border-[#E8E0D5] p-5">
                    <h2 class="font-bold text-[#2C2416] mb-3 text-sm uppercase tracking-wider">Payment Method</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        {{-- Cash on Delivery --}}
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer hover:border-[#4A6741] transition group">
                            <input type="radio" name="payment_method" value="Cash on Delivery"
                                {{ old('payment_method') == 'Cash on Delivery' ? 'checked' : '' }}
                                class="accent-[#4A6741]">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">💵</span>
                                <div>
                                    <p class="font-semibold text-sm text-[#2C2416]">Cash on Delivery</p>
                                    <p class="text-xs text-[#9C8B75]">Pay when you receive</p>
                                </div>
                            </div>
                        </label>

                        {{-- Over the Counter --}}
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer hover:border-[#4A6741] transition group">
                            <input type="radio" name="payment_method" value="Over-the-Counter"
                                {{ old('payment_method') == 'Over-the-Counter' ? 'checked' : '' }}
                                class="accent-[#4A6741]">
                            <div class="flex items-center gap-2">
                                <span class="text-xl">🏪</span>
                                <div>
                                    <p class="font-semibold text-sm text-[#2C2416]">Over-the-Counter</p>
                                    <p class="text-xs text-[#9C8B75]">Pay at our store</p>
                                </div>
                            </div>
                        </label>

                        {{-- GCash --}}
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer hover:border-[#4A6741] transition group">
                            <input type="radio" name="payment_method" value="GCash"
                                {{ old('payment_method') == 'GCash' ? 'checked' : '' }}
                                class="accent-[#4A6741]">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-[#007DFF] flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-black">G</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-[#2C2416]">GCash</p>
                                    <p class="text-xs text-[#9C8B75]">Pay via GCash QR</p>
                                </div>
                            </div>
                        </label>

                        {{-- BDO --}}
                        <label class="flex items-center gap-3 border border-[#E8E0D5] rounded-xl p-3 cursor-pointer hover:border-[#4A6741] transition group">
                            <input type="radio" name="payment_method" value="BDO Online Banking"
                                {{ old('payment_method') == 'BDO Online Banking' ? 'checked' : '' }}
                                class="accent-[#4A6741]">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-[#003087] flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-xs font-black">BDO</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-[#2C2416]">BDO Online Banking</p>
                                    <p class="text-xs text-[#9C8B75]">Bank transfer via BDO</p>
                                </div>
                            </div>
                        </label>

                    </div>
                </div>
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
                <button type="submit"
                    class="w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-bold py-2.5 rounded-full text-sm transition">
                    Place Order
                </button>
                <a href="{{ route('cart.index') }}" class="block text-center text-sm text-[#4A6741] hover:underline mt-2">
                    Back to Cart
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleAddress(radio) {
        document.getElementById('address-field').classList.toggle('hidden', radio.value !== 'Delivery');
    }
</script>

@endsection