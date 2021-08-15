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
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($config as $key => $value)
                    <tr>
                        <th scope="col">{{ $key }}</th>
                        <th scope="col">{{ $value->name }}</th>
                        @if($value->type=='file')
                        <th scope="col">
                            <img src="{{ url('uploads') }}/{{ $value->content }}" style="width: 100px;height: 100px;"  alt="">
                        </th>
                        @else
                        <th scope="col">{{ $value->content }}</th>
                        @endif
                        <th scope="col">{{ $value->status == 0 ? 'Active' : 'Deactivated' }}</th>
                        <th scope="col"><a class="btn btn-primary" href="{{ route('config.edit',$value->id) }}">Update</a></th>
                        <form action="{{ route('config.destroy', $value->id) }}" method="POST">
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
