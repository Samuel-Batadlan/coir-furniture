@extends('layouts.seller')

@section('title', 'Edit Product — CoirFurnitures')

@section('content')

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('seller.inventory.index') }}" class="text-sm text-[#4A6741] hover:underline">← Back</a>
        <h1 style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416]">Edit Product</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-6 max-w-2xl">
        <form method="POST" action="{{ route('seller.inventory.update', ['inventory' => $product->id]) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Category</label>
                <select name="category"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition" required>
                    @foreach (['Sofa','Chair','Table','Bed','Cabinet','Other'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Description</label>
                <textarea name="description" rows="4"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                    required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Price (₱)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0"
                        class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                        class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                        required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Product Image</label>
                @if ($product->image)
                    <div class="mb-3">
                        <img src="{{ Storage::url($product->image) }}" class="h-24 w-24 object-cover rounded-xl border border-[#E8E0D5]">
                        <p class="text-xs text-[#9C8B75] mt-1">Current image. Upload a new one to replace it.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition">
                <p class="text-xs text-[#9C8B75] mt-1">JPG, PNG, WEBP. Max 10MB.</p>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                    class="rounded border-[#D5C9B8] accent-[#4A6741]">
                <label for="is_featured" class="text-sm text-[#5C4F3D]">Mark as Featured</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-[#4A6741] hover:bg-[#3A5232] text-white font-semibold py-2.5 rounded-full text-sm transition-all duration-200">
                    Save Changes
                </button>
                <a href="{{ route('seller.inventory.index') }}"
                    class="flex-1 text-center border border-[#D5C9B8] text-[#5C4F3D] hover:bg-[#F5EFE6] font-semibold py-2.5 rounded-full text-sm transition-all duration-200">
                    Cancel
                </a>
            </div>

        </form>
    </div>

@endsection