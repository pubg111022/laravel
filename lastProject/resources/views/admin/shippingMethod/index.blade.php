@extends('admin.master.master')
@section('main')
    <div class="row">
        {{-- @if (session('alert'))
            <section class='alert alert-{{ session('color') }}'>{{ session('alert') }}</section>
        @endif --}}
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
                @foreach ($method as $key => $value)
                    <tr>
                        <th scope="col">{{ $key+1 }}</th>
                        <th scope="col">{{ $value->name }}</th>
                        <th scope="col">x{{ $value->price }}</th>
                        <th scope="col">{{ $value->status == 0 ? 'Active' : 'Deactivated' }}</th>
                        <th scope="col"><a class="btn btn-primary" href="{{ route('shippingmethod.edit',$value->id) }}">Update</a></th>
                        <form action="{{ route('shippingmethod.destroy', $value->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <th scope="col"><Button class="btn btn-danger" >Remove</Button></th>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@stop()
