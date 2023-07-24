<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order {{ $order->user->name }}</title>
</head>

<body>
    <p>{{ $order->user->name }} </p>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Amount</th>
            <th>Transaction Time</th>
        </tr>
        @forelse ($order->transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $transaction->product->image) }}  " alt=""
                        style="width: 200px">
                </td>
                <td>{{ $transaction->product->name }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->created_at }}</td>

            </tr>
        @empty
            <td>No Data Yet</td>
        @endforelse
        <a href="{{ route('index.product') }}">Back</a>
    </table>
</body>

</html>
