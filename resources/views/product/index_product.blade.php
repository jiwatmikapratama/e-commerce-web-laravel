@extends('layouts.app', ['title' => 'Product'])

@section('content')
    @if (Auth::check() && Auth::user()->is_admin == true)
        {{-- Button Add Product --}}
        <div class="row  pb-4">
            <div class="col-md-3 col-sm-2">
                <a href="{{ route('create.product') }}" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>
        {{-- End Button Add Product --}}
    @endif


    {{-- Product Section --}}
    {{-- Product Card --}}
    <div class="row rows-cols-2 row-cols-lg-4">
        @forelse ($products as $product)
            <div class="col-md-4 px-2 py-2">
                <a href="{{ route('show.product', $product) }}" class="text-decoration-none text-black">
                    <div class="card h-70" style="">
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                            alt="{{ $product->name }}" width="100%" height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            @if (Auth::check() && Auth::user()->is_admin == true)
                                <form action="{{ route('edit.product', $product) }}" method="get">
                                    @csrf
                                    <button class="btn btn-warning show_confirm">Edit</button>
                                </form>


                                <a href="{{ route('delete.product', $product) }}" class="btn btn-danger"
                                    data-confirm-delete="true">Delete</a>
                            @endif
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Last updated:
                                {{ $product->updated_at->format('d M Y') }}</small>
                            <p class="card-text">Stock Avaiable: {{ $product->stock }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <h1 class="text-center">No Data</h1>
        @endforelse
    </div>
    {{-- End Product Card --}}
    {{-- End Product Section --}}
@endsection
