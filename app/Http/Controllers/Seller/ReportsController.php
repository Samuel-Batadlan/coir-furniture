<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class ReportsController extends Controller
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

        $monthlyOrders = Order::with('user', 'items.product')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->latest()
            ->get();

        $products = Product::orderBy('stock', 'asc')->get();

        return view('seller.reports', compact(
            'salesToday',
            'salesMonth',
            'monthlyOrders',
            'products'
        ));
    }
}