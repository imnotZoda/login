<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div>
        <h1>Product Details</h1>
        <p><strong>Name:</strong> {{ $product->prodname }}</p>
        <p><strong>Description:</strong> {{ $product->prod_desc }}</p>
        <p><strong>Type:</strong> {{ $product->type }}</p>
        <p><strong>Price:</strong> {{ $product->price }}</p>
        <p><strong>Images:</strong></p>
        @foreach(explode(',', $product->img) as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 200px;">
        @endforeach
    </div>
    <div>
        a
</div>
@endsection
