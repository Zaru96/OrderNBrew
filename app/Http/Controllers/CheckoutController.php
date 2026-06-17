<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Your cart is empty. Please add items first.');
        }
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        return view('customer.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'table_number'  => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Your cart is empty.');
        }

        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        // Generate ONB-YYYYMMDD-XXX order code
        $todayCount = Order::whereDate('created_at', today())->count() + 1;
        $orderCode  = 'ONB-' . now()->format('Ymd') . '-' . str_pad($todayCount, 3, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_code'     => $orderCode,
            'customer_name'  => $request->customer_name,
            'table_number'   => $request->table_number,
            'total_price'    => $total,
            'order_status'   => 'waiting_payment',
            'payment_status' => 'unpaid',
        ]);

        foreach ($cart as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id'  => $item['id'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
                'note'     => $item['note'] ?? null,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('payment.show', $order);
    }
}
