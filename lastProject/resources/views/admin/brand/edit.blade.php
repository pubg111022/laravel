@extends('admin.master.master')
@section('main')
    <form action="{{ route('brand.update', $old->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" value="{{ $old->name }}" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <label for="exampleInputEmail1">Logo</label>
        <br>
        <img style="width: 100px;height: 100px;" src="{{ url('uploads')}}/{{ $old->logo }} " alt="">
        <div class="form-group d-flex mt-2">
            <div style="width: 20%" class="mr-3">
                <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                    Image</label>
            </div>
        </div>
        <select class="form-select" name="status" aria-label="Default select example">
            <option {{ $old->status == 0 ? 'checked' : '' }} value="0">Active</option>
            <option {{ $old->status == 1 ? 'checked' : '' }} value="1">Deactivate</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
