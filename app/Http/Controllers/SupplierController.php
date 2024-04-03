<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

use View;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withTrashed()->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'contactno' => 'required|integer',
            'img.*' => 'required|image|mimes:jpg,bmp,png|max:2048'
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contactno = $request->contactno;

        $img_paths = [];
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $image) {
                $path = $image->store('public/images');
                $img_paths[] = str_replace('public/', 'storage/', $path);
            }
            $supplier->img = implode(',', $img_paths);
            $supplier->save();
        }

        // $inventory = new Inventory();
        // $inventory->product_id = $product->id;
        // $inventory->stock = $request->stock;
        // $inventory->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return View::make('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);

    $supplier->name = $request->name;
    $supplier->email = $request->email;
    $supplier->contactno = $request->contactno;

    if ($request->hasFile('img')) {
        // Delete existing images before saving new ones
        $existingImages = explode(',', $supplier->img);
        foreach ($existingImages as $existingImage) {
            Storage::delete(str_replace('storage/', 'public/', $existingImage));
        }

        $newImagePaths = [];
        foreach ($request->file('img') as $file) {
            $path = $file->store('public/images');
            $newImagePaths[] = str_replace('public/', 'storage/', $path);
        }
        $supplier->img = implode(',', $newImagePaths);
    }

    $supplier->save();

    return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
}

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
    public function restore($id)
    {
        $supplier = Supplier::withTrashed()->findOrFail($id);
    $supplier->restore();
    return redirect()->route('supplier.index')->with('success', 'Supplier restored successfully.');
    }

    public function destroy($id)
{
    $supplier = Supplier::findOrFail($id);
    $supplier->delete(); // This will permanently delete the supplier
    return redirect()->route('supplier.index')->with('success', 'Supplier permanently deleted successfully.');
}
// public function destroy($id)
// {
//     $product = Product::withTrashed()->findOrFail($id);
//     $product->forceDelete(); // This will permanently delete the product
//     return redirect()->route('product.index')->with('success', 'Product permanently deleted successfully.');
// }
}