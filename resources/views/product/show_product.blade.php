@extends('layouts.app', ['title' => $product->name])
@section('content')
    <p>{{ $product->name }}</p>
    <p>{{ $product->description }}</p>
    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="200">

    <p>Price: {{ $product->price }}</p>
    <p>Avaiable Stock: {{ $product->stock }}</p>
    <form action="{{ route('add_to_cart', $product) }}" method="post">
        @csrf
        <p>Buy:</p>
        <input type="number" name="amount">
        <button type="submit">Submit</button>
    </form>
    <a href="{{ route('index.product') }}">Back</a>
@endsection
