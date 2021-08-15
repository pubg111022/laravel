@extends('customer.master.master')
@section('banner')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner2" src="{{ url('customer') }}/imgbanner/shopbanner.jfif" alt="banner" />
    </section>
    <!-- /Banner -->
    <!-- Bredcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Leaf vegetables</a></li>
                    <li>Retis Lapen Casen</li>
                </ul>
                <h1 class="page-tit">Retis Lapen Casen</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part detail-page">
        <div class="container">
            <div class="row">
                <section class="single-post-section">

                    <!-- product -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="sp-wrap">
                            <a href="{{ url('uploads') }}/{{ $product->image }}"><img
                                    src="{{ url('uploads') }}/{{ $product->image }}" alt=""></a>
                            @foreach ($image as $item)
                                <a href="{{ url('uploads') }}/{{ $item->image }}"><img
                                        src="{{ url('uploads') }}/{{ $item->image }}" alt=""></a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /product -->
                    <!-- product discription -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="product-single-meta">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="ratting">
                                <ul>
                                    <li><a href="#"><img
                                                src="{{ url('customer') }}/images/{{ $value > 0 ? 'green-star.png' : 'dark-star.png' }}"
                                                alt="star" class="img-responsive"></a></li>
                                    <li><a href="#"><img
                                                src="{{ url('customer') }}/images/{{ $value > 1 ? 'green-star.png' : 'dark-star.png' }}"
                                                alt="star" class="img-responsive"></a></li>
                                    <li><a href="#"><img
                                                src="{{ url('customer') }}/images/{{ $value > 2 ? 'green-star.png' : 'dark-star.png' }}"
                                                alt="star" class="img-responsive"></a></li>
                                    <li><a href="#"><img
                                                src="{{ url('customer') }}/images/{{ $value > 3 ? 'green-star.png' : 'dark-star.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                    <li><a href="#"><img
                                                src="{{ url('customer') }}/images/{{ $value > 4 ? 'green-star.png' : 'dark-star.png' }}"
                                                alt="star" class="img-responsive"></a>
                                    </li>
                                </ul>
                                <span>( {{ $count_reviews }} reviews )</span>
                            </div>
                            @if ($product->sale_price > 0)
                                <div class="price">
                                    <div class="new-price">${{ $product->sale_price }}</div>
                                    <div class="old-price"><del>${{ $product->price }}</del></div>
                                </div>
                            @else
                                <div class="price">
                                    <div class="new-price">${{ $product->price }}</div>
                                </div>
                            @endif
                            <div class="availablity">
                                Available: <span>{{ $product->status == 0 ? 'In Stock' : 'Out Stock' }}</span>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}" id="product_id">
                            <p class="product-information">{{ $product->description }}</p>
                            <div class="cart-process" style="padding: 0px !important">
                                <div class="qty">
                                    <Select name="size" id="size_id" style="width: 135px;height: 40px;"
                                        class="form-control">
                                        @foreach ($size as $item)
                                            <option value="{{ $item->size_id }}">{{ $item->getName->name }}</option>
                                        @endforeach
                                    </Select>
                                </div>
                            </div>
                            <div class="cart-process">
                                <div class="qty">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" disabled="disabled"
                                            data-type="minus" data-field="quant"> - </button>
                                    </span>
                                    <input type="text" id="quantt" name="quant" class="form-control input-number" value="1"
                                        min="1" max="1000">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus"
                                            data-field="quant"> + </button>
                                    </span>
                                </div>
                                <div class="cart">
                                    @if ($product->status == 0)
                                        @if (Auth::check())
                                            <button onclick="buy()" class="cart-btn">Add to cart</button>
                                        @else
                                            <a class="cart-btn" href="{{ route('login', 'page=store') }}">Add to cart</a>
                                        @endif
                                    @else
                                        <button onclick="soldout()" class="cart-btn">Sold Out</button>
                                    @endif
                                </div>
                                <div class="extra">
                                    <ul class="list-inline">
                                        <li><a onclick="addProtowish({{ $product->id }})"><i
                                                    style="color: {{ $favo > 0 ? 'red' : 'grey' }}" id="heartt"
                                                    class="icon-heart"></i></a></li>
                                        {{-- <li><a href="#"><i class="icon-line-menu"></i></a></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="tag-box">
                                {{-- <div class="tag-row">
                                    <span class="tag-label sku">SKU</span><span class="dots">:</span>
                                    <div class="tag-label-value sku-value">537mkc8500</div>
                                </div> --}}
                                <div class="tag-row">
                                    <span class="tag-label category">Category</span><span class="dots">:</span>
                                    <div class="tag-label-value category-value">
                                        {{ $pro->getCateName($product->category_id)->name }}</div>
                                </div>
                                <div class="tag-row">
                                    <span class="tag-label">Tags</span><span class="dots">:</span>
                                    <div class="tag-label-value"><a class="tag-btn" href="#">Food</a>
                                        <a class="tag-btn" href="#">Organic Food</a>
                                        <a class="tag-btn" href="#">Garden</a>
                                    </div>
                                </div>
                                <div class="tag-row">
                                    <span class="tag-label">Share</span><span class="dots">:</span>
                                    <div class="tag-label-value">
                                        &nbsp;
                                        <ul class="social">
                                            <li><a href="#" target="_blank"><i class="icon-facebook"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-twitter"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-google-plus"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-pinterest"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="icon-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /product discription -->

                </section>
                <!-- Tabbing -->
                <section class="tab-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="responsive-tabs">
                                    <h2>Description</h2>
                                    <div class="responsive-tabs__panel--active">
                                        <p>{{ $product->description }}</p>
                                    </div>
                                    <h2>Reviews({{ $count_reviews }})</h2>
                                    <div>
                                        <div class="col-sm-12 col-xs-12">
                                            <h3>All review</h3>
                                            <br>
                                            @foreach ($reviews as $item)
                                                <?php $user_profile = $user->getUser($item->user_id); ?>
                                                <div style="display: flex;margin-bottom: 20px">
                                                    <div style="width: 100px;height: 100px;">
                                                        <img src="{{ url('uploads') }}/{{ $user_profile->avatar }}"
                                                            style="width: 100%;height: 100%;" alt="">
                                                    </div>
                                                    <div
                                                        style="width: 15px;height: 100px;border-right: 1px solid rgb(179, 159, 159)">
                                                    </div>
                                                    <div style="margin-left: 10px;">
                                                        <div style="margin-left: 10px;margin-bottom: 10px">
                                                            <h4>{{ $user_profile->name }}</h4>
                                                        </div>
                                                        <div class="rate">
                                                            <input {{ $item->rating == 5 ? 'checked' : '' }}
                                                                style="width: 5px" type="radio"
                                                                name="rating{{ $item->id }}" value="5" />
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input {{ $item->rating == 4 ? 'checked' : '' }}
                                                                style="width: 5px" type="radio"
                                                                name="rating{{ $item->id }}" value="4" />
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input {{ $item->rating == 3 ? 'checked' : '' }}
                                                                style="width: 5px" type="radio"
                                                                name="rating{{ $item->id }}" value="3" />
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input {{ $item->rating == 2 ? 'checked' : '' }}
                                                                style="width: 5px" type="radio"
                                                                name="rating{{ $item->id }}" value="2" />
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input {{ $item->rating == 1 ? 'checked' : '' }}
                                                                style="width: 5px" type="radio"
                                                                name="rating{{ $item->id }}" value="1" />
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>
                                                        <div style="clear: both;"></div>
                                                        <div style="margin-left: 10px">
                                                            <h4>{{ $item->reviews }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($check_exist == true)
                                            <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px">
                                                <h3>Write a review</h3>
                                            </div>
                                            <form action="{{ route('vote') }}" class="product-review-form row"
                                                method="POST">
                                                @csrf
                                                <div class="form-group col-sm-12 col-xs-12">
                                                    <div class="rate">
                                                        <input type="radio" {{ $old_star == 5 ? 'checked' : '' }}
                                                            id="star5" name="rating" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" {{ $old_star == 4 ? 'checked' : '' }}
                                                            id="star4" name="rating" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" {{ $old_star == 3 ? 'checked' : '' }}
                                                            id="star3" name="rating" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" {{ $old_star == 2 ? 'checked' : '' }}
                                                            id="star2" name="rating" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" {{ $old_star == 1 ? 'checked' : '' }}
                                                            id="star1" name="rating" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                    <label>Reviews</label>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}"
                                                        id="">
                                                    <textarea name="reviews" class="form-control" id="exampleTextarea"
                                                        rows="3"></textarea>
                                                </div>
                                                @if (Auth::check())
                                                    <div class="col-sm-12 col-xs-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                @else
                                                    <div class="col-sm-12 col-xs-12">
                                                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                                    </div>
                                                @endif
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Tabbing -->
                <!-- Related Products -->
                <section class="related-products">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="tit">
                                    <h2>Related Products</h2>
                                </div>
                                <div class="owl-carousel owl-theme related-product-slider">
                                    @foreach ($productRelated as $key => $item)
                                        @if (Auth::check())
                                            <?php $exits = $wish->checkexits($item->id, Auth::user()->id);
                                            ?>
                                        @else
                                            <?php $exits = 0; ?>
                                        @endif
                                        <div class="item">
                                            <div class="wrapper">
                                                <div class="pro-img">
                                                    <img class="img-responsive"
                                                        src="{{ url('uploads') }}/{{ $item->image }}" alt="Product" />
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
                                                    <div class="btn-part"> <a style="cursor: pointer"
                                                            onclick="addtoCart({{ $item->id }})" class="cart-btn">buy
                                                            now</a>
                                                        <i onclick="addtoCart({{ $item->id }})"
                                                            class="icon-basket-supermarket"></i>
                                                    </div>
                                                </div>
                                                <div class="wrapper-box-hover">
                                                    <div class="text">
                                                        <ul>
                                                            <li><a onclick="addWish({{ $item->id }})"
                                                                    style="cursor: pointer"><i
                                                                        id="heart2{{ $item->id }}"
                                                                        style="color: {{ $exits == 1 ? 'red' : 'white' }}"
                                                                        class="icon-heart color{{ $item->id }}"></i></a>
                                                            </li>
                                                            <li><a href="{{ route('productdetail', $item->id) }}"><i
                                                                        class="icon-view"></i></a>
                                                            </li>
                                                            @if ($item->status == 0)
                                                                @if (Auth::check())
                                                                    <li><a onclick="addtoCart({{ $item->id }})"
                                                                            style="cursor: pointer"><i
                                                                                class="icon-basket-supermarket"></i></a>
                                                                    </li>
                                                                @else
                                                                    <li><a href="{{ route('login', 'page=store') }}"
                                                                            style="cursor: pointer"><i
                                                                                class="icon-basket-supermarket"></i></a>
                                                                    </li>
                                                                @endif
                                                            @else
                                                                <li><a onclick="soldout()" style="cursor: pointer"><i
                                                                            class="icon-basket-supermarket"></i></a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Related Products -->
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
        function buy() {
            product_id = $("#product_id").val();
            size_id = $("#size_id").val();
            quantt = $("#quantt").val();
            $.ajax({
                type: "get",
                url: "{{ route('addProdetail') }}",
                data: {
                    product_id: product_id,
                    size_id: size_id,
                    quantt: quantt
                },
                success: function(data) {
                    console.log("Add success");
                    $("#subcart").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('countCart') }}",
                data: {

                },
                success: function(data) {
                    $("#quant").html(data);
                    $("#itemInCart").html(data + " items in your cart");
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }
    </script>
@stop
