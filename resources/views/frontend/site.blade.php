@extends('frontend.layout.app')
@section('content')
@php
$url = url('/public/frontend/images/big_image_1.jpg');
@endphp

<!-- END section -->
@php
  $banners = App\Banner::where(['IsPublished'=>1])->get();
  @endphp
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    @if(count($banners) > 0)
    <div class="carousel-inner">
      <div class="carousel-item active">

        @php
        $avatar = url('public/data/banners').'/'.$banners[0]->Avatar;
        @endphp
        <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url({{$avatar}});">
          <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
              <div class="col-md-12 text-center">

                <div class="mb-5 element-animate">
                  <h1>{{$banners[0]->Title}}</h1>
                  <p>{{$banners[0]->Description}}</p>
                </div>


              </div>
            </div>
          </div>
        </section>
      </div>
      @if(count($banners) > 1)
      @for($i = 1; $i < count($banners); $i++)
      <div class="carousel-item">

        @php
        $avatar = url('public/data/banners').'/'.$banners[$i]->Avatar;
        @endphp
        <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url({{$avatar}});">
          <div class="container">
            <div class="row align-items-center site-hero-inner justify-content-center">
              <div class="col-md-12 text-center">

                <div class="mb-5 element-animate">
                  <h1>{{$banners[$i]->Title}}</h1>
                  <p>{{$banners[$i]->Description}}</p>
                </div>


              </div>
            </div>
          </div>
        </section>
      </div>
      @endfor
      @endif
    </div>
    @endif
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<section class="site-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <div class="heading-wrap text-center element-animate">
          <h4 class="sub-heading">Stay with our luxury rooms</h4>
          <h2 class="heading">Stay and Enjoy</h2>
          <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus illo similique natus, a recusandae? Dolorum, unde a quibusdam est? Corporis deleniti obcaecati quibusdam inventore fuga eveniet! Qui delectus tempore amet!</p>
          <p><a href="#" class="btn btn-primary btn-sm">More About Us</a></p>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-7">
        <img src="{{url('/public/frontend')}}/images/f_img_1.png" alt="Image placeholder" class="img-md-fluid">
      </div>
    </div>
  </div>
</section>
<!-- END section -->
@php
$featuredRooms = \App\Room::where(['IsHot'=>1])->take(3)->get()->unique('RTYP_ID');
foreach($featuredRooms as $room) {
$roomType = \App\RoomType::find($room->RTYP_ID);
$room->RoomTypeName = $roomType->Name;
$image = \App\Image::where(['ROO_ID'=>$room->ROO_ID])->first();
if($image) {
$room->Image = $image->Image;
}
}
@endphp
@if(count($featuredRooms) != 0)
<section class="site-section bg-light">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12 heading-wrap text-center">
        <h4 class="sub-heading">Our Luxury Rooms</h4>
        <h2 class="heading">Featured Rooms</h2>
      </div>
    </div>
    <div class="row ">
      <div class="col-md-7">
        <div class="media d-block room mb-0">
          <figure>
            @php
            $avatarName = $featuredRooms[0]->Image;
            @endphp
            <img src="{{url('public/data/rooms/'.$avatarName)}}" alt="Generic placeholder image" class="img-fluid">
            <div class="overlap-text">
              <span>
                {{$featuredRooms[0]->RoomTypeName}}
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
      <div class="col-md-5 room-thumbnail-absolute">
        @for($i = 1; $i < count($featuredRooms); $i++) @php $avatar=$featuredRooms[$i]->Image;
          $url = url('public/data/rooms').'/'.$avatar;
          @endphp
          <a href="#" class="media d-block room bg first-room" style="background-image: url('{{$url}}'); ">
            <!-- <figure> -->
            <div class="overlap-text">
              <span>
                {{$featuredRooms[$i]->RoomTypeName}}
                <span class="ion-ios-star"></span>
                <span class="ion-ios-star"></span>
                <span class="ion-ios-star"></span>
              </span>
              <span class="pricing-from">
                from $22
              </span>
            </div>
            <!-- </figure> -->
          </a>
          @endfor
      </div>
    </div>
  </div>
</section>
@endif


<!-- <section class="section-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/img_5.jpg);">
  <div class="container">
    <div class="row justify-content-center align-items-center intro">
      <div class="col-md-9 text-center element-animate">
        <h2>Relax and Enjoy your Holiday</h2>
        <p class="lead mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto quidem tempore expedita facere facilis, dolores!</p>
        <div class="btn-play-wrap"><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn-play popup-vimeo "><span class="ion-ios-play"></span></a></div>
      </div>
    </div>
  </div>
</section> -->
<!-- END section -->

<section class="site-section bg-light">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-12 heading-wrap text-center">
        <h4 class="sub-heading">Our Blog</h4>
        <h2 class="heading">Our Recent Blog</h2>
      </div>
    </div>
    <div class="row ">
      @php
      $blogs = \App\Blog::where(['IsPublished' => 1, 'IsHot'=>1])->take(3)->get();
      if($blogs) {
        foreach($blogs as $blog) {
          $blog->Url = url('blogs').'/'.$blog->BLO_ID;
        }
      }
      @endphp
      @if($blogs)
      @foreach($blogs as $blog)
      <div class="col-md-4">
        <div class="post-entry">
          <img src="{{url('/public/data/blogs').'/'.$blog->Avatar}}" alt="Image placeholder" class="img-fluid">
          <div class="body-text">
            <div class="category">{{$blog->Title}}</div>
            <h3 class="mb-3"><a href="{{$blog->Url}}">{{$blog->Title}}</a></h3>
            <p class="mb-4">{{$blog->Description}}</p>
            <p><a href="{{$blog->Url}}" class="btn btn-primary btn-outline-primary btn-sm">Read More</a></p>
          </div>
        </div>
      </div>
      @endforeach
      @endif
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
  $('#home').addClass('active');
</script>
@endsection