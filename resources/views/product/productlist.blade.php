@extends('layouts.app')

@section('title')
  Product List
@endsection

@section('content')
@include('layouts.flash-messages')

@if(Session::has('message'))
<div class="alert alert-danger alert-dismissible show" role="alert">
  <strong>{{Session::get('message')}}</strong> 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="container">
    <h1 class="my-4">Product List</h1>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
            @if ($product->img)
                        <?php $imgPaths = explode(',', $product->img); ?>
                        <img src="{{ asset($imgPaths[0]) }}" alt="{{ $product->prod_name }}" style="max-width: 500px; max-height: 500px;">
                    @else
                        No Image
                    @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->prod_name }}</h5>
                    <p class="card-text">{{ $product->prod_desc }}</p>
                    <p class="card-text">Stock: {{ $product->inventory->stock }}</p>
                    <p class="card-text">Price: ${{ $product->price }}</p>
                    <a href="{{ route('cart.add', ['product_id' => $product->id, 'quantity' => 1]) }}" class="btn btn-primary">Add to Cart</a>
                    <a href="{{ route('cart.add', ['product_id' => $product->id, 'quantity' => -1]) }}" class="btn btn-secondary">Remove from Cart</a>
                    <a href="#" class="btn btn-default">More Info</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
