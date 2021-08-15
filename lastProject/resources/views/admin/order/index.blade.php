@extends('admin.master.master')
@section('main')
    <div class="row">
        {{-- @if (session('alert'))
            <section class='alert alert-{{ session('color') }}'>{{ session('alert') }}</section>
        @endif --}}
        <select onchange="order_filter()" id="order_filter" class="form-control col-sm-2 mb-3" id="">
            <option {{ session()->get('order') == 'new'?"selected":"" }} value="new">New | All</option>
            <option {{ session()->get('order') == 'paid'?"selected":"" }} value="paid">Paid</option>
            <option {{ session()->get('order') == 'unpaid'?"selected":"" }} value="unpaid">Unpaid</option>
            <option {{ session()->get('order') == 'noprocess'?"selected":"" }} value="noprocess">No Process</option>
            <option {{ session()->get('order') == 'processed'?"selected":"" }} value="processed">Processed</option>
            <option {{ session()->get('order') == 'delivering'?"selected":"" }} value="delivering">Delivering</option>
            <option {{ session()->get('order') == 'delivered'?"selected":"" }} value="delivered">Delivered</option>
            <option {{ session()->get('order') == 'cancelled'?"selected":"" }} value="cancelled">Cancelled</option>
        </select>
        <table class="table">
            <thead>
                <tr style="background: blueviolet;color: white">
                    <th scope="col">Stt</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Shipping Method</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Shipping Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">View Detail</th>
                </tr>
            </thead>
            <tbody id="fil">
                @foreach ($order as $key => $item)
                    <form action="{{ route('order.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <?php $name_method = $method->getName($item->shipping_method_id); ?>
                        <tr>
                            <th scope="col">{{ $key + 1 }}</th>
                            <th scope="col">{{ $item->name }}</th>
                            <th scope="col">{{ $item->phone }}</th>
                            <th scope="col">{{ $item->email }}</th>
                            <th scope="col">{{ $item->address }}</th>
                            <th scope="col">{{ $item->quantity }}</th>
                            <th scope="col">{{ $name_method }}</th>
                            <th scope="col">{{ $item->payment_methods == 0 ? 'Cash On Delivery' : 'Online Banking' }}</th>
                            <th scope="col">
                                <select name="order_status" id="">
                                    <option {{ $item->order_status == 0 ? 'selected' : ' ' }} value="0">Unpaid</option>
                                    <option {{ $item->order_status == 1 ? 'selected' : ' ' }} value="1">Paid</option>
                                </select>
                            </th>
                            <th scope="col">
                                <select name="shipping_status" id="">
                                    <option {{ $item->shipping_status == 0 ? 'selected' : ' ' }} value="0">No Process
                                    </option>
                                    <option {{ $item->shipping_status == 1 ? 'selected' : ' ' }} value="1">Processed
                                    </option>
                                    <option {{ $item->shipping_status == 2 ? 'selected' : ' ' }} value="2">Delivering
                                    </option>
                                    <option {{ $item->shipping_status == 3 ? 'selected' : ' ' }} value="3">Delivered
                                    </option>
                                    <option {{ $item->shipping_status == 4 ? 'selected' : ' ' }} value="4">Cancelled
                                    </option>
                                </select>
                            </th>
                            <th scope="col">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </th>
                            <th scope="col">
                                <a href="{{ route('order.show', $item->id) }}" class="btn btn-success">View</a>
                            </th>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function order_filter() {
            filter = $("#order_filter").val();
            $.ajax({
                type: "GET",
                url: "{{ route('order_filter') }}",
                data: {
                    filter: filter
                },
                success: function(data) {
                    url = window.location.origin + "/admin/order=" + filter;
                    window.history.pushState("Details", "Title", url);
                    $("#fil").html(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }

        function update_order(id) {
            order_status = $("#order_status").val();
            shipping_status = $("#shipping_status").val();
            $.ajax({
                type: "GET",
                url: "{{ route('update_order') }}",
                data: {
                    order_status: order_status,
                    shipping_status: shipping_status,
                    id: id
                },
                success: function(data) {
                    location.reload();
                    console.log(data);
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }
    </script>

@stop()
