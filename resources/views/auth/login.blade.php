<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — CoirFurnitures</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col" style="font-family: 'DM Sans', sans-serif;">

    <div class="flex flex-1">

        {{-- Left Panel --}}
        <div class="hidden lg:flex w-1/2 bg-[#2C2416] flex-col justify-between p-12 relative overflow-hidden">

            <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #C4A882 1px, transparent 1px); background-size: 24px 24px;"></div>

            <a href="{{ route('home') }}" class="relative z-10">
                <span style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-white">CoirFurnitures</span>
                <p class="text-xs text-[#6B5E4A] tracking-widest uppercase mt-0.5">Natural. Sustainable. Filipino.</p>
            </a>

            <div class="relative z-10">
                <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl font-bold text-white leading-tight mb-4">
                    Welcome back<br>to <span class="italic text-[#C4A882]">CoirFurnitures</span>
                </h2>
                <p class="text-[#9C8B75] text-sm leading-relaxed max-w-sm">
                    Log in to browse our collection of eco-friendly coconut coir furniture, track your orders, and manage your profile.
                </p>
                <div class="flex flex-wrap gap-2 mt-6">
                    <span class="bg-[#3D3020] text-[#C4A882] text-xs px-3 py-1.5 rounded-full">🌿 100% Natural</span>
                    <span class="bg-[#3D3020] text-[#C4A882] text-xs px-3 py-1.5 rounded-full">🇵🇭 Made in PH</span>
                    <span class="bg-[#3D3020] text-[#C4A882] text-xs px-3 py-1.5 rounded-full">♻️ Eco-Friendly</span>
                </div>
            </div>

            <p class="text-xs text-[#4A3C2C] relative z-10">
                For educational purposes only, and no copyright infringement is intended.
            </p>
        </div>

        {{-- Right Panel --}}
        <div class="w-full lg:w-1/2 bg-[#FAF7F2] flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">

                <div class="lg:hidden mb-8 text-center">
                    <span style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-[#2C2416]">CoirFurnitures</span>
                    <p class="text-xs text-[#9C8B75] tracking-widest uppercase mt-0.5">Natural. Sustainable. Filipino.</p>
                </div>

                <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416] mb-1">Log in</h1>
                <p class="text-sm text-[#9C8B75] mb-7">Enter your credentials to access your account.</p>

                @if (session('error'))
                    <div class="bg-amber-50 border border-amber-200 text-amber-700 text-sm rounded-xl p-3 mb-5">
                        {{ session('error') }}
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

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition placeholder-[#C4B49A]"
                            placeholder="juan@email.com" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#5C4F3D] mb-1.5">Password</label>
                        <input type="password" name="password"
                            class="w-full bg-white border border-[#D5C9B8] rounded-xl px-4 py-2.5 text-sm text-[#2C2416] focus:outline-none focus:ring-2 focus:ring-[#4A6741] focus:border-transparent transition placeholder-[#C4B49A]"
                            placeholder="Your password" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="rounded border-[#D5C9B8] accent-[#4A6741]">
                            <span class="text-sm text-[#5C4F3D]">Remember me</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-semibold py-2.5 rounded-full text-sm transition-all duration-200 mt-2">
                        Log In
                    </button>

                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[#E8E0D5]"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-[#FAF7F2] px-3 text-xs text-[#9C8B75]">or</span>
                        </div>
                    </div>

                    <p class="text-center text-sm text-[#5C4F3D]">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-[#4A6741] font-semibold hover:underline">Sign up</a>
                    </p>

                </form>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-[#1E1810] text-[#6B5E4A] text-xs">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-2">
                <span style="font-family: 'Playfair Display', serif;" class="text-[#9C8B75] font-semibold text-sm">CoirFurnitures</span>
                <span class="text-[#3D3020]">|</span>
                <span>&copy; {{ date('Y') }} All rights reserved.</span>
            </div>
            <div class="flex items-center gap-4 flex-wrap justify-center">
                <a href="{{ route('home') }}" class="hover:text-[#C4A882] transition-colors">Home</a>
                <a href="{{ route('shop.index') }}" class="hover:text-[#C4A882] transition-colors">Shop</a>
                <span class="text-[#3D3020]">|</span>
                <span>For educational purposes only, and no copyright infringement is intended.</span>
            </div>
        </div>
    </footer>

</body>
</html>