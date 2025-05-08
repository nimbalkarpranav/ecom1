<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <title>Feane</title>
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />

  <!-- External Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />

  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />

  <style>
    body {
      background-color: #fefefe;
      font-family: 'Segoe UI', sans-serif;
    }

    .header_section {
      background-color: #ffffff;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .navbar-brand span {
      font-size: 30px;
      font-weight: bold;
      color: #222;
    }

    .navbar-nav .nav-link {
      color: #333 !important;
      margin-right: 20px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
      color: #ff5722 !important;
    }

    .user_option i {
      color: #555;
      font-size: 18px;
    }

    .nav_search-btn {
      border: none;
      background: transparent;
      padding: 0 10px;
    }

    .order_online {
      background-color: #ff5722;
      color: #fff;
      padding: 6px 14px;
      border-radius: 25px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .order_online:hover {
      background-color: #e64a19;
    }

    .footer_section {
      background-color: #202020;
      padding-top: 40px;
      color: #444;
    }

    .footer_section h4 {
      font-weight: 600;
    }

    .footer_contact .contact_link_box a {
      color: #333;
      margin-bottom: 10px;
      display: block;
      transition: all 0.2s;
    }

    .footer_contact .contact_link_box a:hover {
      color: #ff5722;
    }

    .footer-logo {
      font-size: 28px;
      font-weight: 700;
      color: #222;
    }

    .footer_social a {
      font-size: 20px;
      margin-right: 12px;
      color: #ffffff;
      transition: 0.3s;
    }

    .footer_social a:hover {
      color: #ff5722;
    }

    .footer-info {
      text-align: center;
      padding-top: 20px;
      font-size: 14px;
    }

    .footer-info a {
      color: #ff5722;
    }
  </style>
</head>

<body>

  <!-- Header Section -->
  <header class="header_section py-3">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="/">
          <span>Feane</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="">☰</span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active"><a class="nav-link" href="/home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="contact">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="/cart">Cart</a></li>


          </ul>
          <div class="user_option d-flex align-items-center">
            <a href="loging" class="user_link"><i class="fa fa-user"></i></a>
            <form class="form-inline ml-3">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </form>
            <a href="" class="order_online ml-3">Order Online</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Dynamic Content -->
  <main>
    <div>@yield('content')</div>
  </main>

  <!-- Footer Section -->
  <footer class="footer_section mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>Contact Us</h4>
            <div class="contact_link_box">
              <a href="#"><i class="fa fa-map-marker"></i><span>Location</span></a>
              <a href="#"><i class="fa fa-phone"></i><span>Call +01 1234567890</span></a>
              <a href="#"><i class="fa fa-envelope"></i><span>demo@gmail.com</span></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="#" class="footer-logo">Feane</a>
            <p>Making this the first true generator on the Internet. It uses a dictionary of Latin words combined with flair.</p>
            <div class="footer_social">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-linkedin"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-pinterest"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>Opening Hours</h4>
          <p>Everyday</p>
          <p>10.00 AM - 10.00 PM</p>
        </div>
      </div>

      <div class="footer-info mt-4">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://html.design/">Free Html Templates</a><br>
          Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <script src="js/custom.js"></script>

  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
</body>

</html>
