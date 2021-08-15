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
                    <li>Order Detail</li>
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
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <thead>
                      @foreach ($order_detail as $key=> $item)
                      <tr >
                        <th scope="col">{{ $key+1 }}</th>
                        <th scope="col">{{ $item->name }}</th>
                        <th scope="col"><img src="{{ url('uploads') }}/{{ $item->image }}" style="width: 120px;height: 120px;" alt=""></th>
                        <th scope="col">$ {{ $item->price }}</th>
                        <th scope="col">{{ $item->quantity }}</th>
                    </tr>
                      @endforeach
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
