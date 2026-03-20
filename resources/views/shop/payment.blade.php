@extends('layouts.app')
@section('title', 'Payment — CoirFurnitures')
@section('content')

<div class="max-w-lg mx-auto px-6 py-10">

    <div class="text-center mb-6">
        <h1 style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416]">Complete Your Payment</h1>
        <p class="text-sm text-[#9C8B75] mt-1">Order #{{ $order->id }} &mdash; ₱{{ number_format($order->total, 2) }}</p>
    </div>

    @if ($order->payment_method === 'GCash')

        {{-- GCash UI --}}
        <div class="bg-white rounded-2xl border border-[#E8E0D5] overflow-hidden">

            {{-- GCash Header --}}
            <div class="bg-[#007DFF] px-6 py-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">
                    <span class="text-[#007DFF] text-lg font-black">G</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">GCash</p>
                    <p class="text-blue-100 text-xs">Scan to Pay</p>
                </div>
            </div>

            <div class="p-6 text-center">
                <p class="text-sm text-[#5C4F3D] mb-4">Scan the QR code using your GCash app to pay</p>

                {{-- QR Code placeholder --}}
                <div class="w-48 h-48 mx-auto bg-[#F5EFE6] rounded-2xl border-2 border-dashed border-[#D5C9B8] flex flex-col items-center justify-center mb-4">
                    <svg class="w-16 h-16 text-[#C4B49A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                    <p class="text-xs text-[#9C8B75] mt-2">QR Code</p>
                </div>

                {{-- GCash Details --}}
                <div class="bg-[#F0F7FF] rounded-xl p-4 mb-4 text-left space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-[#9C8B75]">GCash Number</span>
                        <span class="font-bold text-[#2C2416]">0917 123 4567</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#9C8B75]">Account Name</span>
                        <span class="font-bold text-[#2C2416]">CoirFurnitures PH</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#9C8B75]">Amount to Pay</span>
                        <span class="font-bold text-[#007DFF] text-base">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                {{-- Reference --}}
                <div class="bg-[#F5EFE6] rounded-xl p-3 mb-5">
                    <p class="text-xs text-[#9C8B75] mb-1">Reference Number</p>
                    <p class="font-bold text-[#2C2416] tracking-widest text-lg">{{ $order->payment_reference }}</p>
                    <p class="text-xs text-[#9C8B75] mt-1">Use this as your payment note/message</p>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-5 text-left">
                    <p class="text-xs font-semibold text-amber-700 mb-1">📋 Instructions</p>
                    <ol class="text-xs text-amber-700 space-y-1 list-decimal list-inside">
                        <li>Open your GCash app</li>
                        <li>Tap "Send Money" or "Scan QR"</li>
                        <li>Enter the amount: <strong>₱{{ number_format($order->total, 2) }}</strong></li>
                        <li>Put the reference number in the message</li>
                        <li>Send and wait for seller confirmation</li>
                    </ol>
                </div>

                <a href="{{ route('orders.index') }}"
                    class="block w-full bg-[#007DFF] hover:bg-[#0066CC] text-white font-bold py-3 rounded-full text-sm transition">
                    I've Sent the Payment
                </a>
                <p class="text-xs text-[#9C8B75] mt-3">The seller will confirm your payment and update your order status.</p>
            </div>
        </div>

    @elseif ($order->payment_method === 'BDO Online Banking')

        {{-- BDO UI --}}
        <div class="bg-white rounded-2xl border border-[#E8E0D5] overflow-hidden">

            {{-- BDO Header --}}
            <div class="bg-[#003087] px-6 py-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center">
                    <span class="text-[#003087] text-xs font-black">BDO</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">BDO Online Banking</p>
                    <p class="text-blue-200 text-xs">Bank Transfer</p>
                </div>
            </div>

            <div class="p-6">
                <p class="text-sm text-[#5C4F3D] mb-5 text-center">Transfer the exact amount to the account below</p>

                {{-- BDO Account Details --}}
                <div class="bg-[#F0F4FF] rounded-xl p-4 mb-4 space-y-3">
                    <div class="flex justify-between text-sm border-b border-[#D5DCF0] pb-2">
                        <span class="text-[#9C8B75]">Bank</span>
                        <span class="font-bold text-[#2C2416]">BDO Unibank</span>
                    </div>
                    <div class="flex justify-between text-sm border-b border-[#D5DCF0] pb-2">
                        <span class="text-[#9C8B75]">Account Name</span>
                        <span class="font-bold text-[#2C2416]">CoirFurnitures PH</span>
                    </div>
                    <div class="flex justify-between text-sm border-b border-[#D5DCF0] pb-2">
                        <span class="text-[#9C8B75]">Account Number</span>
                        <span class="font-bold text-[#2C2416] tracking-wider">1234 5678 9012</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-[#9C8B75]">Amount to Transfer</span>
                        <span class="font-bold text-[#003087] text-base">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>

                {{-- Reference --}}
                <div class="bg-[#F5EFE6] rounded-xl p-3 mb-5 text-center">
                    <p class="text-xs text-[#9C8B75] mb-1">Reference / Remarks</p>
                    <p class="font-bold text-[#2C2416] tracking-widest text-lg">{{ $order->payment_reference }}</p>
                    <p class="text-xs text-[#9C8B75] mt-1">Put this in the remarks/reference field</p>
                </div>

                <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 mb-5">
                    <p class="text-xs font-semibold text-amber-700 mb-1">📋 Instructions</p>
                    <ol class="text-xs text-amber-700 space-y-1 list-decimal list-inside">
                        <li>Log in to BDO Online Banking or BDO app</li>
                        <li>Go to "Fund Transfer" or "Pay Bills"</li>
                        <li>Enter the account number above</li>
                        <li>Enter the exact amount: <strong>₱{{ number_format($order->total, 2) }}</strong></li>
                        <li>Put the reference number in remarks</li>
                        <li>Confirm and submit transfer</li>
                    </ol>
                </div>

                <a href="{{ route('orders.index') }}"
                    class="block w-full bg-[#003087] hover:bg-[#001F5B] text-white font-bold py-3 rounded-full text-sm transition text-center">
                    I've Completed the Transfer
                </a>
                <p class="text-xs text-[#9C8B75] mt-3 text-center">The seller will verify your payment within 1-2 business days.</p>
            </div>
        </div>

    @endif

</div>

@endsection