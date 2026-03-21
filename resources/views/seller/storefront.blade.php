@extends('layouts.seller')
@section('title', 'Storefront Manager — CoirFurnitures')
@section('content')

<h1 style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416] mb-6">Storefront Manager</h1>

@if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-5">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 mb-5">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Settings Form --}}
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-6">
        <h2 class="font-bold text-[#2C2416] mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-[#4A6741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Page Settings
        </h2>

        <form method="POST" action="{{ route('seller.storefront.update') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">
                    Announcement Bar Text
                    <span class="text-xs text-[#9C8B75] font-normal ml-1">(shown at top of every page)</span>
                </label>
                <input type="text" name="announcement_text"
                    value="{{ old('announcement_text', $settings['announcement_text']->value ?? '') }}"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                    maxlength="255" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">
                    Hero Headline
                    <span class="text-xs text-[#9C8B75] font-normal ml-1">(main title on home page)</span>
                </label>
                <input type="text" name="hero_headline"
                    value="{{ old('hero_headline', $settings['hero_headline']->value ?? '') }}"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                    maxlength="100" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">
                    Hero Subheadline
                    <span class="text-xs text-[#9C8B75] font-normal ml-1">(description below headline)</span>
                </label>
                <textarea name="hero_subheadline" rows="3"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition"
                    maxlength="300" required>{{ old('hero_subheadline', $settings['hero_subheadline']->value ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">
                    Featured Products Count
                    <span class="text-xs text-[#9C8B75] font-normal ml-1">(max shown on home page)</span>
                </label>
                <select name="featured_count"
                    class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition">
                    @foreach ([4, 8, 12, 16, 20] as $count)
                        <option value="{{ $count }}"
                            {{ old('featured_count', $featuredCount) == $count ? 'selected' : '' }}>
                            {{ $count }} products
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-semibold py-2.5 rounded-full text-sm transition-all duration-200">
                Save Settings
            </button>
        </form>
    </div>

    {{-- Featured Products Toggle --}}
    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-[#2C2416] flex items-center gap-2">
                <svg class="w-4 h-4 text-[#4A6741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Featured Products
            </h2>
            <span class="text-xs bg-[#F5EFE6] text-[#4A6741] font-semibold px-2.5 py-1 rounded-full border border-[#D5C9B8]">
                {{ $products->where('is_featured', true)->count() }} featured
            </span>
        </div>

        <p class="text-xs text-[#9C8B75] mb-4">Toggle which products appear in the Featured section on the home page.</p>

        <div class="space-y-2 max-h-96 overflow-y-auto pr-1">
            @forelse ($products as $product)
                <form method="POST" action="{{ route('seller.storefront.toggle', $product) }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 p-3 rounded-xl border transition-all duration-200 text-left
                        {{ $product->is_featured
                            ? 'bg-[#F5EFE6] border-[#C4A882] hover:border-[#4A6741]'
                            : 'bg-white border-[#E8E0D5] hover:border-[#C4A882]' }}">

                        {{-- Product image --}}
                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-[#F5EFE6] flex-shrink-0">
                            @if ($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-xs">🪑</div>
                            @endif
                        </div>

                        {{-- Product info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-[#2C2416] truncate">{{ $product->name }}</p>
                            <p class="text-xs text-[#9C8B75]">{{ $product->category }} &mdash; ₱{{ number_format($product->price, 2) }}</p>
                        </div>

                        {{-- Toggle indicator --}}
                        <div class="flex-shrink-0">
                            @if ($product->is_featured)
                                <span class="flex items-center gap-1 text-xs font-semibold text-[#4A6741]">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    Featured
                                </span>
                            @else
                                <span class="text-xs text-[#9C8B75]">Add</span>
                            @endif
                        </div>
                    </button>
                </form>
            @empty
                <p class="text-sm text-[#9C8B75] text-center py-6">No products yet.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection