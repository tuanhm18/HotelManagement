<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="1990s Hotel Template">
  <meta name="keywords" content="1990s Hotel, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>1990s Hotel</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="{{url('/public/admin')}}/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/flaticon.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="{{url('public/frontend')}}/css/style.css" type="text/css">
  @yield('css')
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Offcanvas Menu Section Begin -->
  <div class="offcanvas-menu-overlay"></div>
  <div class="canvas-open">
    <i class="icon_menu"></i>
  </div>
  <div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
      <i class="icon_close"></i>
    </div>
    <div class="search-icon  search-switch">
      <i class="icon_search"></i>
    </div>
    <div class="header-configure-area">
      <div class="language-option">
        <img src="{{url('public/frontend')}}/img/flag.jpg" alt="">
        <span>EN <i class="fa fa-angle-down"></i></span>
        <div class="flag-dropdown">
          <ul>
            <li><a href="#">Zi</a></li>
            <li><a href="#">Fr</a></li>
          </ul>
        </div>
      </div>
      <a href="#" class="bk-btn">Booking Now</a>
    </div>
    <nav class="mainmenu mobile-menu">
      <ul>
        <li id="home-mobile" class="active"><a  href="url('/')">Home</a></li>
        <li  id="rooms-mobile"><a href="{{url('rooms')}}">Rooms</a></li>
        <li id="aboutUs-mobile"><a href="{{url('about')}}">About Us</a></li>
        <li><a href="./blog.html">News</a></li>
        <li><a href="./contact.html">Contact</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-tripadvisor"></i></a>
      <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
    <ul class="top-widget">
      <li><i class="fa fa-phone"></i> (12) 345 67890</li>
      <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
    </ul>
  </div>
  <!-- Offcanvas Menu Section End -->

  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="top-nav">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <ul class="tn-left">
              <li><i class="fa fa-phone"></i> (12) 345 67890</li>
              <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
            </ul>
          </div>
          <div class="col-lg-6">
            <div class="tn-right">
              <div class="top-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
              </div>
              <a href="#" class="bk-btn">Booking Now</a>
              <div class="language-option">
                <img src="{{url('public/frontend')}}/img/flag.jpg" alt="">
                <span>EN <i class="fa fa-angle-down"></i></span>
                <div class="flag-dropdown">
                  <ul>
                    <li><a href="#">Zi</a></li>
                    <li><a href="#">Fr</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="menu-item">
      <div class="container">
        <div class="row">
          <div class="col-lg-2">
            <div class="logo">
              <a href="./index.html">
                <img src="{{url('public/frontend')}}/img/logo.png" alt="">
              </a>
            </div>
          </div>
          <div class="col-lg-10">
            <div class="nav-menu">
              <nav class="mainmenu">
                <ul>
                  <li id="home"><a  href="{{url('/')}}">Home</a></li>
                  <li id="rooms"><a href="{{url('rooms')}}">Rooms</a></li>
                  <li id="aboutUs"><a href="{{url('about')}}">About Us</a></li>
                  <li id="blogs"><a href="{{url('blogs')}}">Blogs</a></li>
                  <li id="contact"><a href="{{url('contact')}}">Contact</a></li>
                </ul>
              </nav>
              <div class="nav-right search-switch">
                <i class="icon_search"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->

  <!-- Hero Section Begin -->
  @yield('content')

  <!-- Footer Section Begin -->
  <footer class="footer-section">
    <div class="container">
      <div class="footer-text">
        <div class="row">
          <div class="col-lg-4">
            <div class="ft-about">
              <div class="logo">
                <a href="#">
                  <img src="{{url('public/frontend')}}/img/footer-logo.png" alt="">
                </a>
              </div>
              <p>We inspire and reach millions of travelers<br /> across 90 local websites</p>
              <div class="fa-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-youtube-play"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 offset-lg-1">
            <div class="ft-contact">
              <h6>Contact Us</h6>
              <ul>
                <li>(12) 345 67890</li>
                <li>info.colorlib@gmail.com</li>
                <li>856 Cordia Extension Apt. 356, Lake, United State</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 offset-lg-1">
            <div class="ft-newslatter">
              <h6>New latest</h6>
              <p>Get the latest updates and offers.</p>
              <form action="#" class="fn-form">
                <input type="text" placeholder="Email">
                <button type="submit"><i class="fa fa-send"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-option">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <ul>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Terms of use</a></li>
              <li><a href="#">Privacy</a></li>
              <li><a href="#">Environmental Policy</a></li>
            </ul>
          </div>
          <div class="col-lg-5">
            <div class="co-text">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Section End -->

  <!-- Search model Begin -->
  <div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
      <div class="search-close-switch"><i class="icon_close"></i></div>
      <form class="search-model-form">
        <input type="text" id="search-input" placeholder="Search here.....">
      </form>
    </div>
  </div>
  <!-- Search model end -->

  <!-- Js Plugins -->
  <script src="{{url('/public/admin')}}/plugins/jquery/jquery.min.js"></script>
  <script src="{{url('/public/admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{url('public/frontend')}}/js/jquery.magnific-popup.min.js"></script>
  <script src="{{url('public/frontend')}}/js/jquery.nice-select.min.js"></script>
  <script src="{{url('public/frontend')}}/js/jquery-ui.min.js"></script>
  <script src="{{url('public/frontend')}}/js/jquery.slicknav.js"></script>
  <script src="{{url('public/frontend')}}/js/owl.carousel.min.js"></script>
  <script src="{{url('public/frontend')}}/js/main.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/bootstrap-select.min.js"></script>
  @yield('js')
</body>
</html>