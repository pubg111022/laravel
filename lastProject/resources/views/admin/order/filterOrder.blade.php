@foreach ($order as $key => $item)
<form action="{{ route('order.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    <?php $name_method = $method->getName($item->shipping_method_id); ?>
    <tr >
        <th scope="col">{{ $key + 1 }}</th>
        <th scope="col">{{ $item->name }}</th>
        <th scope="col">{{ $item->phone }}</th>
        <th scope="col">{{ $item->email }}</th>
        <th scope="col">{{ $item->address }}</th>
        <th scope="col">{{ $item->quantity }}</th>
        <th scope="col">{{ $name_method }}</th>
        <th scope="col">{{ $item->payment_methods == 0 ? 'Cash On Delivery' : 'Online Banking' }}</th>
        <th scope="col">
            <select name="order_status"  id="order_status">
                <option {{ $item->order_status == 0 ? 'selected' : ' ' }} value="0">Unpaid</option>
                <option {{ $item->order_status == 1 ? 'selected' : ' ' }} value="1">Paid</option>
            </select>
        </th>
        <th scope="col">
            <select name="shipping_status"  id="shipping_status">
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
            <a onclick="update_order({{ $item->id }})" class="btn btn-primary text-light">Update</a>
        </th>
        <th scope="col">
            <a href="{{ route('order.show',$item->id) }}" class="btn btn-success">View</a>
        </th>
    </tr>
</form>
@endforeach