<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Make sure the order belongs to the logged in user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('shop.payment', compact('order'));
    }
}