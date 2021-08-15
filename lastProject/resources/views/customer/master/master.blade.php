<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Oganic - Organic Food Responsive Store Template for HTML5 and Bootstrap 3">
    <meta name="author" content="">
    <title>Oganic - Organic Food Responsive Store Template for HTML5 and Bootstrap 3</title>
    <link href="{{ url('customer') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('customer') }}/css/fontello.css" rel="stylesheet" />
    <link href="{{ url('customer') }}/css/responsive-slider.css" rel="stylesheet" />
    <link href="{{ url('customer') }}/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ url('customer') }}/css/owl.theme.default.min.css" rel="stylesheet">
    <link href="{{ url('customer') }}/css/bootstrap-slider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('customer') }}/css/smoothproducts.css">
    <link href="{{ url('customer') }}/css/responsive-tabs.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('customer') }}/css/jquery.fancybox.min.css">
    <link href="{{ url('customer') }}/css/style.css" rel="stylesheet" />
    <link href="{{ url('customer') }}/css/query.css" rel="stylesheet" />
    <link href="{{ url('customer') }}/css/responsive-slider.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('uploads') }}/logo.png" type="image/x-icon">
</head>

<body>
    <!-- Loader -->
    {{-- <div id="loading">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
  	</div> --}}
    <!-- /Loader -->
    <header>
        <div class="top-header">
            <div class="lpart">
                <div class="social">
                    <ul class="social-widget">
                        <li><a href="#" target="_blank"><i class="icon-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-google-plus"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-pinterest"></i></a></li>
                        <li><a href="#" target="_blank"><i class="icon-youtube"></i></a></li>
                    </ul>
                </div>
                <div class="tel-and-email">
                    <p class="tel">Phone : <a href="tel:+91123456789">{{ $phone }}</a></p>
                    <p class="mail">Email : <a href="mailto:inquiry@organicfoodstroe.com">{{ $email }}</a></p>
                </div>
            </div>
            <div class="rpart">
                <div class="country">
                    {{-- <div id="country" class="select"><img src="{{ url('customer') }}/images/franch-flag-icon.jpg"
                            alt="flag" />French</div> --}}
                    <div id="country-drop" class="dropdown">
                        <ul>
                            <li><img src="{{ url('customer') }}/images/franch-flag-icon.jpg" alt="flag" />French</li>
                            <li><img src="{{ url('customer') }}/images/india-flag-icon.jpg" alt="flag" />India</li>
                        </ul>
                    </div>
                </div>
                <div class="currency">
                    <div class="btn dropdown-toggle" data-toggle="dropdown" data-rel="currency"><i
                            class="icon-dollar-symbol"></i>usd <i class="icon-angle-down"></i></div>
                    {{-- <ul class="dropdown-menu">
                        <li><a href="#">usd</a></li>
                        <li><a href="#">ind</a></li>
                        <li><a href="#">usd</a></li>
                    </ul> --}}
                </div>
                @if (Auth::check())
                    <div class="account">
                        <div class="btn dropdown-toggle" data-toggle="dropdown"><i
                                class="icon-avatar"></i>{{ Auth::user()->name }}<i class="icon-angle-down"></i></div>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile') }}">My Account</a></li>
                            <li><a href="{{ route('order_tracking') }}">Order Tracking</a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ route('cart') }}">Cart</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <div class="account">
                        <div class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-avatar"></i>My Account <i
                                class="icon-angle-down"></i></div>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('login') }}">Login | Register</a></li>
                            {{-- <li><a href="{{ route('login') }}">Register</a></li> --}}
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="bottom-header">
            <div class="container">
                <div class="vishlist">
                    <div class="vishlist-inner">
                        @if (Auth::check())
                            <a href="{{ route('wishlist') }}"><i class="icon-heart"></i></a>
                        @else
                            <a href="{{ route('login', 'page=wishlist') }}"><i class="icon-heart"></i></a>
                        @endif
                        <div class="vishlist-counter" id="countWish">{{ $countWish }}</div>
                    </div>
                </div>
                <nav class="navbar">
                    <div class="nav-header">
                        <button type="button" class="navbar-toggle"> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        <div class="logo"><a href="{{ route('index') }}"><img
                                    src="{{ url('customer') }}/images/logo.png" alt="logo" /></a></div>
                    </div>
                    <div class="collapse" id="organic-food-navigation">
                        <div class="remove"><i class="icon-cancel-music"></i></div>
                        <div class="menu-logo"><a href="index.html"><img src="{{ url('customer') }}/images/logo.png"
                                    alt="logo" /></a></div>
                        <ul class="nav navbar-nav">
                            <li class="{{ session()->get('page') == 'home' ? 'active' : '' }}"><a
                                    href="{{ route('index') }}">Home</a></li>
                            <li class="{{ session()->get('page') == 'about' ? 'active' : '' }}"><a
                                    href="{{ route('about') }}">About</a></li>
                            <li class="{{ session()->get('page') == 'store' ? 'active' : '' }}"><a
                                    href="{{ route('store') }}">Shop</a></li>
                            <li class="{{ session()->get('page') == 'blog' ? 'active' : '' }}"><a
                                    href="{{ route('blog') }}">Blog</a></li>
                            <li class="{{ session()->get('page') == 'contact' ? 'active' : '' }}"><a
                                    href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="search-and-cart">
                    <div class="search">
                        <div class="search-inner"><a href="#"><i class="icon-magnifying-glass"></i></a></div>
                    </div>
                    <div class="cart">
                        <div class="cart-inner">
                            <a style="cursor: pointer"><i class="icon-shopping-bag"></i></a>
                            <div class="cart-counter" id="quant">{{ $quant }}</div>
                        </div>
                        <div class="cart-popup" id="subcart">
                            <p class="item-in-cart" id="itemInCart">{{ $quant }} items in your cart</p>
                            <input type="number" style="display: none" value="{{ $quant }}" id="quantity">
                            <div class="item-list">
                                <?php
                                $total = 0;
                                $total_price = 0;
                                $total_sale = 0;
                                ?>
                                @foreach ($list as $item)
                                    <div class="box" id="cartsub{{ $item->proId }}{{ $item->sizeid }}">
                                        <div class="img-part"> <img style="width: 90px;height: 80px;"
                                                src="{{ url('uploads') }}/{{ $item->image }}" alt="product"
                                                class="img-responsive"> </div>
                                        <div class="text-part">
                                            <a class="product-name" style="width: 100%">{{ $item->name }}</a>
                                            <div class="quantity-and-price">{{ $item->quantity }} x
                                                ${{ $item->sale_price > 0 ? $item->sale_price : $item->price }}</div>
                                        </div>
                                        <a style="cursor: pointer"
                                            onclick="removeSubCart({{ $item->proId }},{{ $item->sizeid }})"
                                            class="clear-btn"><i class="icon-cancel-music"></i></a>
                                    </div>
                                    <?php if ($item->sale_price > 0) {
                                        $total_sale += $item->sale_price * $item->quantity;
                                    } else {
                                        $total_price += $item->price * $item->quantity;
                                    } ?>
                                @endforeach
                                <?php $total = $total_sale + $total_price; ?>
                            </div>
                            <div class="cart-total"> <span id="total">Total: ${{ $total }}</span> </div>
                            <div class="cart-btm">
                                <div class="btn-group">
                                    @if (Auth::check())
                                        <a href="{{ route('cart') }}" class="btn cart-view">view cart</a>
                                    @else
                                        <a href="{{ route('login', 'page=cart') }}" class="btn cart-view">view
                                            cart</a>
                                    @endif
                                    {{-- <a href="{{ route('cart') }}" class="btn checkout">checkout</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searchbox">
                    <div class="inner">
                        <div class="container-1">
                            <div class="pos-rel">
                                <input class="input-serch" id="searchValue" type="text" name="search"
                                    placeholder="Search our store" />
                                <div class="cross" onclick="search()"><i class="icon-magnifying-glass"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    @yield('banner')
    <div class="clearfix"></div>
    @yield('main')
    <footer>
        <div class="container">
            <div class="row">
                <div class="top-footer">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="logo"> <img src="{{ url('customer') }}/images/footer-logo.png" alt="logo"
                                class="img-responsive" /> </div>
                        <div class="logo-btm">
                            <div style="width: 100%" class="adress"><i
                                    class="icon-placeholder"></i><span>{{ $address }}</span></div>
                            <div class="phone"><i class="icon-icon"></i><a
                                    href="tel:+8888888888">+{{ $phone }}</a>
                            </div>
                            <div class="mail"><i class="icon-envelope"></i><a
                                    href="mailto:inquiry@organicfoodstroe.com">{{ $email }}</a></div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Information</div>
                            <ul class="widget">
                                <li><a href="{{ route('contact') }}">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                                <li><a href="#">Advanced Search</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="#">Suppliers</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Style Advisor</div>
                            <ul class="widget">
                                <li><a href="{{ route('login') }}">Your Account</a></li>
                                <li><a href="#">Information</a></li>
                                <li><a href="{{ route('contact') }}">Addresses</a></li>
                                <li><a href="#">Discount</a></li>
                                <li><a href="#">Orders History</a></li>
                                <li><a href="#">Additional Information</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="widget-title">Quick Links</div>
                            <ul class="widget">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="#">Payment</a></li>
                                <li><a href="#">Shipment</a></li>
                                <li><a href="#">Where is my order?</a></li>
                                <li><a href="#">Return policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <div class="widget-title">Instagram</div>
                        <div class="insta-img-box"> <img src="{{ url('customer') }}/images/instagram-img-1.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('customer') }}/images/instagram-img-2.jpg" alt="photo"
                                class="img-responsive" /> <img src="{{ url('customer') }}/images/instagram-img-3.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('customer') }}/images/instagram-img-4.jpg" alt="photo"
                                class="img-responsive" /> <img src="{{ url('customer') }}/images/instagram-img-5.jpg"
                                alt="photo" class="img-responsive" /> <img
                                src="{{ url('customer') }}/images/instagram-img-6.jpg" alt="photo"
                                class="img-responsive" /> </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <div class="lpart">
                        <p class="copyright">© Oganic Foodstore <span>2018 All rights reserved</span></p>
                        <p class="design">Website designed & Developed by <a target="_blank"
                                href="https://www.ncodetechnologies.com/">NCode Technologies, Inc.</a></p>
                    </div>
                    <div class="center-part">
                        <ul class="social">
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-google-plus"></i></a></li>
                            <li><a href="#"><i class="icon-pinterest"></i></a></li>
                            <li><a href="#"><i class="icon-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="rpart">
                        <ul class="payment">
                            <li><a href="#"><img src="{{ url('customer') }}/images/card-1.png" alt="payment card"
                                        class="img-responsive" /></a></li>
                            <li><a href="#"><img src="{{ url('customer') }}/images/card-2.png" alt="payment card"
                                        class="img-responsive" /></a></li>
                            <li><a href="#"><img src="{{ url('customer') }}/images/card-3.png" alt="payment card"
                                        class="img-responsive" /></a></li>
                            <li><a href="#"><img src="{{ url('customer') }}/images/card-4.png" alt="payment card"
                                        class="img-responsive" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" class="scrollup"><i class="icon-angle-up"></i></a>
    <script src="{{ url('customer') }}/js/jquery-1.11.3.min.js"></script>
    <script src="{{ url('customer') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('customer') }}/js/responsive-slider.js"></script>
    <script src="{{ url('customer') }}/js/owl.carousel.min.js"></script>
    <script src="{{ url('customer') }}/js/jquery.event.move.js"></script>
    <script src="{{ url('customer') }}/js/bootstrap-slider.min.js"></script>
    <script src="{{ url('customer') }}/js/responsiveTabs.min.js"></script>
    <script src="{{ url('customer') }}/js/smoothproducts.min.js"></script>
    <script src="{{ url('customer') }}/js/jquery.matchHeight-min.js"></script>
    <script src="{{ url('customer') }}/js/jquery.fancybox.min.js"></script>
    <script src="{{ url('customer') }}/js/isotope.pkgd.js"></script>
    <script src="{{ url('customer') }}/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //////---------------Price Range ---------------//////
        var slider = new Slider('#price-range', {});
    </script>
    <script>
        function soldout(){
            toastr.warning('Item sold out');
        }
        function addProtowish(id) {
            color2 = document.getElementById("heartt").style.color;
            $.ajax({
                type: "GET",
                url: "{{ route('addWishlist', '+id+') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (color2 == "red") {
                        document.getElementById("heartt").style.color = "grey";
                        toastr.success('Delete item Wishlist Success');
                    }
                    if (color2 == "grey") {
                        document.getElementById("heartt").style.color = "red";
                        toastr.success('Add To Wishlist Success');
                    }
                },
                error: function(res) {
                    toastr.error('Error to change Wishlist Success');
                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('getCountWishList') }}",
                data: {

                },
                success: function(data) {
                    $("#countWish").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function addWish(id) {
            color = document.getElementById("heart2" + id).style.color;

            $.ajax({
                type: "GET",
                url: "{{ route('addWishlist', '+id+') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (color == "red") {
                        color2 = $(".color" + id).css("color", "white");
                        toastr.success('Delete item Wishlist Success');
                    }
                    if (color == "white") {
                        color2 = $(".color" + id).css("color", "red");
                        toastr.success('Add To Wishlist Success');
                    }
                },
                error: function(res) {
                    toastr.error('Error to change Wishlist Success');

                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('getCountWishList') }}",
                data: {

                },
                success: function(data) {
                    $("#countWish").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function addtowish(id) {
            color3 = document.getElementById("heart" + id).style.color;
            $.ajax({
                type: "GET",
                url: "{{ route('addWishlist', '+id+') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (color3 == "red") {
                        $("#heart" + id).css("color", "white");
                        toastr.success('Delete item Wishlist Success');
                    }
                    if (color3 == "white") {
                        $("#heart" + id).css("color", "red");
                        toastr.success('Add To Wishlist Success');
                    }
                },
                error: function(res) {
                    toastr.error('Error to change Wishlist Success');

                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('getCountWishList') }}",
                data: {

                },
                success: function(data) {
                    $("#countWish").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function search() {
            keyword = $("#searchValue").val();
            if (keyword == '') {

            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('search', '+keyword+') }}",
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        // window.history.pushState({}, "store", "store/category=".id);
                        url = window.location.origin + "/store/search=" + keyword;
                        window.history.pushState("Details", "Title", url);
                        window.location.href = url;
                        // $("#products").html(data);

                    },
                    error: function(res) {
                        console.log(res);
                    }
                })
            }
        }

        function addtoCart(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('addCart', '+id+') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log("Add success");
                    $("#subcart").html(data);
                    toastr.success('Add To Cart Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');

                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('countCart') }}",
                data: {},
                success: function(data) {
                    $("#quant").html(data);
                    $("#itemInCart").html(data + " items in your cart");
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function removeCart(proId, sizeId) {
            quantity = $("#quantity").val();
            $("#quantity").val(quantity - 1);
            $('#quant').html(quantity - 1);
            $('#itemInCart').html(quantity - 1 + " items in your cart");
            $.ajax({
                type: "GET",
                url: "{{ route('removeCart') }}",
                data: {
                    proId: proId,
                    sizeId: sizeId
                },
                success: function(data) {
                    toastr.success('Delete item Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');

                }
            })
            document.getElementById("cart" + proId + sizeId).innerHTML = '';
        }

        function removeSubCart(proId, sizeId) {
            $.ajax({
                type: "GET",
                url: "{{ route('removeCart') }}",
                data: {
                    proId: proId,
                    sizeId: sizeId
                },
                success: function(data) {
                    toastr.success('Delete item Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');

                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('totalCart') }}",
                data: {

                },
                success: function(data) {
                    $("#total").html(data);
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
            document.getElementById("cartsub" + proId + sizeId).innerHTML = '';
        }

        function removeAllCart() {
            document.getElementById("ca").innerHTML = '';
            $.ajax({
                type: "GET",
                url: "{{ route('removeAllCart') }}",
                data: {

                },
                success: function(data) {
                    toastr.success('Delete Cart Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');

                }
            })
        }

        function city() {
            matp = $("#tp").val();
            $.ajax({
                type: "GET",
                url: "{{ route('getDistricts') }}",
                data: {
                    matp: matp
                },
                success: function(data) {
                    $("#qh").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function district() {
            maqh = $("#qh").val();
            $.ajax({
                type: "GET",
                url: "{{ route('getCommunes') }}",
                data: {
                    maqh: maqh
                },
                success: function(data) {
                    $("#xa").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function subAddress() {
            shipping_method = $("#shipping_method").val();
            matp = $("#tp").val();
            maqh = $("#qh").val();
            xaid = $("#xa").val();
            shipp = $("#shipp").val();
            total = $("#total_cart").val();
            $.ajax({
                type: "GET",
                url: "{{ route('ship') }}",
                data: {
                    maqh: maqh,
                    matp: matp,
                    xaid: xaid,
                    shipp: shipp,
                    shipping_method: shipping_method
                },
                success: function(data) {
                    if (data < 0) {
                        $("#shippp").html(data + "$")
                    } else {
                        $("#shippp").html("+" + data + "$")
                    }
                    toastr.success('Apply Address Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');
                }
            })
            $.ajax({
                type: "GET",
                url: "{{ route('totalamount') }}",
                data: {

                },
                success: function(data) {
                    $("#lasttotal").html(data)
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }
        $("#cp").click(function() {
            coupon = $("#coupon").val();
            total = $("#total_cart").val();
            $.ajax({
                type: "GET",
                url: "{{ route('getCoupon') }}",
                data: {
                    coupon: coupon
                },
                success: function(data) {
                    console.log(data);
                    if (data == 'false') {
                        $("#cou").html("-0$")
                        toastr.error('Coupon cannot be greater than total price');
                    } else {
                        $("#cou").html("-" + data)
                        if (data.search("%") != -1) {
                            value = data.replace('%', ' ');
                        } else if (data.search("$") != -1) {
                            value = data.replace('$', ' ');
                        }
                        if (data == '0$') {
                            toastr.error('Coupon does not exists or expired ');
                        } else {
                            toastr.success('Apply Coupon Success');
                        }
                    }
                },
                error: function(res) {
                    toastr.error('Coupon does not exists');
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('totalamount') }}",
                data: {

                },
                success: function(data) {
                    $("#lasttotal").html(data)
                },
                error: function(res) {
                    console.log(res);
                }
            });
        });
        $("#order_method").change(function() {
            id_method = $("#order_method").val();
            if (id_method == 1) {
                $("#payment").css('display', 'block');
                $("#order").css('display', 'none');
            } else {
                $("#payment").css('display', 'none');
                $("#order").css('display', 'block');
            }
        });
    </script>
</body>

</html>
