@extends('admin.master.master')
@section('main')

    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update shipping</h1>
            <form action="{{ route('shipping.update', $old_shipping->id) }}" method="post">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" style="width: 70%" value="{{ $old_shipping->name }}"
                        value="{{ old('name') }}" class="form-control" id="">
                    @error('name')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                    <label for="">Price</label>
                    <input type="number" name="price" style="width: 70%" value="{{ $old_shipping->price }}"
                        value="{{ old('price') }}" class="form-control" id="">
                    @error('price')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                    <label for="">Status</label>
                    <br>
                    <select name="status">
                        <option {{ $old_shipping->status == 0 ? 'selected' : '' }} value="0">Active</option>
                        <option {{ $old_shipping->status == 1 ? 'selected' : '' }} value="1">Deactivated</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


@stop()
