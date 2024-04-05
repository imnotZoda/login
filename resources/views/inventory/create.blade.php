@extends('inventory\css\createcss')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
</head>
<body>
<div class="container">
    <h1>Add Inventory</h1>
   
    <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="labels">
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id"  class="label1" required>
            @foreach($products as $product)
                @if (!$product->inventory->count()) 
                    <option value="{{ $product->id }}">{{ $product->prod_name }}</option>
                @endif
            @endforeach
        </select>
        <br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" required>
        <br>
</div>
        <button type="submit">Add Inventory</button>
    </form>
</div>
</body>
</html>
