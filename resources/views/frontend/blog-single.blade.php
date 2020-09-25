@extends('frontend.layout.app')
@section('content')
@php
$url = url('/public/frontend/images/big_image_1.jpg');
@endphp

<!-- END section -->
@php
$banner = App\Banner::where(['IsPublished'=>1])->first();
$blogs = App\Blog::where(['IsPublished'=>1])->take(3)->get();
@endphp
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    @if($banner)
    <div class="carousel-inner">
        <div class="carousel-item active">
            @php
            $avatar = url('public/data/banners').'/'.$banner->Avatar;
            $blog->UpdatedDate = \Carbon\Carbon::parse($blog->UpdatedDate)->format('M d Y');
            @endphp
            <section class="site-hero site-hero-innerpage overlay" data-stellar-background-ratio="0.5" style="background-image: url({{$avatar}});">
                <div class="container">
                    <div class="row align-items-center site-hero-inner justify-content-center">
                        <div class="col-md-12 text-center">

                            <div class="mb-5 element-animate">
                                <h1>News &amp; Events</h1>
                                <p>{{$blog->Title}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @endif
</div>
<section class="site-section py-lg">
    <div class="container">

        <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
                <h1 class="mb-4">{{$blog->Description}}</h1>
                <div class="post-meta">
                    <span class="category">{{$blog->CategoryName}}</span>
                    <span class="mr-2">{{$blog->UpdatedDate}}</span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <div class="col-md-12 mb-4 element-animate">
                    <img src="{{url('public/data/blogs').'/'.$blog->Avatar}}" alt="Image placeholder" class="img-fluid">
                </div>
                <div class="post-content-body">
                    {!!$blog->Details!!}
                </div>


                <div class="pt-5">
                    <p>Categories: <a href="#">{{$blog->CategoryName}}</a>,
                        Tags:
                        @foreach($blog->Tags as $tag)
                        <a href="#">{{$tag->Name}}</a></p>
                    @endforeach
                </div>


                <div class="pt-5">
                    <h3 class="mb-5">6 Comments</h3>
                    <ul class="comment-list">
                        <li class="comment">
                            <div class="vcard">
                                <img src="images/person_1.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>Jean Doe</h3>
                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                <p><a href="#" class="reply">Reply</a></p>
                            </div>
                        </li>

                        <li class="comment">
                            <div class="vcard">
                                <img src="images/person_1.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>Jean Doe</h3>
                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                <p><a href="#" class="reply">Reply</a></p>
                            </div>

                            <ul class="children">
                                <li class="comment">
                                    <div class="vcard">
                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>Jean Doe</h3>
                                        <div class="meta">January 9, 2018 at 2:21pm</div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                        <p><a href="#" class="reply">Reply</a></p>
                                    </div>


                                    <ul class="children">
                                        <li class="comment">
                                            <div class="vcard">
                                                <img src="images/person_1.jpg" alt="Image placeholder">
                                            </div>
                                            <div class="comment-body">
                                                <h3>Jean Doe</h3>
                                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                <p><a href="#" class="reply">Reply</a></p>
                                            </div>

                                            <ul class="children">
                                                <li class="comment">
                                                    <div class="vcard">
                                                        <img src="images/person_1.jpg" alt="Image placeholder">
                                                    </div>
                                                    <div class="comment-body">
                                                        <h3>Jean Doe</h3>
                                                        <div class="meta">January 9, 2018 at 2:21pm</div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                                        <p><a href="#" class="reply">Reply</a></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="comment">
                            <div class="vcard">
                                <img src="images/person_1.jpg" alt="Image placeholder">
                            </div>
                            <div class="comment-body">
                                <h3>Jean Doe</h3>
                                <div class="meta">January 9, 2018 at 2:21pm</div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                                <p><a href="#" class="reply">Reply</a></p>
                            </div>
                        </li>
                    </ul>
                    <!-- END comment-list -->

                    <div class="comment-form-wrap pt-5">
                        <h3 class="mb-5">Leave a comment</h3>
                        <form action="#" class="p-5 bg-light">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">
                <div class="sidebar-box search-form-wrap">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon fa fa-search"></span>
                            <input type="text" class="form-control" id="s" placeholder="Search...">
                        </div>
                    </form>
                </div>
                <!-- END sidebar-box -->

                <div class="sidebar-box">
                    <h3 class="heading">Popular Posts</h3>
                    <div class="post-entry-sidebar">
                        <ul>
                            @foreach($blogs as $blog1)
                            @if($blog1->BLO_ID != $blog->BLO_ID)
                            @php
                            $blog1->UpdatedDate = \Carbon\Carbon::parse($blog1->UpdatedDate)->format('M d Y');

                            @endphp
                            <li>
                                <a href="{{url('blogs/').'/'.$blog1->BLO_ID}}">
                                    <img src="{{url('public/data/blogs').'/'.$blog1->Avatar}}" alt="Image placeholder" class="mr-4">
                                    <div class="text">
                                        <h4>{{$blog1->Title}}</h4>
                                        <div class="post-meta">
                                            <span class="mr-2">{{$blog1->UpdatedDate}} </span> &bullet;
                                            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- END sidebar-box -->

                <div class="sidebar-box">
                    <h3 class="heading">Categories</h3>
                    @php
                        $categories = \App\Category::all();
                        foreach($categories as $category) {
                            $category->NumberOfBlogs = \App\Blog::where("CAT_ID", $category->CAT_ID)->count();
                        }
                    @endphp
                    <ul class="categories">
                        @foreach($categories as $category)
                        <li><a href="#">{{$category->Name}} <span>({{$category->NumberOfBlogs}})</span></a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- END sidebar-box -->

                <div class="sidebar-box">
                    <h3 class="heading">Tags</h3>
                    <ul class="tags">
                        @foreach($blog->Tags as $tag)
                        <li><a href="#">{{$tag->Name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- END sidebar -->

        </div>
    </div>
</section>
</body>

</html>
@endsection
@section('js')
<script>
    $('#home').addClass('active');
</script>
@endsection