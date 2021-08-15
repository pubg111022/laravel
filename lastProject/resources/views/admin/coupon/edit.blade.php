@extends('admin.master.master')
@section('main')

    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update coupon</h1>
            <form action="{{ route('coupon.update', $old_coupon->id) }}" method="post">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Code</label>
                    <input type="text" name="code" style="width: 70%" value="{{ $old_coupon->code }}"
                        value="{{ old('code') }}" class="form-control" id="">
                    @error('code')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="exampleInputEmail1">Condition</label>
                        <br>
                        <select name="condition" id="condition">
                            <option {{ $old_coupon->condition==0?"selected":"" }} value="0">Money Reduction</option>
                            <option {{ $old_coupon->condition==1?"selected":"" }} value="1">% off money </option>
                        </select>
                    </div>
                    <label for="">Value</label>
                    <input type="number" name="value" style="width: 70%" value="{{ $old_coupon->value }}"
                        value="{{ old('value') }}" class="form-control" id="">
                    @error('value')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" style="width: 70%" value="{{ $old_coupon->quantity }}"
                        value="{{ old('quantity') }}" class="form-control" id="">
                    @error('quantity')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                    <label for="">Status</label>
                    <br>
                    <select name="status">
                        <option {{ $old_coupon->status == 0 ? 'selected' : '' }} value="0">Active</option>
                        <option {{ $old_coupon->status == 1 ? 'selected' : '' }} value="1">Deactivated</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


@stop()
