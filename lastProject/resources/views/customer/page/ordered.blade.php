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
                    <li>Order Tracking</li>
                </ul>
                <h1 class="page-tit">Order Tracking</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="container bootstrap snippets bootdey">
        <div class="row" style="margin-bottom: 30px">
            <div class="profile-info col-md-12">
                <table class="table">
                    <thead>
                        <tr style="background: blueviolet;color: white">
                            <th scope="col">Stt</th>
                            <th scope="col">Time</th>
                            <th scope="col">Shipping Method</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Shipping Status</th>
                            <th scope="col">Total</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <thead>
                        @foreach ($order as $key => $item)
                        <?php $method = $shipping_method->getName($item->shipping_method_id) ?>
                            <tr >
                                <th scope="col">{{ $key+1 }}</th>
                                <th scope="col">{{ $item->updated_at }}</th>
                                <th scope="col">{{ $method }}</th>
                                <th scope="col">{{ $item->order_status==0?"Unpaid":"Paid" }}</th>
                                @if($item->shipping_status == 0)
                                    <th scope="col">No Process</th>
                                @elseif($item->shipping_status == 1)
                                    <th scope="col">Processed</th>
                                @elseif($item->shipping_status == 2)
                                    <th scope="col">Delivering</th>
                                @elseif($item->shipping_status == 3)
                                    <th scope="col">Delivered</th>
                                @elseif($item->shipping_status == 4)
                                    <th scope="col">Cancelled</th>
                                @endif
                                <th scope="col">$ {{ $item->total }}</th>
                                <th scope="col">
                                    <a href="{{ route('order_tracking_detail',$item->id) }}">View</a>
                                </th>
                            </tr>
                        @endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
