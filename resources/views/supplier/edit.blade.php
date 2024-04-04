

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Supplier</div>

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

                    <form method="POST" action="{{ route('supplier.update', $supplier->id) }}" enctype="multipart/form-data">
                        @csrf
                       

                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <textarea class="form-control" id="email" name="email" rows="3" required>{{ $supplier->email }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contactno">Type</label>
                            <input type="number" class="form-control" id="contactno" name="contactno" value="{{ $supplier->contactno }}" required>
                        </div>

                        <div class="form-group">
                            <label for="img">Images</label>
                            <input type="file" class="form-control-file" id="img" name="img[]" multiple accept="image/*">
                            @if($supplier->images())
                                @foreach($supplier->images() as $image)
                                    <img src="{{ asset($image) }}" alt="Supplier Image" style="max-width: 100px;">
                                @endforeach
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update Supplier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
