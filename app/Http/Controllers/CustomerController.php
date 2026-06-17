<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;

class CustomerController extends Controller
{
    public function home()
    {
        $totalMenus = \App\Models\Menu::where('status', 'available')->count();
        return view('customer.home', compact('totalMenus'));
    }

    public function menu()
    {
        $categories = Category::with(['menus' => function ($q) {
            $q->where('status', 'available')->orderBy('name');
        }])->orderBy('name')->get();

        $cartCount = collect(session()->get('cart', []))->sum('quantity');

        return view('customer.menu', compact('categories', 'cartCount'));
    }

    public function tracking()
    {
        return view('customer.tracking');
    }

    public function checkTracking(Request $request)
    {
        $request->validate(['order_code' => 'required|string']);

        $order = Order::where('order_code', $request->order_code)
            ->with(['orderDetails.menu', 'payment'])
            ->first();

        return view('customer.tracking', compact('order'));
    }
}
