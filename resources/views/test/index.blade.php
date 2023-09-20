<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Amout</th>
                <th scope="col">Product Name</th>
                <th scope="col">Order_id</th>
            </tr>
        </thead>
        @foreach ($transactions as $transaction)
            <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->product_id }}</td>
                    <td>{{ $transaction->order_id }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Amout</th>
                <th scope="col">Product Name</th>
                <th scope="col">Order_id</th>
            </tr>
        </thead>
        @foreach ($products as $transaction)
            <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $transaction->name }}</td>
                    <td>{{ $transaction->stock }}</td>
                    <td>{{ $transaction->price }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
</body>

</html>
