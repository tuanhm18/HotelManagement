@extends('frontend.layout.app')
@section('content')
<section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url(images/big_image_1.jpg);">
    <div class="container">
        <div class="row align-items-center site-hero-inner justify-content-center">
            <div class="col-md-12 text-center">

                <div class="mb-5 element-animate">
                    <h1>Reservation</h1>
                    <p>Discover our world's #1 Luxury Room For VIP.</p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END section -->

@if(session()->has('success'))
<div class="container mt-3">
    <h3>Booked Successfully!</h3>
    <div class="alert alert-success">
        Your booking has been publish in our system, we will contact you in the shortest time! Thank you for your time!
    </div>
</div>
@else 
<section class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-5">Reservation Form</h2>
                <form action="{{action('FrontEnd\BookingController@create')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">First name</label>
                            <div style="position: relative;">
                                <input required type='text' class="form-control" id='firstName' name="FirstName" />
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Last name</label>
                            <div style="position: relative;">
                                <input type='text' required class="form-control" id='lastName' name="LastName" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Phone</label>
                            <div style="position: relative;">
                                <input type='text' required class="form-control" id='Phone' name="Phone" />
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Identity Number</label>
                            <div style="position: relative;">
                                <input type='text' required class="form-control" id='IdentityNumber' name="IdentityNumber" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label for="">Arrival Date</label>
                            <div style="position: relative;">
                                <span class="fa fa-calendar icon" style="position: absolute; right: 10px; top: 10px;"></span>
                                <input type='text' required class="form-control" id='CheckInDate' name="CheckInDate" />
                            </div>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Departure Date</label>
                            <div style="position: relative;">
                                <span class="fa fa-calendar icon" style="position: absolute; right: 10px; top: 10px;"></span>
                                <input type='text' required class="form-control" id='CheckOutDate' name="CheckOutDate" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            @php
                                $avaibleRooms = App\Room::where(['Status'=>1])->get();
                                foreach($avaibleRooms as $room) {
                                    $roomType = App\RoomType::findOrFail($room->RTYP_ID);
                                    $room['roomType'] = $roomType;
                                }
                            @endphp
                            <label for="room">Room</label>
                            <select name="Rooms[]" required id="rooms" multiple="multiple" class="md-select md-form form-control">
                                @foreach($avaibleRooms as $room)
                                <option value="{{$room->ROO_ID}}">Room {{$room->ROO_ID}} ({{$room->roomType->Name}})</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" required name="Email" id="email" class="form-control ">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="message">Write a Note</label>
                            <textarea name="Message"  name="Message" id="message" class="form-control " cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="submit" value="Reserve Now" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <h3 class="mb-5">Featured Room</h3>
                <div class="media d-block room mb-0">
                    <figure>
                        <img src="{{url('/public/frontend')}}/images/img_1.jpg" alt="Generic placeholder image" class="img-fluid">
                        <div class="overlap-text">
                            <span>
                                Featured Room
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                                <span class="ion-ios-star"></span>
                            </span>
                        </div>
                    </figure>
                    <div class="media-body">
                        <h3 class="mt-0"><a href="#">Presidential Room</a></h3>
                        <ul class="room-specs">
                            <li><span class="ion-ios-people-outline"></span> 2 Guests</li>
                            <li><span class="ion-ios-crop"></span> 22 ft <sup>2</sup></li>
                        </ul>
                        <p>Nulla vel metus scelerisque ante sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. </p>
                        <p><a href="#" class="btn btn-primary btn-sm">Book Now From $20</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    
@endif
<!-- END section -->




<!-- END section -->
<!-- END section -->
<!-- END footer -->

<!-- loader -->
</body>

</html>
@endsection
@section('js')
<script>
    $('#booking').addClass('active');
    $.fn.datepicker.defaults.format = "yyyy/mm/dd";
    $('#CheckInDate, #CheckOutDate').datepicker({});
    $('select').selectpicker();
</script>
@endsection