@extends('admin.master.master')
@section('main')
    <form action="{{ route('category.update', $old->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input style="width: 20%" value="{{ $old->name }}" name="name" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select class="form-select" name="status" aria-label="Default select example">
            <option {{ $old->status == 0 ? 'checked' : '' }} value="0">Active</option>
            <option {{ $old->status == 1 ? 'checked' : '' }} value="1">Deactivated</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop
