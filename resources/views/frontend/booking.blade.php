@extends('frontend.layout.app')
@section('css')
<style>
    .dropdown-toggle {
        margin: 0 !important;
    }

    .bootstrap-select {
        width: 100% !important;
    }
</style>
@endsection
@section('content')
@if(session()->has('success'))
<div class="container mt-3">
    <h3>Booked Successfully!</h3>
    <div class="alert alert-success">
        Your booking has been publish in our system, we will contact you in the shortest time! Thank you for your time!
    </div>
</div>
@endif
@if(session()->has('error'))
<div class="container mt-3">
    <h3>Booked fail!</h3>
    <div class="alert alert-warning">
        {{Session::get('error')}}
    </div>
</div>
@endif
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Sona A Luxury Hotel</h1>
                    <p>Here are the best hotel booking sites, including recommendations for international
                        travel and for finding low-priced hotel rooms.</p>
                    <a href="#" class="primary-btn">Discover Now</a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="booking-form border">
                    <h3>Booking Your Hotel</h3>
                    <form action="{{url('booking')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="check-date col-6">
                                <label for="date-in">First name:</label>
                                <input type="text" name="FirstName">
                            </div>
                            <div class="check-date col-6">
                                <label for="date-in">Last name:</label>
                                <input type="text" name="LastName">
                            </div>
                        </div>
                        <div class="row">
                            <div class="check-date col-6">
                                <label for="date-in">Phone:</label>
                                <input type="text" name="Phone">
                            </div>
                            <div class="check-date col-6">
                                <label for="date-in">Email:</label>
                                <input type="Email" name="Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="check-date col-6">
                                <label for="date-in">Address:</label>
                                <input type="text" name="Address">
                            </div>
                            <div class="check-date col-6">
                                <label for="date-in">Identify Number:</label>
                                <input type="text" name="IdentityNumber">
                            </div>
                        </div>
                        <div class="row">
                            <div class="check-date col-6">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" name="CheckInDate" autocomplete="off" id="date-in">
                                <i class="icon_calendar"></i>
                            </div>
                            <div class="check-date col-6">
                                <label for="date-out">Check Out:</label>
                                <input type="text" name="CheckOutDate" autocomplete="off" class="date-input" id="date-out">
                                <i class="icon_calendar"></i>
                            </div>
                        </div>
                        @php
                        $rooms = App\Room::where('Status', 1)->get();
                        if($rooms) {
                        foreach($rooms as $room) {
                        $roomType = App\RoomType::find($room->RTYP_ID);
                        if($roomType) $room->RoomType = $roomType;
                        }
                        }
                        @endphp
                        @if(isset($rooms))
                        <div class="select-option">
                            <label for="room">Room:</label>
                            <select id="room" name="Rooms[]" multiple>
                                @foreach($rooms as $room)
                                <option value="{{$room->ROO_ID}}">Room {{$room->RoomType->Name}} ({{$room->ROO_ID}})</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="check-date">
                            <label for="date-in">Message:</label>
                            <textarea style="width: 100%;border:1px solid #ebebeb;" name="Message" id=""></textarea>
                        </div>
                        <button type="submit">Check Availability</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg" data-setbg="img/hero/hero-1.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-2.jpg"></div>
        <div class="hs-item set-bg" data-setbg="img/hero/hero-3.jpg"></div>
    </div>
</section>


@endsection
@section('js')
<script>
    // $('.ui-state-default').click(function(event) {
    //     event.preventDefault();
    // });
    // $('#booking').addClass('active');
    $('select').selectpicker();
</script>
@endsection