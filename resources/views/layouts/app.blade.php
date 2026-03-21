<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CoirFurnitures')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF7F2] min-h-screen flex flex-col" style="font-family: 'DM Sans', sans-serif;">

    <div class="bg-[#4A6741] text-white text-xs text-center py-1.5 px-4 tracking-wide">
    {{ \App\Models\StorefrontSetting::get('announcement_text', '🌿 Free delivery on orders over ₱5,000 | Eco-friendly coconut coir furniture, made in the Philippines') }}
    </div>

    {{-- Navbar --}}
    <header class="bg-white border-b border-[#E8E0D5] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-14">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex flex-col leading-none flex-shrink-0">
                    <span style="font-family: 'Playfair Display', serif;" class="text-lg font-bold text-[#2C2416] tracking-tight">CoirFurnitures</span>
                    <span class="text-[9px] text-[#9C8B75] tracking-[0.18em] uppercase">Natural. Sustainable. Filipino.</span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 text-sm font-medium text-[#5C4F3D] hover:text-[#2C2416] hover:bg-[#F5EFE6] rounded-lg transition-all duration-200">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}"
                        class="px-3 py-2 text-sm font-medium text-[#5C4F3D] hover:text-[#2C2416] hover:bg-[#F5EFE6] rounded-lg transition-all duration-200">
                        Shop
                    </a>

                    @auth
                        <a href="{{ route('cart.index') }}"
                            class="px-3 py-2 text-sm font-medium text-[#5C4F3D] hover:text-[#2C2416] hover:bg-[#F5EFE6] rounded-lg transition-all duration-200 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Cart
                        </a>
                        <a href="{{ route('orders.index') }}"
                            class="px-3 py-2 text-sm font-medium text-[#5C4F3D] hover:text-[#2C2416] hover:bg-[#F5EFE6] rounded-lg transition-all duration-200">
                            Orders
                        </a>

                        {{-- Divider --}}
                        <div class="w-px h-5 bg-[#E8E0D5] mx-1"></div>

                        {{-- Profile Dropdown --}}
                        <div class="relative" id="profile-dropdown-wrapper">
                            <button id="profile-btn"
                                class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-[#F5EFE6] transition-all duration-200 group">
                                <div class="w-7 h-7 rounded-full bg-[#4A6741] flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-[#2C2416]">{{ Auth::user()->first_name }}</span>
                                <svg class="w-3.5 h-3.5 text-[#9C8B75] group-hover:text-[#5C4F3D] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown --}}
                            <div id="profile-menu"
                                class="hidden absolute right-0 mt-1.5 w-48 bg-white rounded-xl border border-[#E8E0D5] shadow-lg py-1 z-50">
                                <div class="px-4 py-2.5 border-b border-[#F0E9DF]">
                                    <p class="text-xs font-semibold text-[#2C2416]">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                    <p class="text-xs text-[#9C8B75] truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.index') }}"
                                    class="flex items-center gap-2.5 px-4 py-2 text-sm text-[#5C4F3D] hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                                <a href="{{ route('orders.index') }}"
                                    class="flex items-center gap-2.5 px-4 py-2 text-sm text-[#5C4F3D] hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    My Orders
                                </a>
                                <div class="border-t border-[#F0E9DF] mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-[#B85C38] hover:bg-red-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="w-px h-5 bg-[#E8E0D5] mx-1"></div>
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 text-sm font-medium text-[#5C4F3D] hover:text-[#2C2416] hover:bg-[#F5EFE6] rounded-lg transition-all duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="ml-1 bg-[#4A6741] hover:bg-[#3A5232] text-white px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200">
                            Get Started
                        </a>
                    @endauth
                </nav>

                {{-- Mobile Toggle --}}
                <button id="menu-toggle" class="md:hidden text-[#5C4F3D] p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-[#E8E0D5] px-6 py-3 space-y-1 text-sm font-medium text-[#5C4F3D]">
            <a href="{{ route('home') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">Home</a>
            <a href="{{ route('shop.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">Shop</a>
            @auth
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">Cart</a>
                <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">Orders</a>
                <a href="{{ route('profile.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] hover:text-[#2C2416] transition-colors">Profile</a>
                <div class="border-t border-[#F0E9DF] pt-1 mt-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-[#B85C38] hover:bg-red-50 w-full transition-colors">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] transition-colors">Login</a>
                <a href="{{ route('register') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-[#F5EFE6] transition-colors">Get Started</a>
            @endauth
        </div>
    </header>

    {{-- Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#1E1810] text-[#9C8B75] mt-12">

        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}">
                        <span style="font-family: 'Playfair Display', serif;" class="text-xl font-bold text-white">CoirFurnitures</span>
                        <p class="text-xs text-[#6B5E4A] tracking-widest uppercase mt-0.5">Natural. Sustainable. Filipino.</p>
                    </a>
                    <p class="text-sm mt-4 leading-relaxed max-w-sm">
                        Handcrafted furniture made from natural coconut coir fiber. We bring sustainable, eco-friendly design to every Filipino home.
                    </p>
                    <div class="flex flex-wrap gap-2 mt-5">
                        <span class="bg-[#2C2416] border border-[#3D3020] text-[#C4A882] text-xs px-3 py-1 rounded-full">🌿 100% Natural</span>
                        <span class="bg-[#2C2416] border border-[#3D3020] text-[#C4A882] text-xs px-3 py-1 rounded-full">🇵🇭 Made in PH</span>
                        <span class="bg-[#2C2416] border border-[#3D3020] text-[#C4A882] text-xs px-3 py-1 rounded-full">♻️ Eco-Certified</span>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <p class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Quick Links</p>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:pl-1 transition-all duration-200">Home</a></li>
                        <li><a href="{{ route('shop.index') }}" class="hover:text-white hover:pl-1 transition-all duration-200">Shop</a></li>
                        @auth
                            <li><a href="{{ route('cart.index') }}" class="hover:text-white hover:pl-1 transition-all duration-200">Cart</a></li>
                            <li><a href="{{ route('orders.index') }}" class="hover:text-white hover:pl-1 transition-all duration-200">My Orders</a></li>
                            <li><a href="{{ route('profile.index') }}" class="hover:text-white hover:pl-1 transition-all duration-200">My Profile</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-white hover:pl-1 transition-all duration-200">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-white hover:pl-1 transition-all duration-200">Register</a></li>
                        @endauth
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <p class="text-white font-semibold text-sm mb-4 uppercase tracking-wider">Contact Us</p>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#4A6741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Philippines</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#4A6741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>hello@coirfurnitures.ph</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#4A6741]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+63 912 345 6789</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-[#2C2416]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-[#4A3C2C]">
                <span>&copy; {{ date('Y') }} CoirFurnitures. All rights reserved.</span>
                <span>For educational purposes only, and no copyright infringement is intended.</span>
            </div>
        </div>

    </footer>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        const profileBtn = document.getElementById('profile-btn');
        const profileMenu = document.getElementById('profile-menu');

        if (profileBtn) {
            profileBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function () {
                profileMenu.classList.add('hidden');
            });

            profileMenu.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }
    </script>

</body>
</html>