<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/dist/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="{{url('/public/admin')}}/dist/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/select2/css/select2.css">

  <!-- summernote -->
  <link rel="stylesheet" href="{{url('/public/admin')}}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{url('/public/admin')}}/dist/css/datatables.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  @yield('css')
  <style>
    .editBtn {
      cursor: pointer;
      color: lightgreen;
    }

    .error {
      color: red;
    }

    .deleteBtn {
      cursor: pointer;
      color: red;
    }

    .select2 .select2-container .select2-container--default {
      width: 100% !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">

                <img src="{{url('/public/admin')}}/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{url('/public/admin')}}/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{url('/public/admin')}}/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{action('Admin\UserController@doLogout')}}" role="button">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{url('/public/admin')}}//dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @php
          $avatar = Cookie::get('userAvatar');
          $userFullName = Cookie::get('userFullName');
          @endphp
          <div class="image">
            <img style="width: 40px;
                                        height: 40px;
                                        object-fit: cover;
                                        border-radius: 50%" src="{{url('public/data/users')}}/{{$avatar}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info text-light">
            {{$userFullName}}
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\BannerController@view')}}" id="booking" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Banners</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\BookingController@view')}}" id="booking" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Booking</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\RoomController@view')}}" id="rooms" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rooms</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\ServiceController@view')}}" id="services" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Service</p>
                  </a>
                </li>
              </ul>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\PositionController@view')}}" id="positions" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Position</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\CustomerController@view')}}" id="customers" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\ServiceBillController@view')}}" id="serviceBills" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Service Bill</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\BillController@view')}}" id="bills" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bill</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\BlogController@view')}}" id="blogs" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blog</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\RoomTypeController@view')}}" id="roomType" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Room Type</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\EmployeeController@view')}}" id="employees" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\CategoryController@view')}}" id="categories" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories</p>
                  </a>
                </li>
              </ul>
              @if(Cookie::get('userRole') == 'Admin')
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{action('Admin\UserManagerController@view')}}" id="users" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User</p>
                  </a>
                </li>
              </ul>
              @endif
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="modal fade" id="alertBookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="max-width: 800px">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <input value="0" type="hidden" name="BOO_ID" id="boo_id">
          <div class="modal-body">
            <form id="bookingForm" action="post">
              <div class="row">
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtFullName" class="col-sm-5 col-form-label required">Identity Number</label>
                    <div class="col-sm-7">
                      <input disabled type="text" required class="form-control" id="identityNumber" name="IdentityNumber" maxlength="200">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Email</label>
                    <div class="col-sm-7 col-xl-8">
                      <input disabled type="text" class="form-control" required id="email" name="Email" maxlength="30">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtFullName" class="col-sm-5 col-form-label required">Phone</label>
                    <div class="col-sm-7">
                      <input disabled type="text" class="form-control" required id="phone" name="Phone" maxlength="200">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Check In Date</label>
                    <div class="col-sm-7 col-xl-8">
                      <input disabled required type="email" class="form-control" id="checkInDate" name="CheckInDate" maxlength="30">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Check Out Date</label>
                    <div class="col-sm-7 col-xl-8">
                      <input disabled required type="email" class="form-control" id="checkOutDate" name="CheckOutDate" maxlength="30">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mt-sm-2">
                  <div class="form-group form-row">
                    <label for="txtIdCardNumber" class="col-sm-5 col-xl-4 col-form-label required">Status</label>
                    <div class="col-sm-7 col-xl-8">
                      <input type="checkbox" name="Status" id="status" checked data-toggle="toggle" data-onstyle="success" data-on="Checked" data-off="UnChecked">
                    </div>
                  </div>
                </div>
              </div>
            </form>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="save()" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{url('/public/admin')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{url('/public/admin')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{url('/public/admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="{{url('/public/admin')}}/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="{{url('/public/admin')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="{{url('/public/admin')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{url('/public/admin')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{url('/public/admin')}}/plugins/moment/moment.min.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{url('/public/admin')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="{{url('/public/admin')}}/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{url('/public/admin')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('/public/admin')}}/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{url('/public/admin')}}/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{url('/public/admin')}}/dist/js/demo.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/datatables.min.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/sweetalert.min.js">
  </script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/site.js"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
  <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="{{url('/public/admin')}}/plugins/select2/js/select2.min.js"></script>
  <script src="{{url('/public/admin')}}/dist/js/bootstrap-select.min.js"></script>

  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('7399371c9fb779f23b08', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-event');
    channel.bind('my-event', function(data) {
      $.ajax({
        url: "http://localhost/HotelManagement/api/admin/booking/" + data.bookingId,
        method: "GET",
        success: function(response) {
          swal({
              title: "New Booking",
              text: "You have new booking, want to check it out?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $('#boo_id').val(response.data.BOO_ID);
                $('#identityNumber').val(response.data.IdentityNumber);
                $('#email').val(response.data.Email);
                $('#phone').val(response.data.Phone);
                $('#checkInDate').val(response.data.CheckInDate);
                $('#checkOutDate').val(response.data.CheckOutDate);
                $('#status').val(response.data.Status);
                response.data.Status == 1 ? $('#status').bootstrapToggle('on') : $('#status').bootstrapToggle('off');
                $('#alertBookingModal').modal('show');
              } 
            });
        }
      })
    });
  </script>
  @yield('js')
</body>

</html>