<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::prefix('product')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
});

// Route::get('/product', [ProductController::class, 'index'])->name('product.index');
// Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
// Route::post('/product', [ProductController::class, 'store'])->name('product.store');
// Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
// Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
// Route::delete('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');


Route::prefix('suppliers')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/{id}/restore', [SupplierController::class, 'restore'])->name('supplier.restore');
    Route::delete('/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
    Route::delete('/{id}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});

Route::prefix('inventory')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    Route::get('/create', [InventoryController::class, 'create'])->name('inventory.create');
    Route::post('/store', [InventoryController::class, 'store'])->name('inventory.store');
    Route::get('/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/{id}/update', [InventoryController::class, 'update'])->name('inventory.update');
    Route::get('/{id}/restore', [InventoryController::class, 'restore'])->name('inventory.restore');
});

// Route for showing the edit form
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');

// Route::get('/productlist', [ProductListController::class, 'productlist'])->name('productlist');

// Route::get('product/productlist', [ProductListController::class, 'ProductList'])->name('product.productlist');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/add/{product_id}', [CartController::class, 'addcart'])->name('cart.AddtoCart');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    Route::put('/orders/{order}/update-status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

    Route::post('/update-order-status', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');
    Route::get('/update-order-status', [AdminController::class, 'showUpdateOrderStatusForm'])->name('admin.showUpdateOrderStatusForm');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
});

// Route::post('/admin/update-order-status', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');
// Route::get('/admin/update-order-status', [AdminController::class, 'showUpdateOrderStatusForm'])->name('admin.showUpdateOrderStatusForm');
