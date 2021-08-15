@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Add Farmer</h1>
            <form action="{{ route('farmer.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" style="width: 70%" class="form-control" id="">
                </div>
                @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="">Role</label>
                    <input type="text" name="role" style="width: 70%" class="form-control" id="">
                </div>
                @error('role')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div style="width: 70%" class="mr-3">
                        <label for="">Avatar</label>
                        <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                            Image</label>
                    </div>
                </div>
                @error('avatar')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop()
