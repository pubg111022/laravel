@extends('customer.master.master')
@section('banner')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img src="{{ url('customer') }}/imgbanner/shopbanner.jfif" alt="banner" class="banner2" />
    </section>
    <!-- /Banner -->
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>blog</li>
                </ul>
                <h1 class="page-tit">blog</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part blog-page">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12  pull-right">
                    <aside id="blog_sidebar">
                        <div class="blog_widget search-widget">
                            <div class="widget-content">
                                <form role="search" method="get" id="searchform" class="searchform">
                                    <div>
                                        <input type="text" placeholder="Search here..." value="">
                                        <input type="submit" id="searchsubmit" value="">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="blog_sidebar_widget popular-product-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">Recent Post</h2>
                            </div>
                            @foreach ($related as $item)
                                <div class="box">
                                    <div class="img-part">
                                        <img src="{{ url('uploads') }}/{{ $item->banner }}" alt="blog post"
                                            class="img-fluid" />
                                    </div>
                                    <div class="txt-part">
                                        <a class="blog-tit"
                                            style="overflow: hidden;-webkit-line-clamp: 2;display: -webkit-box;-webkit-box-orient: vertical;"
                                            href="{{ route('blogdetail', $item->id) }}">{{ $item->title }}</a><br>
                                        <a href="{{ route('blogdetail', $item->id) }}" class="blog-date"><i
                                                class="icon-clock"></i>{{ $item->updated_at }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        <div class="blog_sidebar_widget popular-product-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">cetegory</h2>
                            </div>
                            <div class="post-cetegory">
                                <ul>
                                    @foreach ($category as $item)
                                        <?php $countPro = $pro->countProduct($item->id); ?>
                                        <li>
                                            <div class="post-cetegory-header"><a class="" href="#">{{ $item->name }}
                                                    ({{ 8 }})</a></div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="blog_sidebar_widget popular-product-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">Tags</h2>
                            </div>
                            <div class="post-tag">
                                <ul>
                                    <li><a href="#">Animal</a></li>
                                    <li><a href="#">Food</a></li>
                                    <li><a href="#">organic</a></li>
                                    <li><a href="#">organic foods</a></li>
                                    <li><a href="#">fashion</a></li>
                                    <li><a href="#">summer</a></li>
                                    <li><a href="#">trend</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        {{-- <div class="blog_sidebar_widget popular-product-widget hidden-sm hidden-xs">
                            <div class="widget-title">
                                <h2 class="blog-header text-left">Archives</h2>
                            </div>
                            <div class="post-cetegory">
                                <ul>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#">November 2017</a></div>
                                    </li>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#">September 2017</a></div>
                                    </li>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#">August 2017</a></div>
                                    </li>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#">July 2017</a></div>
                                    </li>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#">June 2017</a></div>
                                    </li>
                                    <li>
                                        <div class="post-cetegory-header"><a class="" href="#"> May 2017</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </aside>
                </div>
                <!-- Content left -->
                <div class="col-md-9 col-sm-12 col-xs-12 blog-detail">
                    <div class="blog-img">
                        <img style="width: 100%" src="{{ url('uploads') }}/{{ $blog->banner }}"
                            alt="Green Tea for Change Your Eating Food" class="" />
                    </div>
                    <div class="blog-txt">
                        <ul>
                            <li><a href="#"><i class="icon-clock"></i>{{ $blog->title }}</a></li>
                            <li><a href="#"><i class="icon-interface"></i>{{ $count + $countRep }} Comments</a></li>
                        </ul>
                        <h2 class="text-left">{{ $blog->title }}</h2>
                        <p>{{ $blog->content }}
                        </p>
                        <section class="middle-section">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 pull-right">
                                    <div class="youtube-video">
                                        <iframe width="437" height="360" src="https://www.youtube.com/embed/IDG3_J0TTXU"
                                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 pull-left">
                                    <div class="tit">
                                        <h3>What We Can Talk About</h3>
                                    </div>
                                    <ul class="talk-about-list">
                                        @foreach ($related as $item)
                                            <li>{{ $item->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                        {{-- <section class="bottom-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h4>The standard chunk of Lorem Ipsum use</h4>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                                        suffered alteration in some form, by injected humour, or randomised words which
                                        don't look even slightly believable. If you are going to use a passage of Lorem
                                        Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of
                                        text. All the Lorem Ipsum generators on the Internet tend to repeat predefined
                                        chunks as necessary,</p>
                                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                        interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum"</p>
                                    <div class="share-section">
                                        <div class="tag-part">
                                            <ul>
                                                <li><a href="#">Animal</a></li>
                                                <li><a href="#">Food</a></li>
                                                <li><a href="#">organic</a></li>
                                            </ul>
                                        </div>
                                        <div class="social-part">
                                            <label>Share Link:</label>
                                            <ul class="social">
                                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                <li><a href="#"><i class="icon-google-plus"></i></a></li>
                                                <li><a href="#"><i class="icon-pinterest"></i></a></li>
                                                <li><a href="#"><i class="icon-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> --}}
                        <section class="comment-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tit">
                                        <h3>{{ $count + $countRep }} Comments</h3>
                                    </div>
                                    @foreach ($comment as $item)
                                        <div class="comment-box">
                                            <div class="icon-part">
                                                @if ($item->getName->avatar != null)
                                                    <img style="width: 100px;height: 100px;"
                                                        src="{{ url('uploads') }}/{{ $item->getName->avatar }}"
                                                        alt="user" class="img-responsive" />
                                                @else
                                                    <img style="width: 100px;height: 100px;"
                                                        src="{{ url('customer') }}/images/user-icon.png" alt="user"
                                                        class="img-responsive" />
                                                @endif
                                            </div>
                                            <div class="comment-part">
                                                <div class="top-part">
                                                    <div class="l-part">
                                                        <div class="date">{{ $item->updated_at }}</div>
                                                        <div class="user-name">{{ $item->getName->name }}</div>
                                                    </div>
                                                    <div class="r-part">
                                                        @if (Auth::check())
                                                            <a class="btn replay-btn"
                                                                onclick="showrep({{ $item->id }})">reply</a>
                                                        @else
                                                            <a class="btn replay-btn"
                                                                href="{{ route('login','page=blogdetail='.$blog->id) }}">reply</a>
                                                        @endif
                                                    </div>
                                                    <p>{{ $item->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($item->RepComment()->get() != null)
                                            @foreach ($item->RepComment()->get() as $keys => $items)
                                                <div class="comment-box pleft ">
                                                    <div class="icon-part">
                                                        {{-- <img style="width: 100px;height: 100px;"
                                                            src="{{ url('uploads') }}/{{ $items->getRepName->avatar }}"
                                                            alt="user" class="img-responsive" /> --}}
                                                        @if ($items->getRepName->avatar != null)
                                                            <img style="width: 100px;height: 100px;"
                                                                src="{{ url('uploads') }}/{{ $items->getRepName->avatar }}"
                                                                alt="user" class="img-responsive" />
                                                        @else
                                                            <img style="width: 100px;height: 100px;"
                                                                src="{{ url('customer') }}/images/user-icon.png"
                                                                alt="user" class="img-responsive" />
                                                        @endif
                                                    </div>
                                                    <div class="comment-part">
                                                        <div class="top-part">
                                                            <div class="l-part">
                                                                <div class="date">{{ $items->updated_at }}</div>
                                                                <div class="user-name">{{ $items->getRepName->name }}
                                                                </div>
                                                            </div>
                                                            <div class="r-part">
                                                                @if (Auth::check())
                                                                    <a class="btn replay-btn"
                                                                        onclick="showrep({{ $item->id }})">reply</a>
                                                                @else
                                                                    <a class="btn replay-btn"
                                                                        href="{{ route('login','page=blogdetail='.$blog->id) }}">reply</a>
                                                                @endif
                                                            </div>
                                                            <p>{{ $items->reply }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if (Auth::check())
                                            <div class="comment-box pleft" id="show{{ $item->id }}"
                                                style="display: none">
                                                <div class="icon-part">
                                                    @if($item->getName->avatar != null)
                                                    <img style="width: 100px;height: 100px;"
                                                        src="{{ url('uploads') }}/{{ Auth::user()->avatar }}"
                                                        alt="user" class="img-responsive" />
                                                    @else
                                                    <img style="width: 100px;height: 100px;"
                                                        src="{{ url('customer') }}/images/user-icon.png" alt="user"
                                                        class="img-responsive" />
                                                    @endif
                                                </div>
                                                <div class="comment-part">
                                                    <div class="top-part">
                                                        <form style="border: none" action="{{ route('rep') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="comment_id"
                                                                value="{{ $item->id }}" id="">
                                                            <input type="hidden" name="blog_id" value="{{ $blog->id }}"
                                                                id="">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::user()->id }}" id="">
                                                            <textarea name="reply" class="form-control"
                                                                placeholder="Your Comment"></textarea>
                                                            <button type="submit" style="float: right"
                                                                class="btn btn-success">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </section>
                        <section class="form-section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tit">
                                        <h3>Leave a Comment</h3>
                                        <p class="slogan">Your email address will not be published.</p>
                                    </div>
                                    <form action="{{ route('commentblog') }}" method="POST">
                                        @csrf
                                        {{-- <div class="form-group col-sm-4 col-xs-12">
                                            <input type="text" class="form-control" placeholder="Name" />
                                        </div>
                                        <div class="form-group col-sm-4 col-xs-12">
                                            <input type="text" class="form-control" placeholder="Email" />
                                        </div>
                                        <div class="form-group col-sm-4 col-xs-12">
                                            <input type="text" class="form-control" placeholder="Website" />
                                        </div> --}}
                                        <div class="form-group col-sm-12 col-xs-12">
                                            <textarea name="comment" class="form-control"
                                                placeholder="Your Comment"></textarea>
                                            @if (Auth::check())
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                                <button class="submit">Submit Comment</button>
                                            @else
                                                <a class="btn btn-success" href="{{ route('login','page=blogdetail='.$blog->id) }}">Login to
                                                    comment</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Content left -->

            </div>
        </div>
    </div>
    <!-- /Content -->
    <!-- Services provide -->
    <section class="helpline">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="bgreen">
                        <div class="inline">
                            <div class="box">
                                <div class="icon"> <i class="icon-delivery-truck"></i> </div>
                                <div class="text-part">
                                    <h3>Free Shipping</h3>
                                    <p>Worldwide</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-headphones"></i> </div>
                                <div class="text-part">
                                    <h3>24X7</h3>
                                    <p>Customer Support</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-shuffle"></i> </div>
                                <div class="text-part">
                                    <h3>Returns</h3>
                                    <p>and Exchange</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon"> <i class="icon-phone-call"></i> </div>
                                <div class="text-part">
                                    <h3>Hotline</h3>
                                    <p><a href="tel:+8888888888">+(888) 888-8888</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function showrep(id) {
            document.getElementById("show" + id).style.display = "block";
        }
    </script>
@stop
