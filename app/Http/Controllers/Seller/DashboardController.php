<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $salesToday = Order::whereDate('created_at', today())
            ->whereNotIn('status', ['Cancelled'])
            ->sum('total');

        $salesMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->whereNotIn('status', ['Cancelled'])
            ->sum('total');

        $totalCustomers = User::where('role', 'customer')->count();

        $pendingOrders = Order::where('status', 'Pending')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'salesToday',
            'salesMonth',
            'totalCustomers',
            'pendingOrders',
            'recentOrders'
        ));
    }
}