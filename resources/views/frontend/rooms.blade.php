@extends('frontend.layout.app')
@section('content')

    <section class="site-section">
      <div class="container">
        <div class="row">
          @php
            $rooms = App\Room::where('Status',1)->get();
            foreach($rooms as $room) {
              $roomType = App\RoomType::find($room->RTYP_ID);
              $room->RoomName = $roomType->Name;
              $room->NumberOfBeds = $roomType->NumberOfBeds;
              $room->NumberOfRests = $roomType->NumberOfRests;
              $room->Price = $roomType->Price;
              $avatar = App\Image::where('ROO_ID',$room->ROO_ID)->first();
              $room->Avatar = $avatar;            }
          @endphp
          @foreach($rooms as $room)
          <div class="col-md-4 mb-4">
            <div class="media d-block room mb-0">
              <figure>
                <img src="{{url('/public/data/rooms').'/'.$room->Avatar->Image}}/" alt="Generic placeholder image" class="img-fluid">
                <div class="overlap-text">
                  <span>
                    {{$room->ROO_ID}}
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                    <span class="ion-ios-star"></span>
                  </span>
                </div>
              </figure>
              <div class="media-body">
                <h3 class="mt-0"><a href="#">{{$room->RoomName}}</a></h3>
                <ul class="room-specs">
                  <li><span class="ion-ios-people-outline"></span> {{$room->NumberOfBeds}}</li>
                  <li><span class="ion-ios-crop"></span>{{$room->NumberOfRests}}</li>
                </ul>
                <p>Nulla vel metus scelerisque ante sollicitudin. Fusce condimentum nunc ac nisi vulputate fringilla. </p>
                <p><a href="#" class="btn btn-primary btn-sm">Book Now From $20</a></p>
              </div>
            </div>
          </div>
          @endforeach
                </div>
                </div>
    </section>

   

    <section class="section-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/img_5.jpg);">
      <div class="container">
        <div class="row justify-content-center align-items-center intro">
          <div class="col-md-9 text-center element-animate">
            <h2>Relax and Enjoy your Holiday</h2>
            <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quidem tempore expedita facere facilis, dolores!</p>
            <div class="btn-play-wrap"><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn-play popup-vimeo "><span class="ion-ios-play"></span></a></div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
    <!-- END footer -->
    
    <!-- loader -->
  </body>
</html>
@endsection
@section('js')
    <script>
        $('#rooms').addClass('active');
    </script>
@endsection