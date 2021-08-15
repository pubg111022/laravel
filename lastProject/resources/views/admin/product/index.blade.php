@extends('admin.master.master')
@section('main')

    <div class="row">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif  
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Stt</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">View Detail</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item => $value)
                    <tr>
                        <th scope="col">{{ $item + 1 }}</th>
                        <th scope="col">{{ $value->name }}</th>
                        <td><img class="" style="width:100px;height:100px"
                                src="{{ url('uploads') }}/{{ $value->image }}" alt="">
                        </td>
                        <td>$ {{ $value->price }}</td>
                        <td>$ {{ $value->sale_price }}</td>
                        <td class="{{ $value->status == 1 ? 'text-danger' : 'text-success' }}">
                            {{ $value->status == 1 ? 'Deactivated' : 'Active' }}
                        </td>
                        <td><a class="btn-sm btn-primary" href="{{ route('product.edit', $value->id) }}">Update</a>
                        </td>
                        <td><a class="btn-sm btn-primary" href="{{ route('product.show', $value->id) }}">View Detail</a>
                        </td>
                        <form action="{{ route('product.destroy', $value->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <td><button class="btn-sm btn-danger">Remove</button>
                            </td>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
