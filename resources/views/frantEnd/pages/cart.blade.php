@extends('frantEnd.Admin.index')

@section('content')
<section class="food_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Your Cart</h2>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="thead-dark">
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach(session('cart') as $id => $item)
          @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
          <tr>
            <td><img src="{{ asset('assets/storage/' . $item['img']) }}" width="60"></td>
            <td>{{ $item['name'] }}</td>
            <td>₹{{ $item['price'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>₹{{ $itemTotal }}</td>
            <td>
              <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">X</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="text-right mt-3">
      <h4>Total: ₹{{ $total }}</h4>
      <a href="checkout" class="btn btn-primary">Proceed to Checkout</a>
    </div>
    @else
    <p class="text-center">Your cart is empty.</p>
    @endif
  </div>
</section>
@endsection
