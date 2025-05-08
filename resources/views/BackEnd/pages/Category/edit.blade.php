@extends('BackEnd.admin.layout')

@section('content1')
<div class="container">
    <h2>Edit Category</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="file" class="form-control" id="img" name="img">
            @if($category->img)
                <img src="{{ asset('storage/' . $category->img) }}" alt="Category Image" width="100" class="mt-2">
            @endif
        </div>

        <div class="mb-3">
            <label for="bimg" class="form-label">Background Image</label>
            <input type="file" class="form-control" id="bimg" name="bimg">
            @if($category->bimg)
                <img src="{{ asset('storage/' . $category->bimg) }}" alt="Background Image" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
