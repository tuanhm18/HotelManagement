@extends('frontend.layout.app')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text">
          <h2>About Us</h2>
          <div class="bt-option">
            <a href="{{url('/')}}">Home</a>
            <span>About Us</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section End -->

<!-- About Us Page Section Begin -->
@php
$otherCategories = App\Category::take(3)->get();
if($otherCategories){
foreach($otherCategories as $category) {
$blog = App\Blog::where(['CAT_ID'=> $category->CAT_ID, 'IsPublished'=>1])->first();
if($blog) $category->Blog = $blog;
}
}
$category = App\Category::where('Code', 'GT')->first();
if($category) $aboutBlog = App\Blog::where('CAT_ID', $category->CAT_ID)->first();
@endphp
@if(isset($aboutBlog))
<section class="aboutus-page-section spad">
  <div class="container">
    <div class="about-page-text">
      <div class="row">
        <div class="col-12">
          <div class="ap-title">
            <h2>{{$aboutBlog->Title}}.</h2>
            <p>{{$aboutBlog->Description}}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          {!!$aboutBlog->Details!!}
        </div>
      </div>
    </div>
    @if(isset($otherCategories))
    <div class="about-page-services">
      <div class="row">
        @foreach($otherCategories as $category)
        <div class="col-md-4">
          <a href="{{url('blogs/categories').'/'.$category->CAT_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($category->Name)}}">
            <div class="ap-service-item set-bg" data-setbg="{{url('public/data/blogs').'/'.$category->Blog->Avatar}}">
              <div class="api-text">
                <h3>{{$category->Name}}</h3>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</section>
@endif
<!-- About Us Page Section End -->

<!-- Video Section Begin -->
<section class="video-section set-bg" data-setbg="{{url('public/frontend')}}/img/video-bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="video-text">
          <h2>Discover Our Hotel & Services.</h2>
          <p>It S Hurricane Season But We Are Visiting Hilton Head Island</p>
          <a href="https://www.youtube.com/watch?v=EzKkl64rRbM" class="play-btn video-popup"><img src="{{url('public/frontend')}}/img/play.png" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Video Section End -->

<!-- Gallery Section Begin -->
@php
$roomTypes = App\RoomType::take(4)->get();
if($roomTypes) {
foreach($roomTypes as $type) {
$room = App\Room::where(['RTYP_ID'=>$type->RTYP_ID])->first();
if($room) {
$image = App\Image::where('ROO_ID', $room->ROO_ID)->first();
if($image) $room->Image = $image;
$type->Room = $room;
}
}
}

@endphp
@if(isset($roomTypes) && count($roomTypes) == 4)
<section class="gallery-section spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <span>Our Gallery</span>
          <h2>Discover Our Work</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <a href="{{url('rooms/types').'/'.$roomTypes[0]->RTYP_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($roomTypes[0]->Name)}}">
          <div class="gallery-item set-bg" data-setbg="{{url('public/data/rooms').'/'.$roomTypes[0]->Room->Image->Image}}">
            <div class="gi-text">
              <h3>{{$roomTypes[0]->Name}}</h3>
            </div>
          </div>
        </a>
        <div class="row">

          <div class="col-sm-6">
          <a href="{{url('rooms/types').'/'.$roomTypes[1]->RTYP_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($roomTypes[1]->Name)}}">
            <div class="gallery-item set-bg" data-setbg="{{url('public/data/rooms').'/'.$roomTypes[1]->Room->Image->Image}}">
              <div class="gi-text">
                <h3>{{$roomTypes[1]->Name}}</h3>
              </div>
            </div>
          </div>
          </a>
          
          <div class="col-sm-6">
          <a href="{{url('rooms/types').'/'.$roomTypes[2]->RTYP_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($roomTypes[2]->Name)}}">
            <div class="gallery-item set-bg" data-setbg="{{url('public/data/rooms').'/'.$roomTypes[2]->Room->Image->Image}}">
              <div class="gi-text">
                <h3>{{$roomTypes[2]->Name}}</h3>
              </div>
            </div>
          </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
      <a href="{{url('rooms/types').'/'.$roomTypes[3]->RTYP_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($roomTypes[3]->Name)}}">
        <div class="gallery-item large-item set-bg" data-setbg="{{url('public/data/rooms').'/'.$roomTypes[3]->Room->Image->Image}}">
          <div class="gi-text">
            <h3>{{$roomTypes[3]->Name}}</h3>
          </div>
        </div>
        </a>
      </div>
    </div>
  </div>
</section>
@endif
<!-- Gallery Section End -->

@endsection
@section('js')
<script>
  $('#aboutUs').addClass('active');
</script>
@endsection