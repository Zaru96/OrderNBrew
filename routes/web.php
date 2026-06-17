<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\KitchenController;

// ── Customer ──────────────────────────────────────────────────────────────────
Route::get('/', [CustomerController::class, 'home'])->name('home');
Route::get('/menu', [CustomerController::class, 'menu'])->name('customer.menu');

// Cart
Route::post('/cart/add/{menu}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Payment
Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order}', [PaymentController::class, 'store'])->name('payment.store');

// Invoice
Route::get('/invoice/{order}', [PaymentController::class, 'invoice'])->name('invoice.show');

// Tracking
Route::get('/tracking', [CustomerController::class, 'tracking'])->name('tracking');
Route::post('/tracking', [CustomerController::class, 'checkTracking'])->name('tracking.check');

// ── Admin ─────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('storeCategory');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('destroyCategory');

    // Menus
    Route::get('/menus', [AdminController::class, 'menus'])->name('menus');
    Route::post('/menus', [AdminController::class, 'storeMenu'])->name('storeMenu');
    Route::put('/menus/{menu}', [AdminController::class, 'updateMenu'])->name('updateMenu');
    Route::delete('/menus/{menu}', [AdminController::class, 'destroyMenu'])->name('destroyMenu');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

// ── Cashier ───────────────────────────────────────────────────────────────────
Route::prefix('cashier')->name('cashier.')->group(function () {
    Route::get('/dashboard', [CashierController::class, 'dashboard'])->name('dashboard');
    Route::post('/payment/{order}/approve', [CashierController::class, 'approve'])->name('approve');
    Route::post('/payment/{order}/reject', [CashierController::class, 'reject'])->name('reject');
});

// ── Kitchen ───────────────────────────────────────────────────────────────────
Route::prefix('kitchen')->name('kitchen.')->group(function () {
    Route::get('/dashboard', [KitchenController::class, 'dashboard'])->name('dashboard');
    Route::post('/order/{order}/process', [KitchenController::class, 'process'])->name('process');
    Route::post('/order/{order}/ready', [KitchenController::class, 'ready'])->name('ready');
    Route::post('/order/{order}/complete', [KitchenController::class, 'complete'])->name('complete');
});

require __DIR__.'/auth.php';
