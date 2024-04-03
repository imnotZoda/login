<!-- resources/views/cart/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>
    <form method="post" action="{{ route('cart.checkout') }}">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td><input type="checkbox" name="carts[]" value="{{ $cart->id }}"></td>
                    <td>{{ $cart->product->prod_name }}</td>
                    <td>{{ $cart->qty }}</td>
                    <td>{{ $cart->product->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Checkout</button>
    </form>
</body>
</html>
