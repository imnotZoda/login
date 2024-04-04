<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderList;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Inventory;


class CartController extends Controller
{
    public function index()
    {
        $customerId = auth()->user()->customer->id;
        $carts = Cart::where('customer_id', $customerId)->with('product')->get();
        return view('cart.index', compact('carts'));
    }

    public function addcart($product_id)
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('customer.create');
        }

        $customer_id = $customer->id;

        $existingCartItem = Cart::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->update(['qty' => $existingCartItem->qty + 1]);
        } else {
            $cartItem = Cart::create([
                'customer_id' => $customer->id,
                'product_id' => $product_id,
                'qty' => 1,
            ]);
        }
        return redirect()->route('home');
    }


public function checkout(Request $request)
{
    $customerId = Auth::user()->customer->id;

    try {
        DB::beginTransaction();
        $order = OrderList::create([
            'customer_id' => $customerId,
            'status' => 'Processing',
            'order_date' => now(),
        ]);
        $cartItems = Cart::where('customer_id', $customerId)->get();
        foreach ($cartItems as $cartItem) {
            OrderProduct::create([
                'orderlist_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'qty' => $cartItem->qty,
            ]);
        }

        // Clear cart
        Cart::where('customer_id', $customerId)->delete();

        DB::commit();
        return redirect()->route('cart.index')->with('success', 'Placed order successfully');
    } catch (Exception $e) {
        DB::rollback();
        return redirect()->route('cart.index')->with('error', 'Failed to complete the checkout.');
    }
}

}
