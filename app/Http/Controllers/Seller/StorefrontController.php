<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StorefrontSetting;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function index()
    {
        $products      = Product::orderBy('name')->get();
        $settings      = StorefrontSetting::all()->keyBy('key');
        $featuredCount = StorefrontSetting::get('featured_count', '8');

        return view('seller.storefront', compact('products', 'settings', 'featuredCount'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'announcement_text' => 'required|string|max:255',
            'hero_headline'     => 'required|string|max:100',
            'hero_subheadline'  => 'required|string|max:300',
            'featured_count'    => 'required|integer|min:1|max:20',
        ]);

        StorefrontSetting::set('announcement_text', $request->announcement_text);
        StorefrontSetting::set('hero_headline', $request->hero_headline);
        StorefrontSetting::set('hero_subheadline', $request->hero_subheadline);
        StorefrontSetting::set('featured_count', $request->featured_count);

        return back()->with('success', 'Storefront settings updated.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        return back()->with('success', $product->is_featured
            ? "{$product->name} is now featured."
            : "{$product->name} removed from featured.");
    }
}