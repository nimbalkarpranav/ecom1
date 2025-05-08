@extends('frantEnd.Admin.index')
@section('content')



 <!-- book section -->
 <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Contact
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="contact" method="post">
                @csrf
              <div>
                <input type="text" class="form-control" name="name" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" class="form-control"  name="phone" placeholder="Phone Number" />
              </div>
              <div>
                <input type="email" class="form-control"  name="Email"placeholder="Your Email" />
              </div>

              <div>
                <input type="date" class="form-control" name="date">
              </div>
              <div class="btn_box">
                <button>
                  Book Now
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

@endsection
