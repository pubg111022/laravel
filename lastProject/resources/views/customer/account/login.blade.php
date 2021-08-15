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
                    <li>My Account</li>
                </ul>
                <h1 class="page-tit">My Account</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="content-part account-page">
        <div class="container">
            <div class="myaccount-form text-left">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <form class="account-form-login" method="POST" action="{{ route('login_post') }}">
                            @csrf
                            <h2 class="text-left text-capitalize">Login</h2>
                            <input type="text" name="email" class="form-control" placeholder="Your name" />
                            @if (session()->get('check_post') == 'login')
                                @error('email')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            <input type="password" name="password" class="form-control" placeholder="password" />
                            @if (session()->get('check_post') == 'login')
                                @error('password')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            @if (session()->get('check_post') == 'login')
                                @if (session('alert'))
                                    <section class='alert alert-danger'>{{ session('alert') }}</section>
                                @endif  
                            @endif
                            <a href="{{ route('forgot_password') }}" style="text-decoration: underline">Forgot Password?</a>
                            <input type="hidden" name="page" value="{{ $page }}" class="form-control"
                                placeholder="password" />

                            <input type="submit" value="LOGIN" />
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @if (session()->get('check_post') == 'register')
                            @if (session('alert'))
                                <section class='alert alert-success'>{{ session('alert') }}</section>
                            @endif  
                        @endif
                        <form action="{{ route('register_post') }}" class="account-form-reg" method="POST">
                            @csrf
                            <h2 class="text-left text-capitalize">Register</h2>
                            <input type="text" name="name" class="form-control" placeholder="Your name" />
                            @if (session()->get('check_post') == 'register')
                                @error('name')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            <span class="asterisk_input"> </span>
                            <input type="text" name="email" class="form-control required" placeholder="Your email" />
                            @if (session()->get('check_post') == 'register')
                                @error('email')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            <span class="asterisk_input"> </span>
                            <input type="password" name="password" class="form-control required" placeholder="Password" />
                            @if (session()->get('check_post') == 'register')
                                @error('password')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            <span class="asterisk_input"> </span>
                            <input type="password" name="cf_password" class="form-control required"
                                placeholder="Repeat Password" />
                            @if (session()->get('check_post') == 'register')
                                @error('cf_password')
                                    <p style="float: left;color: red">{{ $message }}</p>
                                @enderror
                            @endif
                            <span class="asterisk_input"> </span>
                            <input type="submit" value="SUBMIT" />
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
