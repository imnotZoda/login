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
        // Retrieve the authenticated user's customer ID
        $customerId = auth()->user()->customer->id;

        // Retrieve carts associated with the customer
        $carts = Cart::where('customer_id', $customerId)->with('product')->get();

        // Return the view with cart data
        return view('cart.index', compact('carts'));
    }

    public function addToCart($product_id)
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
            $existingCartItem->update(['qty' => $existingCartItem->cart_qty + 1]);
        } else {
            $cartItem = Cart::create([
                'customer_id' => $customer->id,
                'product_id' => $product_id,
                'qty' => 1,
            ]);
        }
        return redirect()->route('customer.index');
    }

//     public function create(Request $request)
// {
//     // Check if the user is authenticated
//     if (!auth()->check()) {
//         return redirect()->back()->with('error', 'User is not authenticated.');
//     }

//     // Retrieve the authenticated user
//     $user = auth()->user();

//     // Check if the user has a related customer
//     if (!$user->customer) {
//         return redirect()->back()->with('error', 'Customer not found for this user.');
//     }

//     // Retrieve the customer ID
//     $customerId = $user->customer->id;

//     // Check if the customer ID exists
//     if (!$customerId) {
//         return redirect()->back()->with('error', 'Customer ID not found.');
//     }

//     // Retrieve the product ID from the request
//     $product_id = $request->route('id');

//     // Find the product
//     $product = Product::findOrFail($product_id);

//     // Check if the product exists
//     if (!$product) {
//         return redirect()->back()->with('error', 'Product not found.');
//     }

//     // Pass data to the view
//     return view('cart.create', compact('product', 'customerId'));
// }
// public function store(Request $request)
// {
//     // Validate the form data
//     $request->validate([
//         'product_id' => 'required|exists:products,id',
//         'quantity' => 'required|integer|min:1',
//     ]);

//     // Create a new Cart instance
//     $cart = new Cart();

//     // Assign the data from the form
//     $cart->customer_id = auth()->user()->customer->id;
//     $cart->product_id = $request->input('product_id');
//     $cart->quantity = $request->input('quantity');

//     // Save the cart instance
//     $cart->save();

//     // Redirect to the cart index page with success message
//     return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
// }

// public function store(Request $request)
// {
//     // Validate the form data
//     $request->validate([
//         'product_id' => 'required|exists:products,id',
//         'quantity' => 'required|integer|min:1',
//     ]);

//     // Create a new Cart instance
//     $cart = new Cart();

//     $cart->customer_id = auth()->user()->customer->id;
//     $cart->product_id = $request->input('product_id');
//     $cart->qty = $request->input('quantity');

//     $product = Product::findOrFail($cart->product_id);

//     $cart->save();
//     return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
// }

// public function checkout(Request $request)
// {
//     dd($request);
//     // Retrieve the current logged-in customer's ID
//     $customerId = auth()->user()->customer->id;

//     // Create a new order
//     $orderlist = new OrderList();
//     $orderlist->order_date = now(); // Current date
//     $orderlist->status = 'pending'; // Default status
//     $orderlist->customer_id = $customerId;
//     $orderlist->save();

//     // Retrieve the newly created order ID
//     $orderlistId = $orderlist->id; // Assuming 'order_id' is the primary key

//     // Retrieve cart items from the request

//      $carts = $request->input('carts');

//     // $carts = Cart::where('customer_id', $customerId);

//     // Create order items for each cart item
//     foreach ($carts as $cart) {
//         $orderProduct = new OrderProduct();
//         // $orderProduct->qty = $cart['qty'];
//         $orderProduct->orderlist_id = $orderId;
//         $orderProduct->product_id = $cart['product_id'];
//         // $orderProduct->product_id = $carts->product_id;
//         $orderProduct->qty = $cart['qty'];
//         $orderProduct->save();

//         // Deduct quantity from inventory stock
//         $inventory = Inventory::where('product_id', $cart['product_id'])->first();
//         if ($inventory) {
//             $inventory->stock -= $cart['qty'];
//             $inventory->save();
//         } else {
//             // Handle case where inventory record doesn't exist for the product
//         }
//     }
//     Cart::whereIn('product_id', collect($carts)->pluck('product_id'))->delete();
  
//     return response()->json(['message' => 'Checkout successful'], 200);
// }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $customerId = $user->customer->id;

        try {
            DB::beginTransaction();

            $cartItems = Cart::where('customer_id', $customerId)->get();

            $order = OrderList::create([
                'customer_id' => $customerId,
                'status' => 'Processing',
                'order_date' => now(),
            ]);

            $orderproducts = '';

            foreach ($cartItems as $cartItem) {
                $productId = $cartItem->product_id;
                $quantity = $cartItem->qty;

                $orderproducts .= "($order->id, $productId, $quantity),";

                $inventory = Inventory::where('product_id', $productId)->firstOrFail();
                $inventory->stock -= $quantity;
                $inventory->save();
            }

            $orderproducts = rtrim($orderproducts, ',');

            if (!empty($orderproducts)) {
                $sql = "INSERT INTO order_products (orderlist_id, product_id, qty) VALUES $orderproducts";
                DB::statement($sql);
            }

            Cart::where('customer_id', $customerId)->delete();
            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Placed order successfully');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')->with('error', 'Failed to complete the checkout.');
        }
    }
}
