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
                    <li>Checkout</li>
                </ul>
                <h1 class="page-tit">Checkout</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part checkout-page">
        <div class="container">
            <div class="checkout-step-two text-left">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2 class="checkout-head">01 / Billing & Shipping details</h2>
                        <div class="row">
                            <div class="checkout-two-form text-left">
                                <form action="{{ route('post_order') }}" method="POST">
                                    @csrf
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="name" value="{{ $user->name }}" name="name"
                                            class="form-control" placeholder="Name" />
                                        @error('name')
                                            <p style="float: left;color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="email" value="{{ $user->email }}" name="email"
                                            class="form-control" placeholder="Email" />
                                        @error('email')
                                            <p style="float: left;color: red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" id="phone"
                                            value="{{ $user->phone == null ? '' : $user->phone }}" name="phone"
                                            class="form-control" placeholder="Phone" />
                                        @error('phone')
                                            <p style="float: left;color: red">{{ $message }}</p>
                                        @enderror
                                        <input type="hidden" id="total" name="total" value="{{ $last_total }}">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="selectdiv">
                                            <select name="order_method" id="order_method" class="form-control">
                                                <option selected value="0">Cash On Delivery (COD)</option>
                                                <option value="1">Online Banking</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="selectdiv">
                                            <select name="shipping_method" id="shipping_method" disabled
                                                class="form-control">
                                                @foreach ($shipping_method as $item)
                                                    <option {{ $shipping_method_id == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="selectdiv">
                                            <select name="matp" disabled class="form-control">
                                                <option selected="selected">City</option>
                                                @foreach ($city as $item)
                                                    <option {{ $matp == $item->matp ? 'selected' : '' }}
                                                        value="{{ $item->matp }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="selectdiv">
                                            <select name="maqh" disabled class="form-control">
                                                <option selected="selected">Districts</option>
                                                @foreach ($qh as $item)
                                                    <option {{ $maqh == $item->maqh ? 'selected' : '' }}
                                                        value="{{ $item->maqh }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="selectdiv">
                                            <select name="xaid" disabled class="form-control">
                                                <option selected="selected">Communes</option>
                                                @foreach ($xa as $item)
                                                    <option {{ $xaid == $item->xaid ? 'selected' : '' }}
                                                        value="{{ $item->xaid }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea rows="5" id="note" placeholder="Order notes" class="form-control"
                                            name="note"> </textarea>
                                        <label>
                                    </div>
                                    <div id="order" class="col-md-12 col-sm-12 col-xs-12">
                                        <button onclick="po()"
                                            style="width: 266.11px;height: 52px;background: #549843;border: #549843;color: white;float: left;"
                                            type="submit">PLACE ORDER</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="total_last" value="{{ $last_total }}">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h2 class="checkout-head">Your Order</h2>
                        <div class="checkout-order-table text-left">
                            <table class="table-responsive">
                                <thead>
                                    <tr class="th-head">
                                        <th scope="col" width="68%">PRODCUT</th>
                                        <th scope="col" width="42%">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr>
                                            <td>{{ $item->name }} x {{ $item->quantity }}</td>
                                            <td>${{ $item->sale_price > 0 ? $item->total2 : $item->total1 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-shopping">
                                        <td>SUB TOTAL</td>
                                        <td>${{ $total }}</td>
                                    </tr>
                                    <tr class="cart-shopping">
                                        <td>SHIPPING</td>
                                        <td>+${{ $delivery }}</td>
                                    </tr>
                                    <tr class="cart-shopping">
                                        <td>Coupon</td>
                                        <td>-{{ $price_coupon }}</td>
                                    </tr>
                                    <tr class="cart-shopping">
                                        <td>Coupon Shipping</td>
                                        <td>-${{ $price_ship }}</td>
                                    </tr>
                                    <tr class="cart-total">
                                        <td>TOTAL</td>
                                        <td>${{ $last_total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="checkout-step-three text-left" id="payment" style="display: none">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 class="checkout-head">02 / Payment information</h2>
                        <div class="center row">
                            <div class="card-list"><span>Credit card (PayPal)</span> <img
                                    src="{{ url('customer') }}/images/card-list.png" alt="credit card"
                                    class="img-responsive" /></div>
                            <p class="checkout-desc">Pay with your credit card via PayPal Website payments Pro.</p>
                            <br>
                            <div id="online_banking" style="width: 50%" class="checkout-three-form text-left">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                sandbox: 'Ad-Oka6n25RunPf2732_F-lyWRxNi_0333TpR9EJBO0FGc94X-Jaz0Nrc2nc6srbG1nm-kNjtgLA9pTh',
                production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'responsive',
                color: 'silver',
                shape: 'rect',
                label: 'paypal',
                tagline: 'false',
                fundingicons: true,
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
                total = $("#total_last").val();
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: total,
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
                total = $("#total_last").val();
                phone = $("#phone").val();
                email = $("#email").val();
                name = $("#name").val();
                note = $("#note").val();
                order_method = $("#order_method").val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('banking') }}",
                    data: {
                        total: total,
                        phone: phone,
                        email: email,
                        name: name,
                        note: note,
                        order_method: order_method
                    },
                    success: function(data) {
                        toastr.success('Thank you for your purchase!');
                        return actions.payment.execute().then(function() {

                        });
                    },
                    error: function(res) {
                        console.log(res);
                        toastr.error('Please enter enough information');
                    }
                })

            }
        }, '#online_banking');

        function po() {
            phone = $("#phone").val();
            email = $("#email").val();
            name = $("#name").val();
            if (phone == '' || email =='' || name =='') {
                
            } else {
                toastr.success('Thank you for your purchase!');
            }
        }
    </script>
@stop
