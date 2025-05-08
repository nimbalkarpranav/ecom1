@extends('BackEnd.admin.layout')

@section('content1')
<div class="container py-4">
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a href="CategoryAdd" class="btn btn-primary mb-3">Add Category</a>

<!-- Category Table -->
<table id="add-row" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Banner Image</th>
            <th style="width: 10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>

                    <img src="{{ asset('assets/storage/' . $category->img) }}" alt="Category Image" width="50">

            </td>


                <td><img src="{{ asset('assets/storage/' . $category->Bimg) }}" alt="Banner Image" width="50"></td>


            <td>
                <div class="form-button-action">
                    <!-- Edit Button -->
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Category">
                        <i class="fa fa-edit"></i>
                    </a>
                    <!-- Delete Button -->
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
