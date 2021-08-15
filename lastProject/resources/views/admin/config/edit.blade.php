@extends('admin.master.master')
@section('main')
    <form action="{{ route('config.update',$config->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label for="exampleInputEmail1">Type</label>
        <select id="type" onchange="type_config()" style="width: 20%" class="form-control" name="type">
            <option {{ $config->type=='text'?"selected":"" }} value="text">Text</option>
            <option {{ $config->type=='file'?"selected":"" }} value="file">File</option>
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">name</label>
            <input style="width: 20%" value="{{ $config->name }}" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        @if($config->type=='file')
            <img style="width: 100px;height: 100px;" src="{{ url('uploads') }}/{{ $config->content }}" alt="">
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <input id="in" style="width: 20%" name="{{ $config->type }}" value="{{ $config->content }}" type="{{ $config->type }}" class="form-control">
        </div>
        @error('content')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select style="width: 20%" class="form-control" name="status" aria-label="Default select example">
            <option {{ $config->status==0?"selected":"" }} value="0">Active</option>
            <option {{ $config->status==1?"selected":"" }} value="1">Deactivated</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        function type_config() {
           type_input = $("#type").val();

            $("#in").attr({type:type_input,name:type_input}) ;
        }
    </script>
@stop
