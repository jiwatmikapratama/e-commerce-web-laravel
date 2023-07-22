<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart {{ Auth::user()->name }}</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        @forelse ($carts as $cart)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cart->product->name }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}"
                        width="200">
                </td>


                <td>{{ $cart->amount }}</td>
                <td>{{ $cart->product->price }}</td>
                <td>{{ $cart->product->stock }}</td>
                <td>
                    {{-- <a href="{{ route('edit.product', $product) }}">Update</a>
                    <form action="{{ route('delete.product', $product) }}" method="post">
                        @method('delete')
                        @csrf

                        <button type="submit">Delete</button>
                    </form> --}}
                </td>
            </tr>
        @empty
            <td>No Data Yet</td>
        @endforelse
        <a href="{{ route('index.product') }}">Back</a>
    </table>
</body>

</html>
