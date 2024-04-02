<!-- resources/views/products/create.blade.php -->

@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Product</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="prod_name">Product Name</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" required>
                        </div>

                        <div class="form-group">
                            <label for="prod_desc">Product Description</label>
                            <textarea class="form-control" id="prod_desc" name="prod_desc" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="img">Images</label>
                            <input type="file" class="form-control-file" id="img" name="img[]" multiple required accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection