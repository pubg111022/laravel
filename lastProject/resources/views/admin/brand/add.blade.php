@extends('admin.master.master')
@section('main')
    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <label for="exampleInputEmail1">Logo</label>
        <div class="form-group d-flex">
            <div style="width: 20%" class="mr-3">
                <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                    Image</label>
            </div>
        </div>
        @error('logo')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="0">Active</option>
            <option value="1">Deactivate</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
