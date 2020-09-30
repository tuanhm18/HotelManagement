@extends('frontend.layout.app')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h2>Our Rooms</h2>
                        <div class="bt-option">
                            <a href="{{url('/')}}">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!-- Rooms Section Begin -->
    @php
      $rooms = App\Room::where('Status', 1)->paginate(6);
      foreach($rooms as $room) {
        $roomType = App\RoomType::find($room->RTYP_ID);
        if($roomType) $room->RoomType = $roomType;
        $image = App\Image::where('ROO_ID', $room->ROO_ID)->first();
        if($image) $room->Avatar = $image;
      }
    @endphp
    @if(isset($rooms))
    <section class="rooms-section spad">
        <div class="container">
            <div class="row justify-content-center">
              @foreach($rooms as $room)
                <div class="col-lg-4 col-md-6">
                    <div class="room-item">
                        <img src="{{url('public/data/rooms').'/'.$room->Avatar->Image}}" alt="">
                        <div class="ri-text">
                            <h4>{{$room->RoomType->Name}}</h4>
                            <h3>{{$room->RoomType->Price}}$<span>/Pernight</span></h3>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>{{$room->RoomType->Size}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>{{$room->RoomType->Size}}</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{url('rooms').'/'.$room->ROO_ID}}" class="primary-btn">More Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="room-pagination">
                       {{$rooms->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Rooms Section End -->
@endsection
@section('js')
<script>
  $('#rooms').addClass('active');
</script>
@endsection