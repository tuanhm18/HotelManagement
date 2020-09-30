@extends('frontend.layout.app')
@section('content')
<!-- Blog Details Hero Section Begin -->
<section class="blog-details-hero set-bg" data-setbg="{{url('public/data/blogs').'/'.$blog->Avatar}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="bd-hero-text">
                    <span>{{$blog->Category->Name}}</span>
                    <h2>{{$blog->Title}}</h2>
                    <ul>
                        <li class="b-time"><i class="icon_clock_alt"></i> 15th April, 2019</li>
                        <li><i class="icon_profile"></i> Kerry Jones</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="blog-details-text">
                    {!!$blog->Details!!}
                    <div class="tag-share">
                        <div class="tags">
                            @foreach($blog->Tags as $tag)
                            <a href="{{url('blogs/tags/').'/'.$tag->TAG_ID}}">{{$tag->Name}}</a>
                            @endforeach
                        </div>
                        <div class="social-share">
                            <span>Share:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tripadvisor"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <div class="comment-option">
                        <h4>2 Comments</h4>
                        <div class="single-comment-item first-comment">
                            <div class="sc-author">
                                <img src="{{url('public/frontend/img')}}/blog/blog-details/avatar/avatar-1.jpg" alt="">
                            </div>
                            <div class="sc-text">
                                <span>27 Aug 2019</span>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et
                                    dolore magnam.</p>
                                <a href="#" class="comment-btn">Like</a>
                                <a href="#" class="comment-btn">Reply</a>
                            </div>
                        </div>
                        <div class="single-comment-item reply-comment">
                            <div class="sc-author">
                                <img src="{{url('public/frontend/img')}}/blog/blog-details/avatar/avatar-2.jpg" alt="">
                            </div>
                            <div class="sc-text">
                                <span>27 Aug 2019</span>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et
                                    dolore magnam.</p>
                                <a href="#" class="comment-btn like-btn">Like</a>
                                <a href="#" class="comment-btn reply-btn">Reply</a>
                            </div>
                        </div>
                        <div class="single-comment-item second-comment ">
                            <div class="sc-author">
                                <img src="{{url('public/frontend/img')}}/blog/blog-details/avatar/avatar-3.jpg" alt="">
                            </div>
                            <div class="sc-text">
                                <span>27 Aug 2019</span>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et
                                    dolore magnam.</p>
                                <a href="#" class="comment-btn">Like</a>
                                <a href="#" class="comment-btn">Reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="leave-comment">
                        <h4>Leave A Comment</h4>
                        <form action="#" class="comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12 text-center">
                                    <input type="text" placeholder="Website">
                                    <textarea placeholder="Messages"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Recommend Blog Section Begin -->
@php
$recommendBlogs = App\Blog::where(['IsHot'=>1, 'IsPublished'=>1])->distinct('CAT_ID')->take(3)->get();
foreach($recommendBlogs as $blog) {
$category = App\Category::find($blog->CAT_ID);
if($category) $blog->Category = $category;
}
@endphp
@if(isset($recommendBlogs))

<section class="recommend-blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Recommended</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($recommendBlogs as $blog)
            @php
                $url = url('blogs').'/'.$blog->BLO_ID.'-'.App\Helpers\FriendlyUrl::convertToFriendlyUrl($blog->Title);
            @endphp
            <div class="col-md-4">
                <div class="blog-item set-bg" data-setbg="{{url('public/data/blogs').'/'.$blog->Avatar}}">
                    <div class="bi-text">
                        <span class="b-tag">{{$blog->Category->Name}}</span>
                        <h4><a href="{{$url}}">{{$blog->Title}}</a></h4>
                        <div class="b-time"><i class="icon_clock_alt"></i> {{$blog->UpdatedDate}}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Recommend Blog Section End -->

<!-- END section -->


@endsection
@section('js')
<script>
    $('#blogs').addClass('active');
</script>
@endsection