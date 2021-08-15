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
                    <th scope="col">Image</th>
                    <th scope="col">Update</th>
                    <th scope="col">View Detail</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @csrf
                @foreach ($blog as $key => $value)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $value->title }}</td>
                        <td><img class="" style="width:200px;height:130px"
                                src="{{ url('uploads') }}/{{ $value->banner }}" alt="">
                        </td>
                        <td><a class="btn-sm btn-primary" href="{{ route('blog.edit', $value->id) }}">Update</a>
                        </td>
                        <td><a class="btn-sm btn-primary" href="{{ route('blog.show', $value->id) }}">View Detail</a>
                        </td>
                        <form action="{{ route('blog.destroy', $value->id) }}" method="POST">
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
