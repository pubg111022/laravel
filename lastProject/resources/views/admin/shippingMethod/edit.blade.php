@extends('admin.master.master')
@section('main')
    <form action="{{ route('shippingmethod.update',$method->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" value="{{ $method->name }}" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Price</label>
            <input style="width: 20%" min="1" value="{{ $method->price }}" name="price" type="number" class="form-control">
        </div>
        @error('price')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select class="form-select" name="status" aria-label="Default select example">
            <option {{ $method->status == 0 ?"selected":"" }} value="0">Active</option>
            <option {{ $method->status == 1 ?"selected":"" }} value="1">Deactivated</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
@stop
