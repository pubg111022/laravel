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
                    <li>Profile</li>
                </ul>
                <h1 class="page-tit">Profile</h1>
            </div>
        </div>
    </section>
@stop
@section('main')
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img src="{{ url('uploads') }}/{{ $user->avatar }}" alt="">
                        </a>
                        <h1>{{ $user->name }}</h1>
                        <p>{{ $user->email }}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a style="cursor: pointer;"> <i class="fa fa-edit"></i> Edit
                                profile</a></li>
                    </ul>
                </div>
            </div>
            <div class="profile-info col-md-9">
                <div class="panel">
                    <div class="panel-body bio-graph-info">
                        <h1>Edit Profile</h1>
                        <div class="row">
                            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label style="float: left" for="">Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                    placeholder="Name">
                                @error('name')
                                    <p  style="float: left;color: red">{{ $message }}</p>
                                    <div class="clearfix"></div>
                                @enderror
                                <label style="float: left" for="">Email</label>
                                <input type="text" disabled name="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="Email">

                                <label style="float: left" for="">Password</label>
                                <input type="password" name="password" value="{{ session()->get('password') }}"
                                    class="form-control">
                                @error('password')
                                    <p  style="float: left;color: red">{{ $message }}</p>
                                    <div class="clearfix"></div>
                                @enderror
                                <label style="float: left" for="">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"
                                    placeholder="Phone">
                                @error('phone')
                                    <p  style="float: left;color: red">{{ $message }}</p>
                                    <div class="clearfix"></div>
                                @enderror
                                <label style="float: left" for="">Address</label>
                                <input type="text" name="address" value="{{ $user->address }}" class="form-control"
                                    placeholder="Address">
                                @error('address')
                                    <p  style="float: left;color: red">{{ $message }}</p>
                                    <div class="clearfix"></div>
                                @enderror
                                <label style="float: left" for="">Birthday</label>
                                <input type="date" name="birthday" value="{{ $user->birthday }}" class="form-control">
                                {{-- <label style="">Avatar</label> --}}
                                <label for="" style="float: left;">Avatar</label>
                                <div style="clear:both" class="clear"></div>
                                <label for="apply" class="lablez"><input type="file" name="file" class="inputz"
                                        id="apply">Get
                                    Image</label>
                                @if (Auth::check())
                                    <Button style="width: 100%;margin-top: 15px;height: 40px;" class="btn btn-success"
                                        {{ Auth::user()->id == $user->id ? '' : 'disabled' }} type="submit">Update
                                        Profile</Button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
