<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['orderDetails.menu', 'payment']);
        return view('customer.payment', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer,qris',
            'payment_proof'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($order->payment) {
            return redirect()->route('invoice.show', $order)->with('info', 'Payment already recorded.');
        }

        $proof = null;
        if ($request->hasFile('payment_proof')) {
            $proof = $request->file('payment_proof')->store('payments', 'public');
        }

        Payment::create([
            'order_id'       => $order->id,
            'payment_method' => $request->payment_method,
            'payment_proof'  => $proof,
            'payment_status' => 'pending',
        ]);

        $order->update(['payment_status' => 'pending']);

        return redirect()->route('invoice.show', $order);
    }

    public function invoice(Order $order)
    {
        $order->load(['orderDetails.menu', 'payment']);
        return view('customer.invoice', compact('order'));
    }
}
