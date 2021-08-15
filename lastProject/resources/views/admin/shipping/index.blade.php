@extends('admin.master.master')
@section('main')
    <div class="row">
        @if (session('alert'))
            <section class='alert alert-{{ session('color') }}'>{{ session('alert') }}</section>
        @endif  
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Stt</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shipping as $key => $item)
                    <tr>
                        <th scope="col">{{ $key + 1 }}</th>
                        <th scope="col">{{ $item->name }}</th>
                        <th scope="col">${{ $item->price }}</th>
                        <th scope="col" class="{{ $item->status == 0 ? 'text-success ' : 'text-danger' }}">
                            {{ $item->status == 0 ? 'Active ' : 'Deactivated' }}</th>
                        <th scope="col"><a href="{{ route('shipping.edit', $item->id) }}" class="btn btn-primary">Update</a>
                        </th>
                        <form action="{{ route('shipping.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <th scope="col"><button type="submit" class="btn btn-danger">Delete</button></th>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@stop()
