<!-- resources/views/inventory/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
</head>
<body>
    <h1>Edit Inventory</h1>
    <form action="{{ route('inventory.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" id="product_id" value="{{ $inventory->product_id }}" required>
        <br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" value="{{ $inventory->stock }}" required>
        <br>
        <button type="submit">Update Inventory</button>
    </form>
</body>
</html>
