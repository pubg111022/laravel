@extends('admin.master.master')
@section('main')
    <form action="{{ route('contact.post_reply',$info->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <h4 for="exampleInputEmail1">Name : {{ $info->name }}</h4>
        </div>
        <div class="form-group">
            <h4 for="exampleInputEmail1">Email : {{ $info->email }}</h4>
        </div>
        <div class="form-group">
            <h4 for="exampleInputEmail1">Phone : {{ $info->phone }}</h4>
        </div>
        <div class="form-group">
            <h4 for="exampleInputEmail1">Comment : {{ $info->comment }}</h4>
        </div>
        <div class="form-group">
           <textarea name="reply" class="form-control" style="width: 30%" id="" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Reply</button>
    </form>
@stop
