<div class="card">
    <div class="card-header">
        Hello Customer
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ $order->total }}</td>
                <td>
                    <a href="{{ url('download/invoice') }}/{{ $order->id }}">
                        <i class="fa fa-download">Download Invoice</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>