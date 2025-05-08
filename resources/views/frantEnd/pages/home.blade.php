@extends('frantEnd.Admin.index')
@section('content')

<!-- Hero Area with Light Gray Background -->
<div class="hero_area" style="background-color: #f8f9fa;">
  <div class="bg-box">
    <img src="images/hero-bg.jpg" alt="">
  </div>

  <!-- Slider Section -->
  <section class="slider_section">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        @foreach($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <div class="container">
            <div class="row">
              <div class="col-md-7 col-lg-6">
                <div class="detail-box">
                  <h1>{{ $slider->title }}</h1>
                  <p>{{ $slider->description }}</p>
                  <div class="btn-box">
                    <a href="{{ $slider->btn_link }}" class="btn1">{{ $slider->btn_text }}</a>
                  </div>
                </div>
              </div>
              <div class="col-md-5 col-lg-6">
                <div class="img-box">
                     {{-- <img src="{{ asset($slider->image) }}" alt="slider image" class="img-fluid" /> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="container">
        <ol class="carousel-indicators">
          @foreach($sliders as $key => $slider)
          <li data-target="#customCarousel1" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
          @endforeach
        </ol>
      </div>
    </div>
  </section>
</div>

<!-- Offer Section -->
<section class="offer_section layout_padding-bottom" style="background-color: #bdbdbd;">
  <div class="offer_container">
    <div class="container">
      <div class="row">
        @foreach($offers as $offer)
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="{{ asset($offer->Img) }}" alt="{{ $offer->Dis }}" style="width: 100%; height: auto;">
            </div>
            <div class="detail-box">
              <h5>{{ $offer->Dis }}</h5>
              <h6><span>{{ $offer->percentage }}%</span> Off</h6>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Food Section -->
<section class="food_section layout_padding" style="background-color: #ffffff;">
  <div class="container">

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

<!-- Client Section -->
<section class="client_section layout_padding-bottom" style="background-color: #f1f1f1;">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45">
      <h2>What Says Our Customers</h2>
    </div>
    <div class="carousel-wrap row">
      <div class="owl-carousel client_owl-carousel">
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
              <h6>Moana Michell</h6>
              <p>magna aliqua</p>
            </div>
            <div class="img-box">
              <img src="images/client1.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
              <h6>Mike Hamell</h6>
              <p>magna aliqua</p>
            </div>
            <div class="img-box">
              <img src="images/client2.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Scripts -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
  $(document).ready(function () {
    var $grid = $('.grid').isotope({
      itemSelector: '.all',
      layoutMode: 'fitRows'
    });

    $('.filters_menu li').on('click', function () {
      $('.filters_menu li').removeClass('active');
      $(this).addClass('active');
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });
  });
</script>

@endsection
