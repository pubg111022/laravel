@extends('admin.master.master')
@section('main')
    <form action="{{ route('coupon.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Code</label>
            <input style="width: 20%" name="code" type="text" class="form-control">
        </div>
        @error('code')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Condition</label>
            <br>
            <select name="condition" onchange="change()" id="condition">
                <option value="0">Money Reduction</option>
                <option value="1">% off money </option>
            </select>
        </div>
        @error('condition')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Value</label>
            <input style="width: 20%" min="0" id="value" max="100" name="value" type="number" class="form-control">
        </div>
        @error('value')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input style="width: 20%" name="quantity" type="number" class="form-control">
        </div>
        @error('quantity')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
