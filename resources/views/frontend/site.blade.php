@extends('frontend.layout.app')
@section('content')
<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="hero-text">
          <h1>1990s A Luxury Hotel</h1>
          <p>Here are the best hotel booking sites, including recommendations for international
            travel and for finding low-priced hotel rooms.</p>
          <a href="#" class="primary-btn">Discover Now</a>
        </div>
      </div>
      
    </div>
  </div>
  <div class="hero-slider owl-carousel">
    @php
    $banners = App\Banner::where('IsPublished', 1)->get();
    @endphp
    @if(isset($banners))
    @foreach($banners as $banner)

    <div class="hs-item set-bg" data-setbg="{{url('public/data/banners').'/'.$banner->Avatar}}"></div>
    @endforeach
    @endif
  </div>
</section>
<!-- Hero Section End -->

<!-- About Us Section Begin -->
@php
$category = App\Category::where('Code', 'GT')->first();
if($category) {
$introBlog = App\Blog::where('CAT_ID', $category->CAT_ID)->first();
}
@endphp
@if(isset($introBlog))
<section class="aboutus-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="about-text">
          <div class="section-title">
            <span>About Us</span>
            <h2>{{$introBlog->Title}}</h2>
          </div>
          <p class="f-para">{{$introBlog->Description}}</p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="about-pic">
          <div class="row">
            <div class="col-sm-12">
              <img src="{{url('public/data/blogs').'/'.$introBlog->Avatar}}" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
<!-- About Us Section End -->

<!-- Services Section End -->
<section class="services-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <span>What We Do</span>
          <h2>Discover Our Services</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-036-parking"></i>
          <h4>Travel Plan</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-033-dinner"></i>
          <h4>Catering Service</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-026-bed"></i>
          <h4>Babysitting</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-024-towel"></i>
          <h4>Laundry</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-044-clock-1"></i>
          <h4>Hire Driver</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item">
          <i class="flaticon-012-cocktail"></i>
          <h4>Bar & Drink</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
            labore et dolore magna.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Services Section End -->

<!-- Home Room Section Begin -->
@php
$featureRooms = App\Room::where(['IsHot'=>1, 'Status'=>1])->distinct('RTYP_ID')->take(4)->get();
if($featureRooms) {
foreach($featureRooms as $room) {
$roomType = App\RoomType::find($room->RTYP_ID);
if($roomType) {
$room->RoomType = $roomType;
}
$image = App\Image::where('ROO_ID', $room->ROO_ID)->first();
$room->Avatar = $image;
}
}
@endphp

@if(isset($featureRooms))
<section class="hp-room-section">
  <div class="container-fluid">
    <div class="hp-room-items">
      <div class="row justify-content-center">
        @foreach($featureRooms as $room)
        <div class="col-lg-3 col-md-6">
          <div class="hp-room-item set-bg" data-setbg="{{url('public/data/rooms').'/'.$room->Avatar->Image}}">
            <div class="hr-text">
              <h3>{{$room->RoomType->Name}}</h3>
              <h2>{{$room->RoomType->Price}}<span>/Pernight</span></h2>
              <table>
                <tbody>
                  <tr>
                    <td class="r-o">Size:</td>
                    <td>{{$room->RoomType->Size}} ft</td>
                  </tr>
                  <tr>
                    <td class="r-o">Capacity:</td>
                    <td>Max persion {{$room->RoomType->Capacity}}</td>
                  </tr>
                  <tr>
                    <td class="r-o">Bed:</td>
                    <td>{{$room->RoomType->NumberOfBeds}} Beds</td>
                  </tr>
                  <tr>
                    <td class="r-o">Rest room:</td>
                    <td>{{$room->RoomType->NumberOfRests}} Rest rooms</td>
                  </tr>
                </tbody>
              </table>
              <a href="#" class="primary-btn">More Details</a>
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
</section>
@endif
<!-- Home Room Section End -->

<!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <span>Testimonials</span>
          <h2>What Customers Say?</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="testimonial-slider owl-carousel">
          <div class="ts-item">
            <p>After a construction project took longer than expected, my husband, my daughter and I
              needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
              city, neighborhood and the types of housing options available and absolutely love our
              vacation at 1990s Hotel Hotel.</p>
            <div class="ti-author">
              <div class="rating">
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star-half_alt"></i>
              </div>
              <h5> - Alexander Vasquez</h5>
            </div>
            <img src="{{url('public/frontend')}}/img/testimonial-logo.png" alt="">
          </div>
          <div class="ts-item">
            <p>After a construction project took longer than expected, my husband, my daughter and I
              needed a place to stay for a few nights. As a Chicago resident, we know a lot about our
              city, neighborhood and the types of housing options available and absolutely love our
              vacation at 1990s Hotel Hotel.</p>
            <div class="ti-author">
              <div class="rating">
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star"></i>
                <i class="icon_star-half_alt"></i>
              </div>
              <h5> - Alexander Vasquez</h5>
            </div>
            <img src="{{url('public/frontend')}}/img/testimonial-logo.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Testimonial Section End -->

<!-- Blog Section Begin -->
<section class="blog-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <span>Hotel News</span>
          <h2>Our Blog & Event</h2>
        </div>
      </div>
    </div>
    <div class="row">
      @php
      $hotBlogs = App\Blog::where(['IsHot'=>1, 'IsPublished'=>1])->OrderBy('UpdatedDate', "asc")->take(5)->get();
      if($hotBlogs) {
      foreach($hotBlogs as $blog) {
      $category = App\Category::find($blog->CAT_ID);
      if($category) {
      $blog->Category = $category;
      }
      }
      }
      @endphp
      @if(isset($hotBlogs))
      @if(count($hotBlogs) <= 3) @foreach($hotBlogs as $blog) <div class="col-lg-4">
        <div class="blog-item set-bg" data-setbg="{{url('public/data/blogs').'/'.$blog->Avatar}}">
          <div class="bi-text">
            <span class="b-tag">{{$blog->Category->Name}}</span>
            <h4><a href="{{url('blogs').'/'.$blog->BLO_ID.'-'.$blog->Title}}">{{$blog->Title}}</a></h4>
            <div class="b-time"><i class="icon_clock_alt"></i> {{$blog->UpdatedDate}}</div>
          </div>
        </div>
    </div>
    @endforeach
    @endif
    @if(count($hotBlogs) > 3)
    @for($i = 0; $i < 3; $i++) <div class="col-lg-4">
      <div class="blog-item set-bg" data-setbg="{{url('public/data/blogs').'/'.$hotBlogs[$i]->Avatar}}">
        <div class="bi-text">
          <span class="b-tag">{{$hotBlogs[$i]->Category->Name}}</span>
          <h4><a href="{{url('blogs').'/'.$hotBlogs[$i]->BLO_ID.'-'.$hotBlogs[$i]->Title}}">{{$hotBlogs[$i]->Title}}</a></h4>
          <div class="b-time"><i class="icon_clock_alt"></i> {{$hotBlogs[$i]->UpdatedDate}}</div>
        </div>
      </div>
  </div>
  @endfor
  @endif
  @if(count($hotBlogs) == 4)
  <div class="col-lg-12">
    <div class="blog-item small-size set-bg" data-setbg="{{url('public/data/blogs').'/'.$hotBlogs[3]->Avatar}}">
      <div class="bi-text">
        <span class="b-tag">{{$hotBlogs[3]->Category->Name}}</span>
        <h4><a href="{{url('blogs').'/'.$hotBlogs[3]->BLO_ID.'-'.$hotBlogs[3]->Title}}">{{$hotBlogs[3]->Title}}</a></h4>
        <div class="b-time"><i class="icon_clock_alt"></i>{{$hotBlogs[3]->UpdatedDate}}</div>
      </div>
    </div>
  </div>
  @endif
  @if(count($hotBlogs) == 5)
  <div class="col-lg-8">
    <div class="blog-item small-size set-bg" data-setbg="{{url('public/data/blogs').'/'.$hotBlogs[3]->Avatar}}">
      <div class="bi-text">
        <span class="b-tag">{{$hotBlogs[3]->Category->Name}}</span>
        <h4><a href="{{url('blogs').'/'.$hotBlogs[3]->BLO_ID.'-'.$hotBlogs[3]->Title}}">{{$hotBlogs[4]->Title}}</a></h4>
        <div class="b-time"><i class="icon_clock_alt"></i>{{$hotBlogs[3]->UpdatedDate}}</div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="blog-item small-size set-bg" data-setbg="{{url('public/data/blogs').'/'.$hotBlogs[4]->Avatar}}">
      <div class="bi-text">
        <span class="b-tag">{{$hotBlogs[4]->Category->Name}}</span>
        <h4><a href="{{url('blogs').'/'.$hotBlogs[4]->BLO_ID.'-'.$hotBlogs[4]->Title}}">{{$hotBlogs[4]->Title}}</a></h4>
        <div class="b-time"><i class="icon_clock_alt"></i>{{$hotBlogs[4]->UpdatedDate}}</div>
      </div>
    </div>
  </div>
  @endif
  @endif

  </div>
  </div>
</section>
<!-- Blog Section End -->
@endsection
@section('js')
<script>
  $('#home').addClass('active');
</script>
@endsection