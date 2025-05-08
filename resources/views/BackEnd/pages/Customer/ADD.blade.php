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
    <form action="{{ url('customerForm') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="name"> Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Product Name" required>

            <label for="price">email</label>
            <input type="text" id="price" name="email" class="form-control" placeholder="Enter Product Price" required>
        </div>



        <div class="form-group mb-3">
            <label for="img">Password</label>
            <input type="text" id="img" name="password" class="form-control" accept="image/*" required>

            <label for="img">Address</label>
            <input type="text" id="img" name="Address" class="form-control" accept="image/*" required>





            <label for="Dis">phone:</label>
            <input type="text" id="img" name="phone" class="form-control" accept="image/*" required>

            <label for="Dis">DOB:</label>
            <input type="date" id="img" name="DOB" class="form-control" accept="image/*" required>

            <label for="Dis">Gender:</label>
            <section>
                <input type="text" id="img" name="Gender" class="form-control" accept="image/*" required>

            </section>
        </div>



        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-lg mt-3">Save</button>
    </form>
</div>
@endsection
