@extends('admin.master.master')
@section('main')

    <div class="row">
        <div class="col-md-6 offset-3">
            <h1>Update Product</h1>
            <form action="{{ route('product.update', $old_product->id) }}" method="post" enctype="multipart/form-data">
                @method('put');
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{ $old_product->name }}" style="width: 70%"
                        class="form-control" id="">
                    @error('name')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="price" value="{{ $old_product->price }}" style="width: 70%"
                        class="form-control" id="">
                    @error('price')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Sale Price</label>
                    <input type="text" name="sale_price" value="{{ $old_product->sale_price }}" style="width: 70%"
                        class="form-control" id="">
                    @error('sale_price')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <br>
                    <img src="{{ url('uploads') }}/{{ $old_product->image }}" style="width: 20%" alt="">
                </div>
                <div class="form-group">
                    <div style="width: 32.1%" class="mr-3">
                        <label for="">Image</label>
                        <label for="apply" style="" class="lablezz"><input type="file" name="file" class="inputz"
                                id="apply">Change
                            Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Description Image</label>
                    <br>
                    <ul class="ul p-1">
                        @foreach ($desImg as $key => $value)
                            @if ($key % 4 == 0)
                                <br/>
                            @endif;
                            <li class="li">
                                <input type="checkbox" name="ima[]" value="{{$value->id}}" id="myCheckbox{{ $value->id }}" />
                                <label class="label" for="myCheckbox{{ $value->id }}">
                                    <img src="{{ url('uploads') }}/{{ $value->image }}" />
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="form-group d-flex">
                    <div class="form-group file-input">
                        <label for="message-image" class="col-form-label">Description Image</label>
                        <input class="form-control d-none" name="files[]" id="message-image" type="file" multiple>
                    </div>  
                </div>
                <div class="form-group">
                    <label for="">size</label>
                    <br>
                    @foreach ($size as $value)
                        <input type="checkbox" {{(in_array($value->id,$old_size))?"checked":""}}  class="m-2" name="size[]" value="{{$value->id}}" id="">{{$value->name}}
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="">Brand</label>
                    <select name="brand_id" class="form-control" style="width: 70%" id="">
                        @foreach ($brand as $key => $value)
                            <option {{ $old_product->brand_id == $value->id ? 'selected' : '' }}
                                value="{{ $value->id }}">{{ $value->name }}</option>
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
                            <option {{ $old_product->category_id == $value->id ? 'selected' : '' }}
                                value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <br>
                    <input type="radio" name="status" class="mr-2" value="1"
                        {{ $old_product->status == 1 ? 'checked' : '' }}>Sold Out
                    <br>
                    <input type="radio" name="status" class="mr-2" value="0"
                        {{ $old_product->status == 0 ? 'checked' : '' }}>Still
                </div>
                <div class="form-group">
                    <label for="">Description
                    </label>
                    <input type="text" min="0" value="{{$old_product->description}}" value="{{ old('description') }}" name="description" style="width: 70%"
                        class="form-control" id="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


@stop()
