<!-- edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" value="{{ $customer->un }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contactno">Contact Number:</label>
                <input type="text" name="contactno" value="{{ $customer->contactno }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="img">Profile Image:</label>
                <input type="file" name="img" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
