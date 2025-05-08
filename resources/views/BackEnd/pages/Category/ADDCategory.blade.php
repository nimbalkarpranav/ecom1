
 @extends('BackEnd.admin.layout')
@section('content1')
<div class="container">
    <h2>Add New Category</h2>

    <!-- Show success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Category Add Form -->
    <form action="CategoryAdd" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="img">Category Image:</label>
            <input type="file" id="img" name="img" class="form-control" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="bimg">Banner Image:</label>
            <input type="file" id="bimg" name="bimg" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Category</button>
    </form>
</div>
@endsection
