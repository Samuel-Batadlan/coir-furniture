<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $featuredCount = (int) \App\Models\StorefrontSetting::get('featured_count', '8');
        $featured = Product::where('is_featured', true)->latest()->take($featuredCount)->get();
        return view('shop.home', compact('featured'));
    }

    public function index()
    {
        $products = Product::latest()->get();
        $categories = Product::select('category')->distinct()->pluck('category');
        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}