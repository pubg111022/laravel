@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update Banner</h1>
            <form action="{{ route('blog.update', $old_blog->id) }}" method="post" enctype="multipart/form-data">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{ $old_blog->title }}" style="width: 70%" class="form-control"
                        id="">
                </div>
                @error('title')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div style="width: 70%" class="mr-3">
                        <label for="">Banner</label>
                        <br>
                        <img src="{{ url('uploads') }}/{{ $old_blog->banner }}" style="width: 20%" alt="">
                        <div style="height: 20px;"></div>
                        <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                            Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" style="width: 70%" class="form-control" id="" cols="30"
                            rows="10">{{ $old_blog->content }}</textarea>
                    </div>
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
