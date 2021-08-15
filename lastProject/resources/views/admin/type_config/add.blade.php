@extends('admin.master.master')
@section('main')
    <form action="{{ route('type_config.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Type</label>
            <input style="width: 20%" name="type" type="text" class="form-control">
        </div>
        @error('name')
            <div class="text text-danger">{{ $message }}</div>
        @enderror
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="0">Active</option>
            <option selected value="1">Deactivated</option>
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-primary" >Submit</button>
    </form>
@stop
