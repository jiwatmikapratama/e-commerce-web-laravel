<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product {{ $product->name }}</title>
</head>

<body>
    <form action="{{ route('update.product', $product) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input type="text" name="name" placeholder="name" value="{{ $product->name }}"><br>
        <input type="text" name="description" placeholder="description" value="{{ $product->description }}"><br>
        <input type="number" name="price" placeholder="price" value="{{ $product->price }}"><br>
        <input type="number" name="stock" placeholder="stock" value="{{ $product->stock }}"><br>
        <input type="file" name="image"><br>
        <button type="submit">Submit</button>
    </form>

</body>

</html>
