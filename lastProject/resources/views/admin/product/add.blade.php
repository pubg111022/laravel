@extends('admin.master.master')
@section('main')
    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Add Product</h1>
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" style="width: 70%" class="form-control"
                        id="">
                    @error('name')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" min="1" value="{{ old('price') }}" name="price" style="width: 70%"
                        class="form-control" id="">
                    @error('price')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Sale Price
                    </label>
                    <input type="number" min="0" value="0" value="{{ old('sale_price') }}" name="sale_price"
                        style="width: 70%" class="form-control" id="">
                    @error('sale_price')
                        <div class="text text-danger">{{ $message }}</div>
                        @endIf
                    </div>
                    <div class="form-group d-flex">
                        <div style="width: 32%" class="mr-3">
                            <label for="apply" class="lablez"><input type="file" name="file" class="inputz" id="apply">Get
                                Image</label>
                        </div>
                        <div class="form-group file-input">
                            <label for="message-image" class="col-form-label">Description Image</label>
                            <input class="form-control d-none" name="files[]" id="message-image" type="file" multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Size</label>
                        <br>
                        @foreach ($size as $value)
                            <input type="checkbox" class="m-2" name="size[]" value="{{$value->id}}" id="">{{$value->name}}
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <select name="brand_id" class="form-control" style="width: 70%" id="">
                            @foreach ($brand as $key => $value)
                                <option {{ old('category_id') == $value->id ? 'selected' : '' }} value="{{ $value->id }}">
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control" style="width: 70%" id="">
                            @foreach ($category as $key => $value)
                                <option {{ old('category_id') == $value->id ? 'selected' : '' }} value="{{ $value->id }}">
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <br>
                        <input type="radio" {{ old('status') == 1 ? 'checked' : '' }} name="status" class="mr-2" value="0"
                            checked>Still
                        <br>
                        <input type="radio" {{ old('status') == 0 ? 'checked' : '' }} name="status" class="mr-2"
                            value="1">Sold Out
                    </div>
                    <div class="form-group">
                        <label for="">Description
                        </label>
                        <input type="text" min="0" value="{{ old('description') }}" name="description" style="width: 70%"
                            class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>


    @stop()
