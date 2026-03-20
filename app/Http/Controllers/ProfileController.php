<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('shop.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */
        
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'first_name'     => 'required|string|max:50',
            'last_name'      => 'required|string|max:50',
            'phone'          => 'required|digits:10',
            'street_address' => 'required|string',
            'city'           => 'required|string',
            'province'       => 'required|string',
            'zip_code'       => 'required|digits:4',
            'password'       => 'nullable|min:8|confirmed',
        ]);

        $user->first_name     = $request->first_name;
        $user->last_name      = $request->last_name;
        $user->phone          = $request->phone;
        $user->street_address = $request->street_address;
        $user->city           = $request->city;
        $user->province       = $request->province;
        $user->zip_code       = $request->zip_code;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}