@extends('admin.master.master')
@section('main')

    <div class="row">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif  
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">{{ $product->name }}</th>
                    <td><img class="" style="width:100px;height:100px" src="{{ url('uploads') }}/{{ $product->image }}"
                            alt="">
                    </td>
                    <th scope="col">$ {{ $product->price }}</th>
                    <th scope="col">$ {{ $product->sale_price }}</th>
                    <th scope="col">{{ $product->status == 0 ? 'still' : 'Sold Out' }}</th>
                    <td><a class="btn-sm btn-primary" href="{{ route('product.edit', $product->id) }}">Update</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <p ><h2 style="width: 100%;color: black">Description :</h2></p>

        <p style="width: 30%;color: black">{{ $product->description }}</p>
    </div>
@stop()
