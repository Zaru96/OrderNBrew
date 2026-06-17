<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('payment')->latest()->get();

        $totalOrders    = $orders->count();
        $pendingOrders  = $orders->whereIn('payment_status', ['unpaid', 'pending'])->count();
        $paidOrders     = $orders->where('payment_status', 'paid')->count();
        $rejectedOrders = $orders->where('payment_status', 'rejected')->count();

        return view('cashier.dashboard', compact(
            'orders', 'totalOrders', 'pendingOrders', 'paidOrders', 'rejectedOrders'
        ));
    }

    public function approve(Order $order)
    {
        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'waiting',
        ]);

        if ($order->payment) {
            $order->payment->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Payment approved. Order sent to kitchen.');
    }

    public function reject(Order $order)
    {
        $order->update([
            'payment_status' => 'rejected',
            'order_status' => 'waiting_payment',
        ]);

        if ($order->payment) {
            $order->payment->update([
                'payment_status' => 'rejected',
            ]);
        }

        return redirect()->back()->with('success', 'Payment rejected.');
    }
}