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
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type as $key => $value)
                    <tr>
                        <th scope="col">{{ $key }}</th>
                        <th scope="col">{{ $value->type }}</th>
                        <th scope="col">{{ $value->status == 1 ? 'Con' : 'Het' }}</th>
                        <th scope="col"><a class="btn btn-primary" href="{{ route('type_config.edit',$value->id) }}">Update</a></th>
                        <form action="{{ route('type_config.destroy', $value->id) }}" method="POST">
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
