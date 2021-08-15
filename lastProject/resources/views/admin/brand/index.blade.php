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
                    <th scope="col">Name</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @csrf
                @foreach ($brand as $key => $value)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $value->name }}</td>
                        <td><img class="" 
                                src="{{ url('uploads') }}/{{ $value->logo }}" alt="">
                        </td>
                        <td class="{{ $value->status==0?"text-success":"text-danger" }}">{{ $value->status==0?"Active":"Deactivate" }}</td>
                        <td><a class="btn-sm btn-primary" href="{{ route('brand.edit', $value->id) }}">Update</a>
                        </td>
                        <form action="{{ route('brand.destroy', $value->id) }}" method="POST">
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
