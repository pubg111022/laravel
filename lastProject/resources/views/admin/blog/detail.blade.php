@extends('admin.master.master')
@section('main')

    <div class="row">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif  
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Title</th>
                    <th scope="col">Banner</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">{{ $blog->title }}</th>
                    <td><img class="" style="width:200px;height:130px" src="{{ url('uploads') }}/{{ $blog->banner }}"
                            alt="">
                    </td>
                    <th scope="col">{{ $blog->status == 0 ? 'active' : 'deactivated' }}</th>
                    <td><a class="btn-sm btn-primary" href="{{ route('blog.edit', $blog->id) }}">Update</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>
        <h2 style="width: 100%;color: black">Content :</h2>
        </p>

        <p style="width: 70%;color: black">{{ $blog->content }}</p>
    </div>
@stop()
