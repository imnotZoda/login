
@extends('cart\css\cartindexcss')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>
    <form id="checkoutForm" method="POST" action="{{ route('checkout') }}">
        @csrf
        <input type="hidden" id="customer_id" value="{{ Auth::user()->customer->id }}">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td>{{ $cart->product->prod_name }}</td>
                    <td>
                     <input type="number" class="qty-input" value="{{ $cart->qty }}" data-product-id="{{ $cart->product->id }}" min="1">
                    </td>
                    <td>{{ $cart->product->price }}</td>
                    <td>{{ $cart->qty * $cart->product->price }}</td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Grand Total: <span id="grandTotal">{{ $carts->sum(function ($cart) { return $cart->qty * $cart->product->price; }) }}</span></p>
        <button type="button" onclick="prepareCheckout()">Checkout</button>
    </form>

    <!-- JavaScript code to prepare checkout data and update totals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInputs = document.querySelectorAll('.qty-input');
            qtyInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    updateTotal();
                });
            });
        });

        function updateTotal() {
            var grandTotal = 0;
            var tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(function(row) {
                var quantity = parseInt(row.querySelector('.qty-input').value);
                var price = parseFloat(row.cells[2].textContent);
                var total = quantity * price;
                row.cells[3].textContent = total.toFixed(2);
                grandTotal += total;
            });
            document.getElementById('grandTotal').textContent = grandTotal.toFixed(2);
        }

        function prepareCheckout() {
            var customerID = document.getElementById('customer_id').value;
            var message = "Customer ID: " + customerID + "\n";
            var tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(function(row) {
                var productName = row.cells[0].textContent;
                var quantity = row.querySelector('.qty-input').value;
                var price = row.cells[2].textContent;
                var total = row.cells[3].textContent;
                message += "Product: " + productName + ", Quantity: " + quantity + ", Price: " + price + ", Total: " + total + "\n";
            });
            alert("Checkout Information:\n" + message);
            document.getElementById("checkoutForm").submit();
        }
    </script>
</body>
</html>




