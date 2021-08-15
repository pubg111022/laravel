@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update Farmer</h1>
            <form action="{{ route('farmer.update', $old_farmer->id) }}" method="post" enctype="multipart/form-data">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $old_farmer->name }}" style="width: 70%" class="form-control"
                        id="">
                </div>
                @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="">Role</label>
                    <input type="text" name="role" value="{{ $old_farmer->role }}" style="width: 70%" class="form-control"
                        id="">
                </div>
                @error('role')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <div style="width: 70%" class="mr-3">
                        <label for="">Avatar</label>
                        <br>
                        <img src="{{ url('uploads') }}/{{ $old_farmer->avatar }}" style="width: 20%" alt="">
                        <div style="height: 20px;"></div>
                        <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                            Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@stop()
