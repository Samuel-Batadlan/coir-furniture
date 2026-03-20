@extends('layouts.app')
@section('title', 'Profile — CoirFurnitures')
@section('content')

<div class="max-w-3xl mx-auto px-6 py-8">

    <h1 style="font-family: 'Playfair Display', serif;" class="text-3xl font-bold text-[#2C2416] mb-6">My Profile</h1>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-4">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl p-3 mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-[#E8E0D5] p-6">
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                        class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                        class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Email Address</label>
                <input type="email" value="{{ $user->email }}"
                    class="w-full border border-[#E8E0D5] rounded-xl px-3 py-2 text-sm bg-[#FAF7F2] text-[#9C8B75] cursor-not-allowed" disabled>
                <p class="text-xs text-[#9C8B75] mt-1">Email cannot be changed.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Mobile Number</label>
                <div class="flex">
                    <span class="inline-flex items-center px-3 text-sm text-[#5C4F3D] bg-[#F5EFE6] border border-r-0 border-[#D5C9B8] rounded-l-xl">+63</span>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-[#D5C9B8] rounded-r-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]"
                        maxlength="10" required>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Gender</label>
                    <input type="text" value="{{ $user->gender }}"
                        class="w-full border border-[#E8E0D5] rounded-xl px-3 py-2 text-sm bg-[#FAF7F2] text-[#9C8B75] cursor-not-allowed" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Date of Birth</label>
                    <input type="text" value="{{ $user->birthdate->format('F d, Y') }}"
                        class="w-full border border-[#E8E0D5] rounded-xl px-3 py-2 text-sm bg-[#FAF7F2] text-[#9C8B75] cursor-not-allowed" disabled>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Street Address</label>
                <input type="text" name="street_address" value="{{ old('street_address', $user->street_address) }}"
                    class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]" required>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                        class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Province</label>
                    <input type="text" name="province" value="{{ old('province', $user->province) }}"
                        class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-[#5C4F3D] mb-1">ZIP Code</label>
                    <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}"
                        class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]"
                        maxlength="4" required>
                </div>
            </div>

            <div class="border-t border-[#E8E0D5] pt-4">
                <p class="text-sm font-semibold text-[#2C2416] mb-3">Change Password <span class="text-[#9C8B75] font-normal">(optional)</span></p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-[#5C4F3D] mb-1">New Password</label>
                        <input type="password" name="password"
                            class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]"
                            placeholder="Leave blank to keep current">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-[#5C4F3D] mb-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full border border-[#D5C9B8] rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A6741]"
                            placeholder="Repeat new password">
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#4A6741] hover:bg-[#3A5232] text-white font-bold py-2.5 rounded-full transition text-sm">
                Save Changes
            </button>
        </form>
    </div>
</div>

@endsection