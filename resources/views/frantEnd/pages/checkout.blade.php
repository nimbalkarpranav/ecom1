@extends('frantEnd.Admin.index')

@section('content')
<div class="container py-4">
  <h2 class="text-center mb-4">Checkout</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('place.order') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
      <label>Name *</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group mb-3">
      <label>Phone *</label>
      <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="form-group mb-3">
      <label>Address *</label>
      <textarea name="address" class="form-control" rows="3" required></textarea>
    </div>

    <div class="form-group mb-3">
      <label>Payment Method *</label>
      <select name="payment_method" class="form-control">
        <option value="COD">Cash on Delivery</option>
        <option value="Online">Online Payment (Coming Soon)</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Place Order</button>
  </form>
</div>
@endsection
