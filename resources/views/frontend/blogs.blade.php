@extends('frontend.layout.app')
@section('content')
@php
$url = url('/public/frontend/images/big_image_1.jpg');
@endphp

<!-- END section -->

@php
if(!isset($blogs)) {
$blogs = App\Blog::where('IsPublished', 1)->paginate(6);
}
foreach($blogs as $blog) {
$category = App\Category::find($blog->CAT_ID);
if($category) $blog->CategoryName = $category->Name;
$bannerTitle = $category->Name;
}
@endphp
<!-- Breadcrumb Section Begin -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h2>Blog</h2>
                    <div class="bt-option">
                        <a href="./home.html">Home</a>
                        <span>Blog Grid</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog-section blog-page spad">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)

            <div class="col-lg-4 col-md-6">
                <div class="blog-item set-bg" data-setbg="{{url('public/data/blogs').'/'.$blog->Avatar}}">
                    <div class="bi-text">
                        <span class="b-tag">{{$blog->CategoryName}}</span>
                        <h4><a href="{{url('blogs').'/'.$blog->BLO_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($blog->Title)}}">{{$blog->Title}}</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> {{$blog->UpdatedDate}}</div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-lg-12">
                    <div class="room-pagination">
                       {{$blogs->links()}}
                    </div>
                </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection
@section('js')
<script>
    $('#blogs').addClass('active');
</script>
@endsection