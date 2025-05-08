@extends('BackEnd.admin.layout');
@section('content1')
<div class="container py-4">
    <h2>Product List</h2>

    <!-- Show success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="ProductFormTable" class="btn btn-primary mb-3">Add Category</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img src="{{ asset('assets/storage/' . $product->img) }}" alt="{{ $product->name }}" width="50">

                    </td>
                    <td>{{ $product->Category}}</td>
                    <td>{{ $product->Dis }}</td>
                    <td>
                         <a href="{{ route('product.edit',$product->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
