<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
</head>
<body>
    <h1>Add to Cart</h1>
    <p>Customer ID: {{ $customerId }}</p>   
   
    <h2>Selected Product:</h2>
    <p>{{ $product->prod_name }} - ${{ $product->price }}</p>
    
    <form method="post" action="{{ route('cart.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="1" min="1">
    <button type="submit">Add to Cart</button>
</form>
</body>
</html>
