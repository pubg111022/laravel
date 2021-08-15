@extends('admin.master.master')
@section('main')
    <form action="{{ route('shippingmethod.store') }}" method="POST">
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
            <input style="width: 20%" min="1"name="price" type="number" class="form-control">
        </div>
        @error('price')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="0">Active</option>
            <option value="1">Deactivated</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
@stop
