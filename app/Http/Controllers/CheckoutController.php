<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('shop.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method'   => 'required|in:Cash on Delivery,Over-the-Counter,GCash,BDO Online Banking',
            'delivery_method'  => 'required|in:Pickup,Delivery',
            'delivery_address' => 'required_if:delivery_method,Delivery|nullable|string',
        ]);

        $items = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        // Generate reference number
        $reference = 'CF-' . strtoupper(Str::random(8));

        // COD is auto-pending verification, others are unpaid until seller confirms
        $paymentStatus = in_array($request->payment_method, ['Cash on Delivery'])
            ? 'Pending Verification'
            : 'Unpaid';

        $order = Order::create([
            'user_id'           => Auth::id(),
            'total'             => $total,
            'status'            => 'Pending',
            'payment_method'    => $request->payment_method,
            'delivery_method'   => $request->delivery_method,
            'delivery_address'  => $request->delivery_method === 'Delivery'
                ? $request->delivery_address
                : null,
            'payment_reference' => $reference,
            'payment_status'    => $paymentStatus,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        // Redirect to payment screen for online payments
        if (in_array($request->payment_method, ['GCash', 'BDO Online Banking'])) {
            return redirect()->route('payment.show', $order);
        }

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}