@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update Banner</h1>
            <form action="{{ route('banner.update', $old_banner->id) }}" method="post" enctype="multipart/form-data">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ $old_banner->title }}" style="width: 70%" class="form-control"
                        id="">
                </div>
                @error('title')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div style="width: 70%" class="mr-3">
                        <label for="">Banner</label>
                        <br>
                        <img src="{{ url('uploads') }}/{{ $old_banner->banner }}" style="width: 20%" alt="">
                        <div style="height: 20px;"></div>
                        <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                            Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop()
