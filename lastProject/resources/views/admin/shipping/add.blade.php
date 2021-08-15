@extends('admin.master.master')
@section('main')
    <form action="{{ route('shipping.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input style="width: 20%" name="price" min="0" type="number" class="form-control">
        </div>
        @error('price')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
