<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('shop.cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}