<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller — CoirFurnitures')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F0E8] min-h-screen flex flex-col" style="font-family: 'DM Sans', sans-serif;">

    {{-- Top Bar --}}
    <header class="bg-[#2C2416] sticky top-0 z-50">
        <div class="w-full px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span style="font-family: 'Playfair Display', serif;" class="text-lg font-bold text-white">CoirFurnitures</span>
                <span class="hidden sm:block text-xs text-[#6B5E4A] bg-[#3D3020] px-2.5 py-0.5 rounded-full">Seller Panel</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 text-sm text-[#C4B49A]">
                    <div class="w-6 h-6 rounded-full bg-[#4A6741] flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                    </div>
                    <span class="hidden sm:block text-sm">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-xs text-[#B85C38] hover:text-[#D4724E] border border-[#5C3020] hover:border-[#B85C38] px-3 py-1 rounded-full transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="flex flex-1 w-full">

        {{-- Sidebar --}}
        <aside class="hidden md:flex flex-col w-52 bg-white border-r border-[#E8E0D5] flex-shrink-0 sticky top-[49px] h-[calc(100vh-49px)]">
            <nav class="p-3 space-y-0.5 flex-1">
                <p class="text-xs text-[#9C8B75] uppercase tracking-wider font-semibold px-3 mb-2 mt-2">Navigation</p>

                <a href="{{ route('seller.dashboard') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('seller.dashboard') ? 'bg-[#F5EFE6] text-[#4A6741] border border-[#D5C9B8]' : 'text-[#5C4F3D] hover:bg-[#FAF7F2] hover:text-[#4A6741]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('seller.storefront.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('seller.storefront*') ? 'bg-[#F5EFE6] text-[#4A6741] border border-[#D5C9B8]' : 'text-[#5C4F3D] hover:bg-[#FAF7F2] hover:text-[#4A6741]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Storefront
                </a>

                <a href="{{ route('seller.inventory.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('seller.inventory*') ? 'bg-[#F5EFE6] text-[#4A6741] border border-[#D5C9B8]' : 'text-[#5C4F3D] hover:bg-[#FAF7F2] hover:text-[#4A6741]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Inventory
                </a>

                <a href="{{ route('seller.orders.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('seller.orders*') ? 'bg-[#F5EFE6] text-[#4A6741] border border-[#D5C9B8]' : 'text-[#5C4F3D] hover:bg-[#FAF7F2] hover:text-[#4A6741]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Orders
                </a>

                <a href="{{ route('seller.reports') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('seller.reports') ? 'bg-[#F5EFE6] text-[#4A6741] border border-[#D5C9B8]' : 'text-[#5C4F3D] hover:bg-[#FAF7F2] hover:text-[#4A6741]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Reports
                </a>      

            </nav>
            <div class="p-3 border-t border-[#E8E0D5]">
                <p class="text-xs text-[#9C8B75] text-center">CoirFurnitures © {{ date('Y') }}</p>
            </div>
        </aside>

        {{-- Main --}}
        <main class="flex-1 min-w-0 p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    <footer class="text-center text-xs text-[#9C8B75] py-3 border-t border-[#E8E0D5] bg-white">
        For educational purposes only, and no copyright infringement is intended.
    </footer>

</body>
</html>
