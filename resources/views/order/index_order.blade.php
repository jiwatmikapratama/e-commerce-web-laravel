<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Order Time</th>
            <th>Payment Receipt</th>
            <th>Action</th>
        </tr>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name }} </td>
                <td>{{ $order->created_at }}</td>
                <td>
                    <a target="__blank"
                        href="{{ url('storage/payment_receipts/' . $order->payment_receipt) }}">{{ $order->payment_receipt }}</a>
                </td>
                <td>
                    @if ($order->payment_receipt != null)
                        @if ($order->is_paid == false)
                            <form action="{{ route('confirm.payment', $order) }}" method="post">
                                @csrf
                            </form>
                        @else
                            <button type="disabled">Confirmed</button>
                        @endif
                    @endif

                </td>

            </tr>
        @empty
            <td>No Data Yet</td>
        @endforelse
        <a href="{{ route('index.product') }}">Back</a>
    </table>
</body>

</html>
