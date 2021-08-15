@extends('admin.master.master')
@section('main')
    <form action="{{ route('config.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="exampleInputEmail1">Type</label>
        <select id="type" onchange="type_config()" style="width: 20%" class="form-control" name="type">
            <option value="text">Text</option>
            <option value="file">File</option>
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">name</label>
            <input style="width: 20%" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Content</label>
            <input id="in" style="width: 20%" name="content" type="text" class="form-control">
        </div>
        @error('content')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select style="width: 20%" class="form-control" name="status" aria-label="Default select example">
            <option selected value="0">Active</option>
            <option  value="1">Deactivated</option>
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
