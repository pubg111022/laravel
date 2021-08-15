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
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Reply</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contact as $key=> $item)
                    <tr>
                        <th scope="col">{{ $key+1 }}</th>
                        <th scope="col">{{ $item->name }}</th>
                        <th scope="col">{{ $item->email }}</th>
                        <th scope="col">{{ $item->phone }}</th>
                        <th scope="col">{{ $item->comment }}</th>
                        <th scope="col" class="{{ $item->status==0?"text-warning":"text-success" }}">{{ $item->status==0?"Chua xu li":"Da xu li" }}</th>
                        <th scope="col" ><a class="btn btn-primary" href="{{ route('contact.contact_reply',$item->id) }}">Reply</a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@stop()
