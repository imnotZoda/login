<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductListController extends Controller
{
    public function productlist()
    {
        $products = Product::all();
        return view('product.productlist', compact('products'));
    }
}
