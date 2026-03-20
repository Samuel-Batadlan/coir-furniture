@extends('layouts.app')
@section('title', 'My Orders — CoirFurnitures')
@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416] mb-6">My Orders</h1>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <div class="bg-white rounded-2xl border border-[#E8E0D5] p-12 text-center text-[#9C8B75]">
            <p class="text-lg mb-4">No orders yet.</p>
            <a href="{{ route('shop.index') }}"
                class="inline-block bg-[#4A6741] text-white text-sm font-semibold px-6 py-2.5 rounded-full hover:bg-[#3A5232] transition">
                Start Shopping
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                @php
                    $statusColor = match($order->status) {
                        'Pending'    => 'bg-yellow-100 text-yellow-700',
                        'Processing' => 'bg-blue-100 text-blue-700',
                        'Completed'  => 'bg-green-100 text-green-700',
                        'Cancelled'  => 'bg-red-100 text-red-700',
                        default      => 'bg-gray-100 text-gray-600',
                    };
                    $paymentColor = match($order->payment_status ?? 'Unpaid') {
                        'Unpaid'               => 'bg-red-100 text-red-700',
                        'Pending Verification' => 'bg-yellow-100 text-yellow-700',
                        'Paid'                 => 'bg-green-100 text-green-700',
                        default                => 'bg-gray-100 text-gray-600',
                    };
                @endphp

                <div class="bg-white rounded-2xl border border-[#E8E0D5] p-5">

                    {{-- Order Header --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                        <div>
                            <p class="font-semibold text-[#2C2416] text-sm">Order #{{ $order->id }}</p>
                            <p class="text-xs text-[#9C8B75]">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                        </div>
                        <div class="flex items-center flex-wrap gap-2">
                            <span class="font-bold text-[#4A6741]">₱{{ number_format($order->total, 2) }}</span>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $statusColor }}">
                                {{ $order->status }}
                            </span>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $paymentColor }}">
                                {{ $order->payment_status ?? 'Unpaid' }}
                            </span>
                        </div>
                    </div>

                    {{-- Order Details --}}
                    <div class="text-xs text-[#9C8B75] flex flex-wrap gap-3 mb-3">
                        <span>💳 {{ $order->payment_method }}</span>
                        <span>📦 {{ $order->delivery_method }}</span>
                        @if ($order->delivery_address)
                            <span>📍 {{ $order->delivery_address }}</span>
                        @endif
                        @if ($order->payment_reference)
                            <span>🔖 Ref: <strong class="text-[#5C4F3D]">{{ $order->payment_reference }}</strong></span>
                        @endif
                    </div>

                    {{-- Items --}}
                    <div class="space-y-2 border-t border-[#F0E9DF] pt-3">
                        @foreach ($order->items as $item)
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-[#F5EFE6] rounded-lg overflow-hidden flex-shrink-0">
                                    @if ($item->product->image)
                                        <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-xs">—</div>
                                    @endif
                                </div>
                                <div class="flex-1 text-sm text-[#5C4F3D]">
                                    {{ $item->product->name }}
                                    <span class="text-[#9C8B75]">x{{ $item->quantity }}</span>
                                </div>
                                <span class="text-sm font-medium text-[#2C2416]">
                                    ₱{{ number_format($item->price * $item->quantity, 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Payment Action --}}
                    @if (in_array($order->payment_method, ['GCash', 'BDO Online Banking']) && ($order->payment_status ?? 'Unpaid') === 'Unpaid')
                        <div class="mt-4 pt-3 border-t border-[#F0E9DF]">
                            <a href="{{ route('payment.show', $order) }}"
                                class="inline-block bg-[#4A6741] hover:bg-[#3A5232] text-white text-xs font-semibold px-5 py-2 rounded-full transition">
                                Complete Payment
                            </a>
                            <p class="text-xs text-[#9C8B75] mt-1">Your payment is pending. Click to view payment details.</p>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection