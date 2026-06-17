<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\Category;

class AdminController extends Controller
{
    // ── Dashboard ─────────────────────────────────────────────────────────────

    public function dashboard()
    {
        $totalOrders     = Order::count();
        $pendingOrders   = Order::whereIn('order_status', ['waiting_payment', 'waiting', 'processing', 'ready'])->count();
        $completedOrders = Order::where('order_status', 'completed')->count();
        $totalRevenue    = Order::where('payment_status', 'paid')->sum('total_price');
        $recentOrders    = Order::with('payment')->latest()->take(10)->get();
        $totalMenus      = Menu::count();

        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'completedOrders',
            'totalRevenue', 'recentOrders', 'totalMenus'
        ));
    }

    // ── Categories ────────────────────────────────────────────────────────────

    public function categories()
    {
        $categories = Category::withCount('menus')->orderBy('name')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name']);
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category "' . $request->name . '" added successfully.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name,' . $category->id]);
        $category->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category updated.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted.');
    }

    // ── Menus ─────────────────────────────────────────────────────────────────

    public function menus()
    {
        $menus      = Menu::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get();
        return view('admin.menus', compact('menus', 'categories'));
    }

    public function storeMenu(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|integer|min:0',
            'status'      => 'required|in:available,unavailable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['category_id', 'name', 'description', 'price', 'status']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);
        return redirect()->back()->with('success', '"' . $request->name . '" added to menu.');
    }

    public function updateMenu(Request $request, Menu $menu)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|integer|min:0',
            'status'      => 'required|in:available,unavailable',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['category_id', 'name', 'description', 'price', 'status']);
        if ($request->hasFile('image')) {
            if ($menu->image) {
                \Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);
        return redirect()->back()->with('success', '"' . $menu->name . '" updated.');
    }

    public function destroyMenu(Menu $menu)
    {
        if ($menu->image) {
            \Storage::disk('public')->delete($menu->image);
        }
        $menu->delete();
        return redirect()->back()->with('success', 'Menu item deleted.');
    }

    // ── Reports ───────────────────────────────────────────────────────────────

    public function reports()
    {
        $totalOrders   = Order::where('payment_status', 'paid')->count();
        $totalRevenue  = Order::where('payment_status', 'paid')->sum('total_price');
        $todayRevenue  = Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_price');
        $todayOrders   = Order::where('payment_status', 'paid')->whereDate('created_at', today())->count();

        $topMenus = \App\Models\OrderDetail::with('menu')
            ->selectRaw('menu_id, SUM(quantity) as total_sold')
            ->groupBy('menu_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        $recentTransactions = Order::with('payment')
            ->where('payment_status', 'paid')
            ->latest()
            ->take(20)
            ->get();

        return view('admin.reports', compact(
            'totalOrders', 'totalRevenue', 'todayRevenue',
            'todayOrders', 'topMenus', 'recentTransactions'
        ));
    }
}
