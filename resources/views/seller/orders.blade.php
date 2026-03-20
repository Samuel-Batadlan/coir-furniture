@extends('layouts.seller')
@section('title', 'Orders — CoirFurnitures')
@section('content')

<h1 style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416] mb-6">Orders</h1>

@if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-4">{{ session('success') }}</div>
@endif

@if ($orders->isEmpty())
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-10 text-center text-[#9C8B75]">
        <p>No orders yet.</p>
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
                $paymentColor = match($order->payment_status) {
                    'Unpaid'                => 'bg-red-100 text-red-700',
                    'Pending Verification'  => 'bg-yellow-100 text-yellow-700',
                    'Paid'                  => 'bg-green-100 text-green-700',
                    default                 => 'bg-gray-100 text-gray-600',
                };
            @endphp

            <div class="bg-white rounded-2xl border border-[#E8E0D5] p-5">

                {{-- Order Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4 pb-4 border-b border-[#F0E9DF]">
                    <div>
                        <p class="font-bold text-[#2C2416]">Order #{{ $order->id }}</p>
                        <p class="text-xs text-[#9C8B75]">{{ $order->created_at->format('F d, Y h:i A') }}</p>
                        <p class="text-xs text-[#5C4F3D] mt-0.5">
                            {{ $order->user->first_name }} {{ $order->user->last_name }}
                            &mdash; {{ $order->user->email }}
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2 items-center">
                        <span class="font-bold text-[#4A6741]">₱{{ number_format($order->total, 2) }}</span>
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $statusColor }}">{{ $order->status }}</span>
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $paymentColor }}">{{ $order->payment_status }}</span>
                    </div>
                </div>

                {{-- Order Info --}}
                <div class="text-xs text-[#9C8B75] flex flex-wrap gap-4 mb-4">
                    <span>💳 {{ $order->payment_method }}</span>
                    <span>📦 {{ $order->delivery_method }}</span>
                    @if ($order->delivery_address)
                        <span>📍 {{ $order->delivery_address }}</span>
                    @endif
                    @if ($order->payment_reference)
                        <span>🔖 Ref: <strong class="text-[#2C2416]">{{ $order->payment_reference }}</strong></span>
                    @endif
                </div>

                {{-- Items --}}
                <div class="space-y-2 mb-4">
                    @foreach ($order->items as $item)
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 bg-[#F5EFE6] rounded-lg overflow-hidden flex-shrink-0">
                                @if ($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 text-sm text-[#5C4F3D]">
                                {{ $item->product->name }} <span class="text-[#9C8B75]">x{{ $item->quantity }}</span>
                            </div>
                            <span class="text-sm font-medium text-[#2C2416]">₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Update Form --}}
                <form method="POST" action="{{ route('seller.orders.update', $order) }}"
                    class="flex flex-wrap gap-3 items-center pt-4 border-t border-[#F0E9DF]">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center gap-2">
                        <label class="text-xs font-medium text-[#5C4F3D]">Order Status</label>
                        <select name="status"
                            class="border border-[#D5C9B8] rounded-lg px-2 py-1.5 text-xs text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741]">
                            @foreach (['Pending', 'Processing', 'Completed', 'Cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <label class="text-xs font-medium text-[#5C4F3D]">Payment Status</label>
                        <select name="payment_status"
                            class="border border-[#D5C9B8] rounded-lg px-2 py-1.5 text-xs text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741]">
                            @foreach (['Unpaid', 'Pending Verification', 'Paid'] as $ps)
                                <option value="{{ $ps }}" {{ $order->payment_status == $ps ? 'selected' : '' }}>{{ $ps }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-[#4A6741] hover:bg-[#3A5232] text-white text-xs font-semibold px-4 py-1.5 rounded-full transition">
                        Update
                    </button>
                </form>

            </div>
        @endforeach
    </div>
@endif

@endsection