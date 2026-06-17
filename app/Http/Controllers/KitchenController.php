<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class KitchenController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with(['orderDetails.menu'])
            ->whereIn('order_status', ['waiting', 'processing', 'ready'])
            ->where('payment_status', 'paid')
            ->latest()
            ->get();

        $completedToday  = Order::where('order_status', 'completed')->whereDate('updated_at', today())->count();
        $totalQueue      = $orders->count();
        $processingCount = $orders->where('order_status', 'processing')->count();
        $waitingCount    = $orders->where('order_status', 'waiting')->count();
        $readyCount      = $orders->where('order_status', 'ready')->count();

        return view('kitchen.dashboard', compact(
            'orders', 'totalQueue', 'processingCount',
            'waitingCount', 'readyCount', 'completedToday'
        ));
    }

    public function process(Order $order)
    {
        $order->update(['order_status' => 'processing']);
        return redirect()->back()->with('success', 'Order is now being processed.');
    }

    public function ready(Order $order)
    {
        $order->update(['order_status' => 'ready']);
        return redirect()->back()->with('success', 'Order is ready to serve!');
    }

    public function complete(Order $order)
    {
        $order->update(['order_status' => 'completed']);
        return redirect()->back()->with('success', 'Order completed and served.');
    }
}
