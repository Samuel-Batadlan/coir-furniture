<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Seller\InventoryController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\ReportsController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public routes
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// Public cart add (controller handles auth check)
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Buyer protected routes
Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Payment screen
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});

// Seller routes
Route::middleware(['auth', 'seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
    Route::resource('inventory', InventoryController::class);

    // Order management
    Route::get('/orders', [App\Http\Controllers\Seller\OrderManagementController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [App\Http\Controllers\Seller\OrderManagementController::class, 'update'])->name('orders.update');
    
    // Storefront management
    Route::get('/storefront', [App\Http\Controllers\Seller\StorefrontController::class, 'index'])->name('storefront.index');
    Route::post('/storefront', [App\Http\Controllers\Seller\StorefrontController::class, 'update'])->name('storefront.update');
    Route::post('/storefront/{product}/toggle', [App\Http\Controllers\Seller\StorefrontController::class, 'toggleFeatured'])->name('storefront.toggle');
});