@extends('BackEnd.admin.layout')
@section('content1')
<div class="container mt-5">
    <h2>Add New Offer</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="offers" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="Img" class="form-label">Offer Image</label>
            <input type="file" class="form-control" name="Img" required>
        </div>

        <div class="mb-3">
            <label for="Dis" class="form-label">Discount Description</label>
            <input type="text" class="form-control" name="Dis" placeholder="e.g. Flat 50% on all items" required>
        </div>

        <div class="mb-3">
            <label for="percentage" class="form-label">Discount Percentage</label>
            <input type="number" class="form-control" name="percentage" placeholder="e.g. 50" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Offer</button>
    </form>
</div>
@endsection
