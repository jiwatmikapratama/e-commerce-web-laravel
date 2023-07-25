<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Product</title>
</head>

<body>
    <a href="{{ route('create.product') }}">Add Data</a>
    <a href="{{ route('show.cart') }}">Show Cart</a>
    <a href="{{ route('index.order') }}">Checkout Orders</a>
    {{-- <a href="{{ route('show.order', $order) }}">Checkout Orders</a> --}}
    <table border="1">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <form action="{{ route('show.product', $product) }}" method="get">
                        @csrf
                        <button type="submit">{{ $product->name }}</button>
                    </form>


                <td>{{ $product->description }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        width="200">
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('edit.product', $product) }}">Update</a>
                    <form action="{{ route('delete.product', $product) }}" method="post">
                        @method('delete')
                        @csrf

                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <td>No Data Yet</td>
        @endforelse

    </table>
</body>

</html>
