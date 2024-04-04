@extends('cart\css\cartindexcss')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!--Font Awesome CDN-->
    <div class="container1">
        <div class="title">
            <h4>Select a <span style="color: #6064b6">Payment</span> method</h4>
        </div>

        <form action="#">
            <input type="radio" name="payment" id="visa">
            <input type="radio" name="payment" id="mastercard">
            <input type="radio" name="payment" id="paypal">
            <input type="radio" name="payment" id="AMEX">


            <div class="category">
                <label for="visa" class="visaMethod">
                    <div class="imgName">
                        <div class="imgContainer visa">
                            <img src="https://i.ibb.co/vdbBkgT/mastercard.jpg" alt="">
                        </div>
                        <span class="name">Master Card Bank Transfer</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

                <label for="mastercard" class="mastercardMethod">
                    <div class="imgName">
                        <div class="imgContainer mastercard">
                            <img src="https://i.ibb.co/x5hwHRG/gcash.png" alt="gcash" style="height: 50px; width: 90px; ">
                        </div>
                        <span class="name">E-Money/Gcash</span>
                    </div>
                     <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

                <label for="paypal" class="paypalMethod">
                    <div class="imgName">
                        <div class="imgContainer paypal">
                            <img src="https://i.ibb.co/0Z6csN1/cod.png" alt="">
                        </div>
                        <span class="name" style="margin-top: 20px;">Cash on Delivery</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

               
            </div>

        </form>
        <button type="button" onclick="prepareCheckout()">Checkout</button>
    </div>






    <div class="container px-4 py-5 mx-auto">

    <div class="orderposition">


    <div class="row d-flex justify-content-center" id="prodcol">
        <div class="col-5">
            <h4 class="heading"  style="margin-left: 30px;" >Shopping Bag</h4>
        </div>
        <div class="col-7">
            <div class="row text-right" style=" margin-left: 5px;">
                <div class="col-4">
                    <h6 class="mt-2">Format</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Quantity</h6>
                </div>
                <div class="col-4">
                    <h6 class="mt-2">Price</h6>
                </div>
            </div>
        </div>
    </div>

    <form id="checkoutForm" method="POST" action="{{ route('checkout') }}">
        @csrf
        <input type="hidden" id="customer_id" value="{{ Auth::user()->customer->id }}">
        <table>
            <thead> 
                <tr>
                    <th>Producssst</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th> <!-- New column for total -->
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                <tr>
                    <td>{{ $cart->product->prod_name }}</td>
                    <td>
                        <input type="number" class="qty-input" value="{{ $cart->qty }}" data-product-id="{{ $cart->product->id }}">
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

       
   

 

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                  
                    <div class="col-lg-5">
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Name on Card</label>
                                <input type="text" id="cname" name="cname" placeholder="Johnny Doe">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Card Number</label>
                                <input type="text" id="cnum" name="cnum" placeholder="1111 2222 3333 4444">
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Expiration Date</label>
                                <input type="text" id="exp" name="exp" placeholder="MM/YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="*">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2" id="totals">
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Subtotal</p>
                            <h6 class="mb-1 text-right">$23.49</h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Shipping</p>
                            <h6 class="mb-1 text-right">$2.99</h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4" id="tax">
                            <p class="mb-1 text-left">Total (tax included)</p>
                            <h6 class="mb-1 text-right">$26.48</h6>
                        </div>
                        <button class="btn-block btn-blue">
                            <span>
                                <span id="checkout">Checkout</span>
                               
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

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
</html>