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
                    <th scope="col">Code</th>
                    <th scope="col">Value</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Condition</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupon as $key => $item)
                    <tr>
                        <th scope="col">{{ $key + 1 }}</th>
                        <th scope="col">{{ $item->code }}</th>
                        @if ($item->condition == 0)
                            <th scope="col">${{ $item->value }}</th>
                        @endif
                        @if ($item->condition == 1)
                            <th scope="col">{{ $item->value }}%</th>
                        @endif
                        <th scope="col">{{ $item->quantity }}</th>
                        <th scope="col" class="{{ $item->status == 0 ? 'text-success' : 'text-danger' }}">
                            {{ $item->status == 0 ? 'Active' : 'Deactivated' }}</th>
                        @if ($item->condition == 0)
                            <th scope="col">Money Reduction</th>
                        @endif
                        @if ($item->condition == 1)
                            <th scope="col">% Off Money</th>
                        @endif
                        <th scope="col"><a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-primary">Update</a>
                        </th>
                        <form action="{{ route('coupon.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <th scope="col"><button type="submit" class="btn btn-danger">Delete</button></th>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop()
