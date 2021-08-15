@extends('customer.master.master')
@section('banner')
    <section class="sub-banner">
        <h2 class="sr-only">Banner</h2>
        <img class="banner" src="{{ url('customer') }}/imgbanner/shopbanner.jfif" alt="Banner" />
    </section>
    <!-- /Banner -->
    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <div class="breadcrumb">
                <ul class="list-inline">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li>Forgot Password</li>
                </ul>
                <h1 class="page-tit">Forgot Password</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part account-page">
        <div class="container">
            <div class="myaccount-form">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form class="account-form-login" method="POST" action="{{ route('forgot_post') }}">
                            @csrf
                            <h2 class="text-left text-capitalize">Forgot Password</h2>
                            <input type="text" name="email" class="form-control" placeholder="Your Password" />
                            @if (session('alert'))
                                <section class='alert alert-danger'>{{ session('alert') }}</section>
                            @endif  
                            <input type="submit" value="Send Code" />
                        </form>
                    </div>
                </div>
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
@stop
