@extends('layouts.app')
@section('title', 'CoirFurnitures — Eco-Friendly Filipino Furniture')
@section('content')

{{-- Hero --}}
<section class="w-full bg-[#2C2416] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        {{-- Text --}}
        <div class="text-white">
            <div class="inline-flex items-center gap-2 bg-[#4A6741] bg-opacity-30 border border-[#4A6741] text-[#A8C5A0] text-xs font-medium px-3 py-1 rounded-full mb-5 tracking-wider uppercase">
                🌿 Sustainably Crafted in the Philippines
            </div>
            <h1 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-5xl font-bold leading-tight mb-4 text-white">
                Furniture rooted<br><span class="text-[#C4A882] italic">in nature.</span>
            </h1>
            <p class="text-[#9C8B75] text-base leading-relaxed mb-6 max-w-md">
                {{ \App\Models\StorefrontSetting::get('hero_subheadline', 'Handcrafted from coconut coir fiber — durable, sustainable, and beautifully organic.') }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('shop.index') }}"
                    class="bg-[#C4A882] hover:bg-[#B8956E] text-[#2C2416] font-bold px-6 py-2.5 rounded-full text-sm transition-all duration-200">
                    Explore Collection
                </a>
                <a href="#featured"
                    class="border border-[#5C4F3D] hover:border-[#C4A882] text-[#C4A882] font-semibold px-6 py-2.5 rounded-full text-sm transition-all duration-200">
                    See Featured
                </a>
            </div>
            <div class="flex gap-8 mt-8 pt-6 border-t border-[#3D3020]">
                <div>
                    <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-white">100%</p>
                    <p class="text-xs text-[#6B5E4A] mt-0.5">Natural Fiber</p>
                </div>
                <div>
                    <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-white">PH</p>
                    <p class="text-xs text-[#6B5E4A] mt-0.5">Made Locally</p>
                </div>
                <div>
                    <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-white">Eco</p>
                    <p class="text-xs text-[#6B5E4A] mt-0.5">Friendly</p>
                </div>
            </div>
        </div>

        {{-- Hero Image --}}
        <div class="relative hidden lg:block">
            <div class="w-full aspect-square rounded-2xl bg-[#3D3020] border border-[#5C4F3D] overflow-hidden" style="max-height: 460px;">
                @php $hero = App\Models\Product::whereNotNull('image')->first(); @endphp
                @if ($hero)
                    <img src="{{ Storage::url($hero->image) }}" class="w-full h-full object-cover opacity-90">
                @else
                    <div class="w-full h-full flex items-center justify-center text-[#5C4F3D] text-sm">Add products to display here</div>
                @endif
            </div>
            <div class="absolute -bottom-3 -left-3 bg-[#4A6741] text-white px-4 py-2 rounded-xl shadow-lg">
                <p class="text-xs text-[#A8C5A0]">Made from</p>
                <p class="font-bold text-sm">Coconut Coir</p>
            </div>
        </div>

    </div>
</section>

{{-- Features Bar --}}
<section class="w-full bg-[#F0E9DF] border-y border-[#E0D5C5]">
    <div class="max-w-7xl mx-auto px-6 py-4 grid grid-cols-2 md:grid-cols-4 gap-3 text-center text-sm text-[#5C4F3D]">
        <div class="flex items-center justify-center gap-2 font-medium">🚚 Free delivery over ₱5,000</div>
        <div class="flex items-center justify-center gap-2 font-medium">🌿 100% Natural Materials</div>
        <div class="flex items-center justify-center gap-2 font-medium">🇵🇭 Filipino Craftsmanship</div>
        <div class="flex items-center justify-center gap-2 font-medium">♻️ Eco-Certified Products</div>
    </div>
</section>

{{-- Featured Products --}}
<section id="featured" class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 mb-8">
        <div>
            <p class="text-xs text-[#4A6741] font-semibold tracking-widest uppercase mb-1">Handpicked for you</p>
            <h2 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416]">
                Featured <span class="italic text-[#9C8B75]">Pieces</span>
            </h2>
        </div>
        <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-[#4A6741] hover:text-[#2C2416] transition-colors">
            View all →
        </a>
    </div>

    @if ($featured->isEmpty())
        <div class="text-center py-16 text-[#9C8B75]">
            <p class="text-lg">No featured products yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($featured as $product)
                <a href="{{ route('shop.show', $product) }}"
                    class="group bg-white rounded-2xl overflow-hidden border border-[#E8E0D5] hover:border-[#C4A882] hover:shadow-lg transition-all duration-300">
                    <div class="aspect-square bg-[#F5EFE6] overflow-hidden relative">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#C4B49A] text-4xl">🪑</div>
                        @endif
                        <div class="absolute top-2 left-2">
                            <span class="bg-[#4A6741] text-white text-xs font-semibold px-2 py-0.5 rounded-full">Featured</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-xs text-[#9C8B75] uppercase tracking-wider mb-0.5">{{ $product->category }}</p>
                        <h3 style="font-family: 'Playfair Display', serif;" class="font-semibold text-[#2C2416] text-sm leading-tight mb-2 group-hover:text-[#4A6741] transition-colors">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between">
                            <p class="text-[#4A6741] font-bold">₱{{ number_format($product->price, 2) }}</p>
                            <span class="text-xs text-[#9C8B75]">{{ $product->stock }} left</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</section>

{{-- Why Coir --}}
<section class="w-full bg-[#2C2416] px-6 py-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-xs text-[#4A6741] font-semibold tracking-widest uppercase mb-2">Why Coconut Coir?</p>
            <h2 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-white mb-4 leading-tight">
                Nature's most <span class="italic text-[#C4A882]">resilient</span> fiber.
            </h2>
            <p class="text-[#9C8B75] text-sm leading-relaxed mb-6">
                Coconut coir is extracted from the outer husk of coconuts — a byproduct that would otherwise go to waste. We transform it into beautiful, long-lasting furniture that's better for your home and the planet.
            </p>
            <div class="grid grid-cols-2 gap-3">
                @foreach(['Naturally Durable' => '🔨', 'Water Resistant' => '💧', 'Biodegradable' => '🌱', 'Pest Resistant' => '🛡️'] as $trait => $icon)
                    <div class="flex items-center gap-2.5 bg-[#3D3020] rounded-xl p-3">
                        <span class="text-xl">{{ $icon }}</span>
                        <span class="text-white text-sm font-medium">{{ $trait }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
            @php $showcaseProducts = App\Models\Product::whereNotNull('image')->take(4)->get(); @endphp
            @forelse ($showcaseProducts as $i => $p)
                <div class="aspect-square rounded-xl overflow-hidden bg-[#3D3020] {{ $i === 1 ? 'mt-4' : '' }} {{ $i === 3 ? '-mt-4' : '' }}">
                    <img src="{{ Storage::url($p->image) }}" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition-opacity duration-300">
                </div>
            @empty
                <div class="col-span-2 aspect-video rounded-xl bg-[#3D3020] flex items-center justify-center text-[#5C4F3D] text-sm">
                    Add products to display here
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection