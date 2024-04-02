<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
use View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'prod_name' => 'required|string',
            'prod_desc' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'img.*' => 'required|image|mimes:jpg,bmp,png|max:2048',
        ]);

        $product = new Product();
        $product->prod_name = $request->prod_name;
        $product->prod_desc = $request->prod_desc;
        $product->type = $request->type;
        $product->price = $request->price;

        $img_paths = [];
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $product->img = implode(',', $img_paths);
            $product->save();
        }

        // $inventory = new Inventory();
        // $inventory->product_id = $product->id;
        // $inventory->stock = $request->stock;
        // $inventory->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return View::make('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $product->prod_name = $request->prod_name;
    $product->prod_desc = $request->prod_desc;
    $product->type = $request->type;
    $product->price = $request->price;

    if ($request->hasFile('img')) {
        // Delete existing images before saving new ones
        $existingImages = explode(',', $product->img);
        foreach ($existingImages as $existingImage) {
            Storage::delete(str_replace('storage/', 'public/', $existingImage));
        }

        $newImagePaths = [];
        foreach ($request->file('img') as $file) {
            $path = $file->store('public/images');
            $newImagePaths[] = str_replace('public/', 'storage/', $path);
        }
        $product->img = implode(',', $newImagePaths);
    }

    $product->save();

    return redirect()->route('product.index')->with('success', 'Product updated successfully.');
}

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
    $product->restore();
    return redirect()->route('product.index')->with('success', 'Product restored successfully.');
    }

    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete(); // This will permanently delete the product
    return redirect()->route('product.index')->with('success', 'Product permanently deleted successfully.');
}
// public function destroy($id)
// {
//     $product = Product::withTrashed()->findOrFail($id);
//     $product->forceDelete(); // This will permanently delete the product
//     return redirect()->route('product.index')->with('success', 'Product permanently deleted successfully.');
// }
}
