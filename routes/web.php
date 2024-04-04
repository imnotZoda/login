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


Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::delete('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/suppliers', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('/suppliers/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/suppliers/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('/suppliers/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::get('/suppliers/{id}/restore', [SupplierController::class, 'restore'])->name('supplier.restore');
Route::delete('/suppliers/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
Route::delete('/suppliers/{id}/destroy', [SupplierController::class, 'destroy'])->name('supplier.destroy');

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/inventory/{id}/update', [InventoryController::class, 'update'])->name('inventory.update');
Route::get('/inventory/{id}/restore', [InventoryController::class, 'restore'])->name('inventory.restore');


// Route for showing the edit form
Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
// Route::get('/productlist', [ProductListController::class, 'productlist'])->name('productlist');

Route::get('product/productlist', [ProductListController::class, 'ProductList'])->name('product.productlist');
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

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route::get('/cart/create/{id}', [CartController::class, 'create'])->name('cart.create');
// Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/create', [CartController::class, 'addToCart'])->name('cart.AddtoCart');


