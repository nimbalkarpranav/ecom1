@extends('frantEnd.Admin.index')
@section('content')

<section class="food_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Our Menu</h2>
    </div>

    <!-- Category Filter -->
    <ul class="filters_menu">
      <li class="active" data-filter="*">All</li>
      @foreach($categories as $category)
        <li data-filter=".cat{{ $category->id }}">{{ $category->name }}</li>
      @endforeach
    </ul>

    <!-- Product Grid -->
    <div class="filters-content">
      <div class="row grid">
        @foreach($products as $product)
        <div class="col-sm-6 col-lg-4 all cat{{ $product->Category }}">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset('assets/storage/' . $product->img) }}" alt="{{ $product->name }}">
            </div>
            <div class="detail-box">
              <h5>{{ $product->name }}</h5>
              <p>{{ $product->Dis }}</p>
              <div class="options">
                <h6>₹{{ $product->price }}</h6>
                <div class="options d-flex justify-content-between align-items-center">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                      @csrf
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                    </form>
                  </div>
              </div>

            </div>
          </div>
        </div>

        @endforeach

      </div>
    </div>

    <div class="btn-box">
      <a href="#">View More</a>
    </div>
  </div>

</section>

<!-- Isotope Filtering Script -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
  $(document).ready(function(){
    var $grid = $('.grid').isotope({
      itemSelector: '.all',
      layoutMode: 'fitRows'
    });

    $('.filters_menu li').on('click', function(){
      $('.filters_menu li').removeClass('active');
      $(this).addClass('active');
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });
  });
</script>

@endsection
