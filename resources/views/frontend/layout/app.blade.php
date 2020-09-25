<!doctype html>
<html lang="en">

<head>
  <title>LuxuryHotel a Hotel Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900|Rubik:300,400,700" rel="stylesheet">

  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/bootstrap.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/animate.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/owl.carousel.min.css">

  <link rel="stylesheet" href="{{url('/public/frontend')}}/fonts/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/fonts/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/magnific-popup.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/bootstrap-datepicker.min.css">
  <!-- Theme Style -->

  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/style.css">
  <link rel="stylesheet" href="{{url('/public/frontend')}}/css/bootstrap-select.min.css">
</head>

<body>

  <header role="banner">

    <nav class="navbar navbar-expand-md navbar-dark bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{action('FrontEnd\SiteController@view')}}">LuxuryHotel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-light" id="navbarsExample05">
          <ul class="navbar-nav ml-auto pl-lg-5 pl-0">
            <li class="nav-item">
              <a class="nav-link" id="home" href="{{action('FrontEnd\SiteController@view')}}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="rooms" href="{{action('FrontEnd\RoomController@view')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rooms</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                @php
                $roomTypes = \App\RoomType::all();
                @endphp
                @foreach($roomTypes as $roomType)
                <a class="dropdown-item" href="rooms.html">{{$roomType->Name}}</a>
                @endforeach
              </div>

            </li>
            <li class="nav-item">
              <a class="nav-link" id="blog" href="">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="about" href="{{action('FrontEnd\AboutController@view')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact" href="{{action('FrontEnd\ContactController@view')}}">Contact</a>
            </li>
  
            <li class="nav-item cta">
              <a class="nav-link" id="booking" href="{{action('FrontEnd\BookingController@view')}}"><span>Book Now</span></a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
  </header>
  <!-- END header -->
 

  @yield('content')
  <footer class="site-footer">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-4">
          <h3>Phone Support</h3>
          <p>24/7 Call us now.</p>
          <p class="lead"><a href="tel://">+ 1 332 3093 323</a></p>
        </div>
        <div class="col-md-4">
          <h3>Connect With Us</h3>
          <p>We are socialized. Follow us</p>
          <p>
            <a href="#" class="pl-0 p-3"><span class="fa fa-facebook"></span></a>
            <a href="#" class="p-3"><span class="fa fa-twitter"></span></a>
            <a href="#" class="p-3"><span class="fa fa-instagram"></span></a>
            <a href="#" class="p-3"><span class="fa fa-vimeo"></span></a>
            <a href="#" class="p-3"><span class="fa fa-youtube-play"></span></a>
          </p>
        </div>
        <div class="col-md-4">
          <h3>Connect With Us</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, odio.</p>
          <form action="#" class="subscribe">
            <div class="form-group">
              <button type="submit"><span class="ion-ios-arrow-thin-right"></span></button>
              <input type="email" class="form-control" placeholder="Enter email">
            </div>

          </form>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-7 text-center">
          &copy;
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
      </div>
    </div>
  </footer>
  <!-- END footer -->

  <!-- loader -->
  <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" /></svg></div>

  <script src="{{url('/public/frontend')}}/js/jquery-3.2.1.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/bootstrap-datepicker.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/jquery-migrate-3.0.0.js"></script>
  <script src="{{url('/public/frontend')}}/js/popper.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/bootstrap.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/owl.carousel.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/jquery.waypoints.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/jquery.stellar.min.js"></script>

  <script src="{{url('/public/frontend')}}/js/jquery.magnific-popup.min.js"></script>
  <script src="{{url('/public/frontend')}}/js/magnific-popup-options.js"></script>

  <script src="{{url('/public/frontend')}}/js/main.js"></script>
  <script src="{{url('/public/frontend')}}/js/bootstrap-select.min.js"></script>
  @yield('js')
</body>

</html>