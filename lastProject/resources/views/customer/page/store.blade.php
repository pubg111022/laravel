@extends('customer.master.master')
@section('banner')
    <div class="clearfix"></div>
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner2" src="{{ url('customer') }}/imgbanner/shopbanner.jfif" alt="Banner" />
    </section>
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Vegetables</li>
                </ul>
                <h1 class="page-tit">Vegetables</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part listing-page">
        <div class="container">
            <div class="row">
                <!-- Content left -->
                <aside class="col-md-4 col-sm-12 col-xs-12">
                    <div id="sidebar">
                        <div class="widget categories-widget">
                            <div class="widget-tit">
                                <h2>Categories</h2>
                                <div class="button" data-toggle="collapse" data-target="#categories">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="categories">
                                <ul class="level-1 open">
                                    <li>
                                        <a onclick="cate(0,'All Product')" style="cursor: pointer">All Product</a><span
                                            class="icon-add"></span>
                                    </li>
                                    @foreach ($category as $item)
                                        <li>
                                            <a onclick="cate({{ $item->id }},'{{ $item->name }}')"
                                                style="cursor: pointer">{{ $item->name }}</a><span
                                                class="icon-add"></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget price-range-widget">
                            <div class="widget-tit">
                                <h2>By price</h2>
                                <div class="button" data-toggle="collapse" data-target="#price">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="price">
                                <input id="price-range" type="text" name="filter" class="span2" value="" data-slider-min="1"
                                    data-slider-max="100" data-slider-step="5" data-slider-value="[1,100]" />
                                <span>€ 1</span> <span>€ 100</span>
                                <a id="fillter" onclick="filter()" class="filter-btn" style="cursor: pointer">filter</a>
                            </div>
                        </div>
                        <div class="widget top-seller-widget" data-toggle="collapse" data-target="#top-seller">
                            <div class="widget-tit">
                                <h2>top seller</h2>
                                <div class="button">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="top-seller">
                                @foreach ($top3sale as $item)
                                    <?php $star = $pro->getStar($item->id); ?>
                                    <div class="seller-box">
                                        <div class="seller-img">
                                            <img style="width: 95px;height: 70px;"
                                                src="{{ url('uploads') }}/{{ $item->image }}" alt="top seller"
                                                class="img-responsive" />
                                        </div>
                                        <div class="seller-text">
                                            <a class="seller-name" href="#">{{ $item->name }}</a>
                                            <div class="ratting">
                                                <ul>
                                                    <li><a href="#"><img
                                                                src="{{ url('customer') }}/images/{{ $star > 0 ? 'green-star.png' : 'dark-star.png' }}"
                                                                alt="star" class="img-responsive"></a></li>
                                                    <li><a href="#"><img
                                                                src="{{ url('customer') }}/images/{{ $star > 1 ? 'green-star.png' : 'dark-star.png' }}"
                                                                alt="star" class="img-responsive"></a></li>
                                                    <li><a href="#"><img
                                                                src="{{ url('customer') }}/images/{{ $star > 2 ? 'green-star.png' : 'dark-star.png' }}"
                                                                alt="star" class="img-responsive"></a></li>
                                                    <li><a href="#"><img
                                                                src="{{ url('customer') }}/images/{{ $star > 3 ? 'green-star.png' : 'dark-star.png' }}"
                                                                alt="star" class="img-responsive"></a></li>
                                                    <li><a href="#"><img
                                                                src="{{ url('customer') }}/images/{{ $star > 4 ? 'green-star.png' : 'dark-star.png' }}"
                                                                alt="star" class="img-responsive"></a></li>
                                                </ul>
                                            </div>
                                            <div class="price">
                                                ${{ $item->sale_price > 0 ? $item->sale_price : $item->price }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="widget tag-widgwet">
                            <div class="widget-tit">
                                <h2>Popular tags</h2>
                                <div class="button" data-toggle="collapse" data-target="#tag">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                            <div class="widget-contian" id="tag">
                                <div class="tag-div">
                                    <a class="tag-btn" href="#">Cucumber</a>
                                    <a class="tag-btn" href="#">Vegetables</a>
                                    <a class="tag-btn" href="#">Fruits</a>
                                    <a class="tag-btn" href="#">Organic Food</a>
                                    <a class="tag-btn" href="#">Food</a>
                                    <a class="tag-btn" href="#">True Natural</a>
                                    <a class="tag-btn" href="#">Garden</a>
                                    <a class="tag-btn" href="#">Green</a>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="hot-collection">
                            <a href="#"><img src="{{ url('customer') }}/images/hot-collection-img.jpg"
                                    alt="hot collection" class="img-responsive" /></a>
                        </div> --}}
                    </div>
                </aside>
                <!-- /Content left -->
                <!-- Content Right-->
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="filter">
                                <div class="r-part">
                                    <div class="shorting-box-1">
                                        <form action="{{ route('store') }}" method="get">
                                            <label class="shorting-label">Sort By:</label>
                                            <select name="sort" onchange="sortby()" id="exampleSelect1">
                                                <option value="new">New</option>
                                                <option value="asc">A To Z</option>
                                                <option value="desc">Z To A</option>
                                                <option value="down">High To Low</option>
                                                <option value="up">Low To High</option>
                                            </select>
                                        </form>
                                    </div>
                                    {{-- <div class="shorting-box-2">
                                        <label class="shorting-label">Show:</label>
                                        <select id="exampleSelect2">
                                            <option>12</option>
                                            <option>24</option>
                                            <option>30</option>
                                        </select>
                                    </div> --}}
                                    <div class="grid-short">
                                        <div class="grid-layout"><a class="active" href="#" id="grid"><i
                                                    class="icon-grid-layout"></i></a></div>
                                        <div class="list-grid"><a href="#" id="list-btn"><i class="icon-list-grid"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="l-part">
                                    @if ($keyword != '')
                                        <div>Showing <span>Result</span> of <span style="font-weight: bold"
                                                id="keyname">{{ $keyword }}</span></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="products" class="product-list list-group">
                            @foreach ($productByCate as $item)
                                @if (Auth::check())
                                    <?php $exits = $wish->checkexits($item->id, Auth::user()->id); ?>
                                @else
                                    <?php $exits = 0; ?>
                                @endif
                                <div class="col-sm-4 col-xs-12 item">
                                    <div class="wrapper">
                                        <div class="pro-img">
                                            <img src="{{ url('uploads') }}/{{ $item->image }}" alt="product"
                                                class="img-responsive" />
                                        </div>
                                        <div class="contain-wrapper">
                                            <div class="tit">{{ $item->name }}</div>
                                            @if ($item->sale_price > 0)
                                                <div class="price">
                                                    <div class="new-price">${{ $item->sale_price }}</div>
                                                    <div class="old-price"><del>${{ $item->price }}</del></div>
                                                </div>
                                            @else
                                                <div class="price">
                                                    <div class="new-price">${{ $item->price }}</div>
                                                </div>
                                            @endif
                                            @if (Auth::check())
                                                @if ($item->status == 0)
                                                    <div class="btn-part"> <a style="cursor: pointer"
                                                            onclick="addtoCart({{ $item->id }})" class="cart-btn">buy
                                                            now</a>
                                                        <i class="icon-basket-supermarket"></i>
                                                    </div>
                                                @else
                                                    <div class="btn-part"> <a style="cursor: pointer" onclick="soldout()"
                                                            class="cart-btn">buy
                                                            now</a>
                                                        <i class="icon-basket-supermarket"></i>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="btn-part"> <a style="cursor: pointer"
                                                        href="{{ route('login', 'page=store') }}" class="cart-btn">buy
                                                        now</a>
                                                    <i class="icon-basket-supermarket"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="wrapper-box-hover">
                                            <div class="text">
                                                <ul>
                                                    @if (Auth::check())
                                                        <li><a onclick="addtowish({{ $item->id }})"><i
                                                                    id="heart{{ $item->id }}"
                                                                    style="color: {{ $exits == 1 ? 'red' : 'white' }}"
                                                                    class="icon-heart"></i></a></li>
                                                    @else
                                                        <li><a href="{{ route('login', 'page=store') }}"><i
                                                                    id="heart{{ $item->id }}"
                                                                    style="color: {{ $exits == 1 ? 'red' : 'white' }}"
                                                                    class="icon-heart"></i></a></li>
                                                    @endif
                                                    <li><a href="{{ route('productdetail', $item->id) }}"><i
                                                                class="icon-view"></i></a></li>
                                                    @if (Auth::check())
                                                        @if ($item->status == 0)
                                                            <li><a onclick="addtoCart({{ $item->id }})"
                                                                    style="cursor: pointer"><i
                                                                        class="icon-basket-supermarket"></i></a></li>
                                                        @else
                                                            <li><a onclick="soldout()"
                                                                    style="cursor: pointer"><i
                                                                        class="icon-basket-supermarket"></i></a></li>
                                                        @endif
                                                    @else
                                                        <li><a href="{{ route('login', 'page=store') }}"
                                                                style="cursor: pointer"><i
                                                                    class="icon-basket-supermarket"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        @if ($item->status == 0)
                                            @if ($item->sale_price > 0)
                                                <div class="sale">sale</div>
                                            @endif
                                            @if ($item->id == $new->id)
                                                <div class="new">new</div>
                                            @endif
                                        @else
                                            <div class="sale">Sold</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="col-sm-12 col-xs-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item indicator left"><a class="page-link" href="#"><i
                                                    class="icon-right-arrow"></i></a></li>
                                        <li class="page-item"><a class="page-link  active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item indicator right"><a class="page-link" href="#"><i
                                                    class="icon-right-arrow"></i></a></li>
                                    </ul>
                                </nav>
                            </div> --}}
                            <div class="col-sm-12 col-xs-12">
                                <nav aria-label="Page navigation example">
                                    @if ($productByCate->lastPage() > 1)
                                        <ul class="pagination">
                                            @if ($productByCate->onFirstPage())
                                                <li class="hidden-md"></li>
                                            @else
                                                <li class="page-item indicator left"><a class="page-link"
                                                        href="{{ $productByCate->previousPageUrl() }}" rel="prev"><i
                                                            class="icon-right-arrow"></i></a>
                                                </li>
                                            @endif
                                            @for ($i = 1; $i <= $productByCate->lastPage(); $i++)
                                                <li class="page-item ">
                                                    <a class="page-link  {{ $i == $productByCate->currentPage() ? 'active' : '' }}"
                                                        href="?page={{ $i }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            @if ($productByCate->hasMorePages())
                                                <li class="page-item indicator right"><a class="page-link"
                                                        href="{{ $productByCate->nextPageUrl() }}" rel="next"><i
                                                            class="icon-right-arrow"></i></a>
                                                </li>
                                            @else
                                                <li class="d-none"></li>
                                            @endif
                                        </ul>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Content Right-->
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
        function cate(id, value) {
            $.ajax({
                type: "GET",
                url: "{{ route('getByCate') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    // window.history.pushState({}, "store", "store/category=".id);
                    url = window.location.origin + "/store/category=" + id;
                    window.history.pushState("Details", "Title", url);
                    $("#products").html(data);
                    $('#keyname').html(value);
                    toastr.success('Filter By Cate Success');
                },
                error: function(res) {
                    console.log(res);
                    toastr.error('Something was wrong');
                }
            })
        }

        function show(id) {
            document.getElementById('hide' + id).style.display = "block";
        }
    </script>
    <script>
        function filter() {
            value = $('#price-range').val();
            $.ajax({
                type: "GET",
                url: "{{ route('getbyPrice') }}",
                data: {
                    value: value
                },
                success: function(data) {
                    // window.history.pushState({}, "store", "store/category=".id);
                    url = window.location.origin + "/store/price=" + value;
                    window.history.pushState("Details", "Title", url);
                    $("#products").html(data);
                    $('#keyname').html(value);
                    toastr.success('Filter Success');
                },
                error: function(res) {
                    console.log(res);
                    toastr.error('Something was wrong');

                }
            })
        }

        function sortby() {
            value = $('#exampleSelect1').val();
            $.ajax({
                type: "GET",
                url: "{{ route('getbySort') }}",
                data: {
                    value: value
                },
                success: function(data) {
                    url = window.location.origin + "/store/sort=" + value;
                    window.history.pushState("Details", "Title", url);
                    $("#products").html(data);
                    $('#keyname').html(value);
                    toastr.success('Sort Success');

                },
                error: function(res) {
                    console.log(res);
                    toastr.error('Something was wrong');

                }
            })
        }
    </script>
@stop
