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
                    <li>Shoping Cart</li>
                </ul>
                <h1 class="page-tit">Shoping Cart</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part cart-page">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="product">PRODUCT</th>
                            <th class="name">Name & Description</th>
                            <th class="price">Size</th>
                            <th class="price">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="total">Total</th>
                            <th class="cancle">&nbsp;</th>
                        </tr>
                    </thead>
                    <form action="{{ route('updateCart') }}" method="POST">
                        @csrf
                        <tbody id="ca">
                            @foreach ($cart as $key => $item)
                                <?php $size = $c->getSize($item->proId); ?>
                                <tr id="cart{{ $item->proId }}{{ $item->sizeid }}">
                                    <input type="hidden" name="count" value="{{ $key + 1 }}">
                                    <input type="hidden" name="product_id[]" value="{{ $item->proId }}" id="">
                                    {{-- <input type="hidden" name="size_id[]" value="{{ $item->sizeid }}" id=""> --}}

                                    <td class="cart-image-wrapper">
                                        <a href="#"><img class="cart-image" style="width: 100px;height: 100px;"
                                                src="{{ url('uploads') }}/{{ $item->image }}" alt=""></a>
                                    </td>
                                    <td class="product-tit"><a href="#">{{ $item->name }}</a></td>
                                    {{-- <td class="size"><span class="size">{{ $item->size }}</span>
                                    </td> --}}
                                    <td class="size"><span class="size">
                                            <select style="width: 100px" name="size_id[]" id="">
                                                @foreach ($size as $items)
                                                    <option {{ $item->sizeid == $items->size_id ? 'selected' : '' }}
                                                        value="{{ $items->size_id }}">{{ $items->getName->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </td>
                                    <td class="price"><span
                                            class="money">${{ $item->sale_price > 0 ? $item->sale_price : $item->price }}</span>
                                    </td>
                                    <td>
                                        <div class="qty">
                                            <input type="number" name="quantity[]"
                                                style="border: none;width: 100px;background: none"
                                                value="{{ $item->quantity }}">
                                            {{-- <select>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                        </select> --}}
                                        </div>
                                    </td>
                                    <td class="total">
                                        ${{ $item->sale_price > 0 ? $item->sale_price * $item->quantity : $item->price * $item->quantity }}
                                    </td>
                                    <td class="cancle"><a style="cursor: pointer;"
                                            onclick="removeCart({{ $item->proId }},{{ $item->sizeid }})"><i
                                                class="icon-cancel-music"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="l-part">
                                        <a class="continue-shopping-btn" href="{{ route('store') }}">Continue with
                                            Shopping<i class="icon-right-arrow-1"></i></a>
                                    </div>
                                    <div class="r-part">
                                        <a class="cancle-cart-btn" style="cursor: pointer" onclick="removeAllCart()"><i
                                                class="icon-cancel-music"></i>cancle cart</a>
                                        <button class="update-cart-btn"><i class="icon-refresh"></i>update cart</button>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </form>
                </table>
            </div>
            <div class="caupon">
                <label>Coupon Code</label>
                <input class="caupon_text" id="coupon" type="text" name="coupon" />
                <button class="caupon-btn" id="cp">Apply Now</button>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-6 col-sm-12 pull-right"
                    style="display: {{ $count_Cart == 0 ? 'none' : 'block' }}">
                    <div class="total-box">
                        <div class="tit">Shopping Cart Total</div>
                        <div class="total-box-inner">
                            <div class="sub-total"><span>Total </span><span class="price">{{ $total }}$</span></div>
                            <input type="hidden" name="total" value="{{ $total }}" id="total_cart">
                            <div class="sub-total"><span>Coupon </span><span class="price" id="cou">-0$</span></div>
                            <div class="sub-total"><span>Ship </span><span class="price" id="shippp">+0$</span></div>
                            <div class="grand-total"><span>Grand Total </span><span class="price"
                                    id="lasttotal">${{ $total }}</span></div>
                            <a class="checkout-btn" href="{{ route('checkout') }}"><i class="icon-check-mark"></i>Proceed
                                to checkout</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-6 col-sm-12 pull-left">
                    <div class="tax-box">
                        <div class="tit">Estimate Shipping and Tax</div>
                        <div class="tax-box-inner">
                            @if (session('alert'))
                                <section class='alert alert-danger'>{{ session('alert') }}</section>
                            @endif  
                            <p>Enter your destination to get a shipping estimate.</p>
                            <label>City</label>
                            <select onchange="city()" id="tp">
                                <option>---------SELECT CITY ADDRESS---------</option>
                                @foreach ($city as $item)
                                    <option value="{{ $item->matp }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label>Districts</label>
                            <select onchange="district()" id="qh">
                                <option>---------SELECT DISCTRICTS ADDRESS---------</option>
                            </select><label>Communes</label>
                            <select id="xa">
                                <option>---------SELECT DISCTRICTS ADDRESS---------</option>
                            </select><label>Shipping Method</label>
                            <select id="shipping_method">
                                @foreach ($shipping_method as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label>Coupon Shipping Code</label>
                            <input class="postal-text" type="text" id="shipp" />
                            <button onclick="subAddress()" class="quote"><i class="icon-file"></i>Get a Quote</button>
                        </div>
                    </div>
                </div>
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
                                    <p><a href="tel:+8888888888">+{{ $phone }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
