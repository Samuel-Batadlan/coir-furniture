<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:50',
            'last_name'      => 'required|string|max:50',
            'email'          => 'required|email|unique:users,email',
            'phone'          => 'required|digits:10',
            'gender'         => 'required|in:Male,Female,Prefer not to say',
            'birthdate'      => 'required|date|before:-18 years',
            'street_address' => 'required|string',
            'city'           => 'required|string',
            'province'       => 'required|string',
            'zip_code'       => 'required|digits:4',
            'password'       => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'phone'          => $request->phone,
            'gender'         => $request->gender,
            'birthdate'      => $request->birthdate,
            'street_address' => $request->street_address,
            'city'           => $request->city,
            'province'       => $request->province,
            'zip_code'       => $request->zip_code,
            'role'           => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('shop.index');
    }

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return Auth::user()->role === 'seller'
                ? redirect()->route('seller.dashboard')
                : redirect()->route('shop.index');
        }

        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}