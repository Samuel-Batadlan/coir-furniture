<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')
            ->latest()
            ->get();

        return view('seller.orders', compact('orders'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'required|in:Pending,Processing,Completed,Cancelled',
            'payment_status' => 'required|in:Unpaid,Pending Verification,Paid',
        ]);

        $previousStatus        = $order->status;
        $newStatus             = $request->status;
        $previousPaymentStatus = $order->payment_status;
        $newPaymentStatus      = $request->payment_status;

        // Statuses that trigger stock deduction
        $stockDeductingStatuses  = ['Processing', 'Completed'];
        $stockRestoringStatuses  = ['Pending', 'Cancelled'];
        $paymentDeductingStatuses = ['Paid'];

        $wasDeducting = in_array($previousStatus, $stockDeductingStatuses)
            || $previousPaymentStatus === 'Paid';

        $willDeduct = in_array($newStatus, $stockDeductingStatuses)
            || $newPaymentStatus === 'Paid';

        // Deduct stock — only when transitioning into a deducting state
        if (!$wasDeducting && $willDeduct) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->update([
                        'stock' => max(0, $product->stock - $item->quantity)
                    ]);
                }
            }
        }

        // Restore stock — only when transitioning out of a deducting state back to a restoring state
        if ($wasDeducting && !$willDeduct) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->update([
                        'stock' => $product->stock + $item->quantity
                    ]);
                }
            }
        }

        $order->update([
            'status'         => $newStatus,
            'payment_status' => $newPaymentStatus,
        ]);

        return back()->with('success', 'Order updated. Stock adjusted accordingly.');
    }
}