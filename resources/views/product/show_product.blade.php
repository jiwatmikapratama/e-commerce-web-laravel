<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product {{ $product->name }}</title>
</head>


<body>
    <p>{{ $product->name }}</p>
    <p>{{ $product->description }}</p>
    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="200">

    <p>{{ $product->price }}</p>
    <p>{{ $product->stock }}</p>
    <form action="{{ route('add_to_cart', $product) }}" method="post">
        @csrf
        <p>Buy:</p>
        <input type="number" name="amount">
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('index.product') }}">Back</a>
</body>

</html>
