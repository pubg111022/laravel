@extends('admin.master.master')
@section('main')

    <div class="row">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif  
        @csrf
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Stt</th>
                    <th scope="col">Title</th>
                    <th scope="col">Role</th>
                    <th scope="col">Image</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @csrf
                @foreach ($farmer as $key => $value)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->role }}</td>
                        <td><img class="" style="width:180px;height:200px"
                                src="{{ url('uploads') }}/{{ $value->avatar }}" alt="">
                        </td>
                        <td><a class="btn-sm btn-primary" href="{{ route('farmer.edit', $value->id) }}">Update</a>
                        </td>
                        <form action="{{ route('farmer.destroy', $value->id) }}" method="POST">
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
