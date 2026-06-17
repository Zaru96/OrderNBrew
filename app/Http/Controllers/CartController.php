<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        return view('customer.cart', compact('cart', 'total'));
    }

    public function add(Request $request, Menu $menu)
    {
        if ($menu->status !== 'available') {
            return redirect()->back()->with('error', $menu->name . ' is currently unavailable.');
        }

        $cart = session()->get('cart', []);
        $key  = (string) $menu->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += max(1, (int) $request->get('quantity', 1));
        } else {
            $cart[$key] = [
                'id'       => $menu->id,
                'name'     => $menu->name,
                'price'    => $menu->price,
                'quantity' => max(1, (int) $request->get('quantity', 1)),
                'note'     => $request->get('note', ''),
                'image'    => $menu->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '"' . $menu->name . '" added to cart!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $key  = (string) $request->menu_id;

        if (isset($cart[$key])) {
            $qty = (int) $request->quantity;
            if ($qty <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['quantity'] = $qty;
            }
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[(string) $request->menu_id]);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
