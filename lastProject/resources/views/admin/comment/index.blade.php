@extends('admin.master.master')
@section('main')

    <div class="row">
        @if (session('alert'))
            <section class='alert alert-success'>{{ session('alert') }}</section>
        @endif  
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Stt</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Blog Name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Accept</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comment as $key=> $item)
                <tr>
                    <th scope="col">{{ $key+1 }}</th>
                    <th scope="col">{{ $item->getName->name }}</th>
                    <th scope="col">{{ $item->getBlogName->title }}</th>
                    <th scope="col">{{ $item->comment }}</th>
                    <th scope="col" class="{{ $item->status==1 ?"text-success" : "text-danger" }}">{{ $item->status==1 ?"Accept" : "Does not accept" }}</th>
                    <th scope="col"><a href="{{ route('accept',$item->id) }}" class="btn btn-primary">Accept</a></th>
                    <th scope="col"><a href="{{ route('removecomment',$item->id) }}" class="btn btn-danger">Remove</a></th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
