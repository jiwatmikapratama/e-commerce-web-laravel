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

    @forelse ($products as $product)
        <a href="{{ route('show.product', $product) }}" class="text-decoration-none text-black">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top"
                    alt="{{ $product->name }}" width="200">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    @if (Auth::check() && Auth::user()->is_admin == true)
                        <form action="{{ route('edit.product', $product) }}" method="get">
                            @csrf
                            <button class="btn btn-warning show_confirm">Edit</button>
                        </form>

                        <form action="{{ route('delete.product', $product) }}" method="post">
                            @method('delete')
                            @csrf
                            <a href="{{ route('delete.product', $product) }}" class="btn btn-danger"
                                data-confirm-delete="true">Delete</a>
                        </form>
                    @endif
                </div>
                <div class="card-footer">
                    <small class="text-body-secondary">Last updated:
                        {{ $product->updated_at->format('d M Y') }}</small>
                    <p class="card-text">Stock Avaiable: {{ $product->stock }}</p>
                </div>
            </div>
        </a>


        {{-- Product Card --}}

        {{-- End Product Card --}}

    @empty
        <h1 class="text-center">No Data</h1>
    @endforelse
    {{-- End Product Section --}}
    </div>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script> --}}
@endsection
