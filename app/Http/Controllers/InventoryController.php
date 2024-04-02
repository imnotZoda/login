<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->get();
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string',
            'stock' => 'required|string',
            'img.*' => 'required|image|mimes:jpg,bmp,png|max:2048'
        ]);

        $inventory = new Inventory();
        $inventory->product_id = $request->product_id;
        $inventory->stock = $request->stock;

        if ($request->hasFile('img')) {
            $img_paths = [];
            foreach ($request->file('img') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $inventory->product->img = implode(',', $img_paths);
        }

        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Stock created successfully.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|string',
            'stock' => 'required|string',
            'img.*' => 'nullable|image|mimes:jpg,bmp,png|max:2048' // Adjusted validation for images
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->product_id = $request->product_id;
        $inventory->stock = $request->stock;

        if ($request->hasFile('img')) {
            $img_paths = [];
            foreach ($request->file('img') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $inventory->product->img = implode(',', $img_paths);
        }

        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
    }

    public function restore($id)
    {
        $inventory = Inventory::withTrashed()->findOrFail($id);
        $inventory->restore();

        return redirect()->route('inventory.index')->with('success', 'Inventory restored successfully.');
    }
}
