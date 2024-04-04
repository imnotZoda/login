
@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               

                <div class="card-body">
                <div class="card-header">Create Product</div>
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

                        <div class="form-group1">
                            <label for="prod_name">Product Name</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" required>
                        </div>

                        <div class="form-group2">
                            <label for="prod_desc">Product Description</label>
                            <textarea class="form-control" id="prod_desc" name="prod_desc" rows="3" required></textarea>
                        </div>

                        <div class="form-group3">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="form-group4">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>

                        <div class="form-group5">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group6">
                            <label for="date_supplied">Date Supplied</label>
                            <input type="date" class="form-control" id="date_supplied" name="date_supplied" required>
                        </div>

                        <div class="form-group7">
                            <label for="prod_price">Supplier Price</label>
                            <input type="number" class="form-control" id="prod_price" name="prod_price" step="0.01" required>
                        </div>

                        <div class="form-group8">
                            <label for="img">Images</label>
                            <input type="file" class="form-control-file" id="img" name="img[]" multiple required accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary" id="form-button">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
