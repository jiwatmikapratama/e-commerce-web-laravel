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
            <th>Action</th>
        </tr>
        @php
            $total_price = 0;
        @endphp
        <p>{{ $carts }}</p>
        @forelse ($carts as $cart)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cart->product->name }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}"
                        width="200">
                </td>
                <td>
                    <form action="{{ route('update.cart', $cart) }}" method="post">
                        @method('patch')
                        @csrf
                        <input type="number" name="amount" value="{{ $cart->amount }}"
                            class="@error('amount') is-invalid @enderror">
                        <button type="submit">Update Data</button><br>
                        @error('amount')
                            <span>{{ $errors->first('amount') }}</span>
                        @enderror
                    </form>
                </td>

                <td>{{ $cart->product->price }}</td>
                <td>
                    <form action="{{ route('delete.cart', $cart) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @php
                $total_price += $cart->product->price * $cart->amount;
            @endphp
        @empty
            <td>No Data Yet</td>
        @endforelse



        <a href="{{ route('index.product') }}">Back</a>
    </table>
    @if ($carts != null)
        <form action="{{ route('checkout') }}" method="post">
            @csrf
            <button type="submit">Checkout</button>
        </form>
    @endif

    <p>Total Price Rp. {{ $total_price }}</p>
</body>

</html>
