@extends('BackEnd.admin.layout')

@section('content1')
<div class="container">
    <h2 class="mb-4">Add New Product</h2>

    <!-- Show success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Product Add Form -->
    <form action="{{ url('ProductFormTable') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Product Name" required>
        </div>

        <div class="form-group mb-3">
            <label for="price">Product Price:</label>
            <input type="text" id="price" name="price" class="form-control" placeholder="Enter Product Price" required>
        </div>

        <div class="form-group mb-3">
            <label for="img">Product Image:</label>
            <input type="file" id="img" name="img" class="form-control" accept="image/*" required>
        </div>

        <div class="form-group mb-3">
            <label for="category">Select Category:</label>
            <select id="category" name="category" class="form-control" required>
                <option value="">-- Select a Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="Dis">Description:</label>
            <textarea id="Dis" name="Dis" class="form-control" placeholder="Enter Product Description" required></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-lg mt-3">Add Product</button>
    </form>
</div>
@endsection
