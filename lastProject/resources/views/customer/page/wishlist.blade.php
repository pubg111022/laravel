@extends('customer.master.master')
@section('banner')
    <div class="clearfix"></div>
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner2" src="{{ url('customer') }}/imgabout/banner.jfif" alt="banner" />
    </section>
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Whishlist</li>
                </ul>
                <h1 class="page-tit">Whishlist</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part  whishlist-page">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="product">PRODUCT</th>
                            <th class="name">Name & Description</th>
                            <th class="price">Price</th>
                            <th class="quantity">product status</th>
                            <th class="total">add to cart</th>
                            <th class="cancle">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="showwish">
                        @foreach ($wish as $item)
                            <tr id="item{{ $item->product_id }}">
                                <td class="cart-image-wrapper">
                                    <a href="#"><img class="cart-image" style="width: 100px;height: 100px;"
                                            src="{{ url('uploads') }}/{{ $item->getProductName->image }}" alt=""></a>
                                </td>
                                <td class="product-tit"><a href="#">{{ $item->getProductName->name }}</a></td>
                                <td class="price"><span class="money">$
                                        {{ $item->getProductName->sale_price > 0 ? $item->getProductName->sale_price : $item->getProductName->price }}</span>
                                </td>
                                <td>
                                    {{ $item->getProductName->status == 1 ? 'Out Stock' : 'In Stock' }}
                                </td>
                                @if ($item->getProductName->status == 0)
                                    <td class="total"><a onclick="addtoCart({{ $item->product_id }})"
                                            style="cursor: pointer">Add to cart</a></td>
                                @else
                                    <td class="total"><a onclick="soldout()" style="cursor: pointer">Add to cart</a></td>
                                @endif
                                <td class="cancle"><a onclick="removewish({{ $item->product_id }})"
                                        style="cursor: pointer"><i class="icon-cancel-music"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
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
                                    <p>Customerr Support</p>
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
        function removewish(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('removewish', '+id+') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    document.getElementById("item" + id).style.display = "none";
                    toastr.success('Change Wishlist Success');
                },
                error: function(res) {
                    toastr.error('Something was wrong');
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
    </script>
@stop
