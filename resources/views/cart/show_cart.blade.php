@extends('layouts.app', ['title' => 'Cart'])
@section('content')
    <div class="container">
        @php
            $total_price = 0;
        @endphp
        <div class="row">
            @if (count($carts) == 0)
                <h1>You don't have products in your cart yet</h1>
            @else
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success">Checkout</button>
                </form>
            @endif


        </div>
        @foreach ($carts as $cart)
            <div class="row justify-content-center mb-3">
                <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                        <img src="{{ asset('storage/products/' . $cart->product->image) }}"
                                            alt="{{ $cart->product->name }}" width="200" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <h5>{{ $cart->product->name }}</h5>
                                    <div class="d-flex flex-row">
                                        <span>Stock: {{ $cart->product->stock }}</span>
                                    </div>
                                    <div class="mt-1 mb-0 text-muted small">
                                        <form action="{{ route('update.cart', $cart) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <input type="number" class="form-control mb-2" name="amount"
                                                value="{{ $cart->amount }}" class="@error('amount') is-invalid @enderror">
                                            @error('amount')
                                                <span>{{ $errors->first('amount') }}</span>
                                            @enderror

                                            <button class="btn btn-primary btn-sm" type="submit">Update Product
                                                Amount</button>
                                        </form>
                                    </div>
                                    <p class="text-truncate mb-4 mb-md-0">
                                        {{ $cart->product->description }}
                                    </p>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                    <div class="d-flex flex-row align-items-center mb-1">
                                        <h4 class="mb-1 me-1">Rp. {{ $cart->product->price }}</h4>
                                    </div>
                                    <div class="d-flex flex-column mt-4">
                                        <form action="{{ route('delete.cart', $cart) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <a href="{{ route('delete.cart', $cart) }}"
                                                class="btn btn-outline-danger btn-sm mt-2" data-confirm-delete="true">Delete
                                                From Cart</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $total_price += $cart->product->price * $cart->amount;
            @endphp
        @endforeach
        @if ($total_price != 0)
            <p>Total Price Rp. {{ $total_price }}</p>
        @endif
    @endsection
