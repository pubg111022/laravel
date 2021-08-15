@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Add Blog</h1>
            <form action="{{ route('blog.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" style="width: 70%" class="form-control" id="">
                </div>
                @error('title')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div style="width: 70%" class="mr-3">
                        <label for="">Banner</label>
                        <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                            Image</label>
                    </div>
                </div>
                @error('banner')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="">Content</label>
                    <textarea name="content" style="width: 70%" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                @error('content')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop()
