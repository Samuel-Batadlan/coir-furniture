@extends('layouts.seller')

@section('title', 'Add Product — CoirFurnitures')

@section('content')

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('seller.inventory.index') }}" class="text-sm text-[#6B8F71] hover:underline">← Back</a>
        <h1 class="text-2xl font-bold text-[#3B3B3B]">Add Product</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg p-3 mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('seller.inventory.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]"
                    placeholder="e.g. Coir Sofa Set" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]" required>
                    <option value="" disabled selected>Select category</option>
                    @foreach (['Sofa','Chair','Table','Bed','Cabinet','Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]"
                    placeholder="Describe the product..." required>{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (₱)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]"
                        placeholder="0.00" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock') }}" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]"
                        placeholder="0" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6B8F71]">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP. Max 2MB.</p>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    {{ old('is_featured') ? 'checked' : '' }} class="rounded">
                <label for="is_featured" class="text-sm text-gray-700">Mark as Featured</label>
            </div>

            <button type="submit"
                class="w-full bg-[#6B8F71] hover:bg-[#5a7a60] text-white font-semibold py-2.5 rounded-lg transition text-sm">
                Add Product
            </button>
        </form>
    </div>

@endsection