@extends('admin.master.master')
@section('main')
    <div class="row">
        {{-- @if (session('alert'))
            <section class='alert alert-{{ session('color') }}'>{{ session('alert') }}</section>
        @endif --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_detail as $key=> $item)
                    <tr>
                        <th scope="col">{{ $key+1 }}</th>
                        <th scope="col">{{ $item->name }}</th>
                        <th scope="col"><img style="width: 120px;height: 120px;" src="{{ url('uploads') }}/{{ $item->image }}" alt=""></th>
                        <th scope="col">{{ $item->quantity }}</th>
                        <th scope="col">${{ $item->price }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
