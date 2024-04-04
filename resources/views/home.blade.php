

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h1> Welcome to the User Dashboard</h1>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

@if(Session::has('message'))
<div class="alert alert-danger alert-dismissible show" role="alert">
  <strong>{{Session::get('message')}}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="container" >
    <h1 class="my-4">Product List</h1>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4 ">
            <div class="card ">
            @if ($product->img)
                        <?php $imgPaths = explode(',', $product->img); ?>
                        <img src="{{ asset($imgPaths[0]) }}" alt="{{ $product->prod_name }}" style="max-width: 500px; max-height: 500px;">
                    @else
                        No Image
                    @endif
                <div class="card-body">
                 <h5 class="card-title"> <strong>{{ $product->prod_name }}</strong></h5>
                    <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $product->prod_desc }}</p>
                    <p class="card-text" >${{ $product->price }}</p>
                    <a href="{{ route('cart.AddtoCart', ['product_id' => $product->id]) }}" class="btn btn-primary">Add to Cart</a>

                    <a href="#" class="btn btn-default">More Info</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection