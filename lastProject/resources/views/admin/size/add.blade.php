@extends('admin.master.master')
@section('main')
    <form action="{{ route('size.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
@stop
