@extends('layouts.seller')
@section('title', 'Dashboard — CoirFurnitures')
@section('content')

<h1 style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416] mb-6">Dashboard</h1>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-4">
        <p class="text-xs text-[#9C8B75] mb-1">Sales Today</p>
        <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#4A6741]">₱{{ number_format($salesToday, 2) }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-4">
        <p class="text-xs text-[#9C8B75] mb-1">Sales This Month</p>
        <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#4A6741]">₱{{ number_format($salesMonth, 2) }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-4">
        <p class="text-xs text-[#9C8B75] mb-1">Total Customers</p>
        <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416]">{{ $totalCustomers }}</p>
    </div>
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-4">
        <p class="text-xs text-[#9C8B75] mb-1">Pending Orders</p>
        <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#B85C38]">{{ $pendingOrders }}</p>
    </div>
</div>

{{-- Recent Orders --}}
<div class="bg-white rounded-2xl border border-[#E8E0D5] p-5">
    <h2 class="font-bold text-[#2C2416] mb-4">Recent Orders</h2>
    @if ($recentOrders->isEmpty())
        <p class="text-sm text-[#9C8B75]">No orders yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-[#9C8B75] uppercase border-b border-[#E8E0D5]">
                    <tr>
                        <th class="pb-3 px-2">Order #</th>
                        <th class="pb-3 px-2">Customer</th>
                        <th class="pb-3 px-2">Total</th>
                        <th class="pb-3 px-2">Status</th>
                        <th class="pb-3 px-2">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F0E9DF]">
                    @foreach ($recentOrders as $order)
                        @php
                            $statusColor = match($order->status) {
                                'Pending'    => 'bg-yellow-100 text-yellow-700',
                                'Processing' => 'bg-blue-100 text-blue-700',
                                'Completed'  => 'bg-green-100 text-green-700',
                                'Cancelled'  => 'bg-red-100 text-red-700',
                                default      => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <tr>
                            <td class="py-2.5 px-2 font-medium text-[#2C2416]">#{{ $order->id }}</td>
                            <td class="py-2.5 px-2 text-[#5C4F3D]">{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                            <td class="py-2.5 px-2 font-semibold text-[#4A6741]">₱{{ number_format($order->total, 2) }}</td>
                            <td class="py-2.5 px-2">
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $statusColor }}">{{ $order->status }}</span>
                            </td>
                            <td class="py-2.5 px-2 text-[#9C8B75]">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection