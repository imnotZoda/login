
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

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

                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        

                        <div class="form-group">
                            <label for="prod_name">Product Name</label>
                            <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="prod_desc">Product Description</label>
                            <textarea class="form-control" id="prod_desc" name="prod_desc" rows="3" required>{{ $product->prod_desc }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $product->type }}" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
                        </div>

                       
                           <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $product->suppliers->contains('id', $supplier->id) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                      
                        <div class="form-group">
                            <label for="date_supplied">Date Supplied</label>
                            <input type="date" class="form-control" id="date_supplied" name="date_supplied" value="{{ $product->suppliers->first()->pivot->date_supplied }}" required>
                        </div>

                        <div class="form-group">
                            <label for="prod_price">Product Price</label>
                            <input type="number" class="form-control" id="prod_price" name="prod_price" step="0.01" value="{{ $product->suppliers->first()->pivot->prod_price }}" required>
                        </div>


                        <div class="form-group">
                            <label for="img">Images</label>
                            <input type="file" class="form-control-file" id="img" name="img[]" multiple accept="image/*">
                            @if($product->images())
                                @foreach($product->images() as $image)
                                    <img src="{{ asset($image) }}" alt="Product Image" style="max-width: 100px;">
                                @endforeach
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection