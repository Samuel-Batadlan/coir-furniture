<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('seller.inventory.index', compact('products'));
    }

    public function create()
    {
        return view('seller.inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category'    => $request->category,
            'image'       => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('seller.inventory.index')->with('success', 'Product added successfully.');
    }

    public function edit(Request $request, $inventory)
    {
        $product = Product::findOrFail($inventory);
        return view('seller.inventory.edit', compact('product'));
    }

    public function update(Request $request, $inventory)
    {
        $product = Product::findOrFail($inventory);

        $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category'    => $request->category,
            'image'       => $product->image,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('seller.inventory.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($inventory)
    {
        $product = Product::findOrFail($inventory);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.inventory.index')->with('success', 'Product deleted.');
    }
}