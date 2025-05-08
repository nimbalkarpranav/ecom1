@extends('BackEnd.admin.layout')

@section('content1')
<div class="container">
    <h2>Edit Product</h2>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Edit Product Form -->
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- For PUT HTTP method -->

        <!-- Product Name & Price -->
        <div class="form-group row">
            <div class="col-md-6 mb-3">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="price">Product Price:</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>
        </div>

        <!-- Category & Description -->
        <div class="form-group row">
            <div class="col-md-6 mb-3">
                <label for="category">Category:</label>
                <select id="category" name="category" class="form-control" required>
                    <option value="">-- Select a Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if($product->category == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="Dis">Description:</label>
                <textarea id="Dis" name="Dis" class="form-control" rows="4" required>{{ $product->Dis }}</textarea>
            </div>
        </div>

        <!-- Product Image -->
        <div class="form-group mb-3">
            <label for="img">Product Image:</label>
            <input type="file" id="img" name="img" class="form-control" accept="image/*">
            @if($product->img)
                <div class="mt-2">
                    <label>Current Image:</label><br>
                    <img src="{{ asset('assest/storage/' . $product->img) }}" alt="Product Image" width="100">
                </div>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary mt-2">Update Product</button>
    </form>
</div>
@endsection
