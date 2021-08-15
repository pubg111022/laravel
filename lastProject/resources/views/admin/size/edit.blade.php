@extends('admin.master.master')
@section('main')

<div class="row">
    <div class="col-md-6 offset-3">
        <h1>Update Size</h1>
        <form action="{{route('size.update',$old_size->id)}}" method="post">
            @method('put');
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" style="width: 70%" value="{{$old_size->name}}" value="{{ old('name') }}" class="form-control" id="">
                @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>


@stop()