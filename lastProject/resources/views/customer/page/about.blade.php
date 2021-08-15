@extends('customer.master.master')
@section('banner')
    <div class="clearfix"></div>
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img src="{{ url('customer') }}/imgabout/banner.jfif" alt="banner" class="banner2" />
    </section>
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
                <h1 class="page-tit">About Us</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part about-page">
        <section class="who-we-are">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 img-part">
                        <figure><img src="{{ url('customer') }}/imgabout/img1.jfif" alt="organic" style="max-width: 100%" class="img-responsive"></figure>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 txt-part">
                        <div class="sec-tit">
                            <h2><span>Who</span> we are</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the release of Letraset sheets containing</p>
                        <h3>Remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                            sheets...</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="farming-industry-section">
            <div class="container">
                <div class="row">
                    <div class="pull-left col-md-8 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
                                <div class="free-section">
                                    <div class="free-inner">
                                        <h2 class="years">over <span>25</span> years</h2>
                                        <div class="slogan">in the farming<br />industry</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
                                <div class="box first">
                                    <div class="sr">01</div>
                                    <div class="txt-part">
                                        <div class="tit">Hand Planted</div>
                                        <p>Blandit justo et, sodales est. Phasellus dignissim libero tempus consequat
                                            gravida. Maecenas vel fringilla est.</p>
                                    </div>
                                </div>
                                <div class="box second">
                                    <div class="sr">02</div>
                                    <div class="txt-part">
                                        <div class="tit">Well Watered</div>
                                        <p>Blandit justo et, sodales est. Phasellus dignissim libero tempus consequat
                                            gravida. Maecenas vel fringilla est.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12 pull-right">
                        <div class="box third">
                            <div class="sr">03</div>
                            <div class="txt-part">
                                <div class="tit">Natural Sunlight</div>
                                <p>Blandit justo et, sodales est. Phasellus dignissim libero tempus consequat gravida.
                                    Maecenas vel fringilla est.</p>
                            </div>
                        </div>
                        <div class="box fourth">
                            <div class="sr">04</div>
                            <div class="txt-part">
                                <div class="tit">Perfect Product</div>
                                <p>Blandit justo et, sodales est. Phasellus dignissim libero tempus consequat gravida.
                                    Maecenas vel fringilla est.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="choose-us-section ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
                        <div class="tit">
                            <h2><span>Why</span> choose us</h2>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.</p>
                        <div class="flow">
                            <div class="expertese">
                                <label>Expertese</label>
                                <input id="Expertese" data-slider-id='Expertese' type="text" data-slider-min="0"
                                    data-slider-max="20" data-slider-step="1" data-slider-value="18" />
                            </div>
                            <div class="quality">
                                <label>quality</label>
                                <input id="Quality" data-slider-id='Quality' type="text" data-slider-min="0"
                                    data-slider-max="20" data-slider-step="1" data-slider-value="14" />
                            </div>
                            <div class="responsible">
                                <label>responsible</label>
                                <input id="Responsible" data-slider-id='Responsible' type="text" data-slider-min="0"
                                    data-slider-max="20" data-slider-step="1" data-slider-value="12" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /Content -->
    <!-- Our Farmer -->
    <section class="our-farmers-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="section-tit">
                        <div class="inner">
                            <h2>our Farmers</h2>
                        </div>
                    </div>
                    <div class="owl-carousel owl-theme our-farmer">
                        @foreach ($farmer as $item)
                        <div class="item">
                            <div class="wrapper">
                                <div class="pro-img">
                                    <img src="{{ url('uploads') }}/{{ $item->avatar }}" alt="Farmer" class="img-responsive center-block" />
                                </div>
                                <div class="contain-wrapper">
                                    <div class="tit">{{ $item->name }}</div>
                                    <div class="post">{{ $item->role }}</div>
                                    <ul class="social">
                                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon-camera"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Our Farmer -->
    <!-- Brand logo -->
    <section class="brand">
        <div class="container">
            <h3 class="sr-only">Brand logos</h3>
            <div class="owl-carousel owl-theme brand-slider">
                @foreach ($brand as $item)
                    <div class="item"> <img src="{{ url('uploads') }}/{{ $item->logo }}" alt="brand 01" class="img-responsive" /> </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- /Brand logo -->
    <div class="clearfix"></div>
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
@stop
