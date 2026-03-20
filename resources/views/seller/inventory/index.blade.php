@extends('layouts.seller')

@section('title', 'Inventory — CoirFurnitures')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl font-bold text-[#3B3B3B]">Inventory</h1>
        <a href="{{ route('seller.inventory.create') }}"
            class="inline-block bg-[#6B8F71] hover:bg-[#5a7a60] text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
            + Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-lg p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Featured</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($products as $product)
                    <tr class="{{ $product->stock < 5 ? 'bg-red-50' : '' }}">
                        <td class="px-4 py-3">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="h-12 w-12 object-cover rounded-lg">
                            @else
                                <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">No img</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $product->category }}</td>
                        <td class="px-4 py-3 text-gray-800">₱{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="{{ $product->stock < 5 ? 'text-red-600 font-semibold' : 'text-gray-800' }}">
                                {{ $product->stock }}
                                @if ($product->stock < 5)
                                    <span class="text-xs text-red-400">(Low)</span>
                                @endif
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if ($product->is_featured)
                                <span class="bg-green-100 text-green-700 text-xs font-medium px-2 py-1 rounded-full">Yes</span>
                            @else
                                <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2 py-1 rounded-full">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('seller.inventory.edit', $product) }}"
                                    class="text-[#6B8F71] hover:underline text-xs font-medium">Edit</a>
                                <form method="POST" action="{{ route('seller.inventory.destroy', $product) }}"
                                    onsubmit="return confirm('Delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">No products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection