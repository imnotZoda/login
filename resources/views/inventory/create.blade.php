<!-- resources/views/inventory/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
</head>
<body>
    <h1>Add Inventory</h1>
    <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="product_id">Product:</label>
        <select name="product_id" id="product_id" required>
            @foreach($products as $product)
                @if (!$product->inventory->count()) <!-- Check if product has no inventory -->
                    <option value="{{ $product->id }}">{{ $product->prod_name }}</option>
                @endif
            @endforeach
        </select>
        <br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" required>
        <br>
        <button type="submit">Add Inventory</button>
    </form>
</body>
</html>
