@extends('layouts.app', ['title' => 'Add Product'])

@section('content')
    <div class="container">
        <div class="card ">
            <div class="card-body">
                <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- Form Field Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Name">
                        @error('name')
                            <p class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $message }}</p>
                        @enderror

                    </div>
                    {{-- END Form Field Name --}}

                    {{-- Form Field Description --}}
                    <div class="mb3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" placeholder="Description">
                        @error('description')
                            <p class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $message }}</p>
                        @enderror

                    </div>
                    {{-- END Form Field Description --}}

                    {{-- Form Field Price --}}
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" placeholder="Price in RP.">
                        @error('price')
                            <p class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    {{-- END Form Field Price --}}

                    {{-- Form Control Stock --}}
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock"
                            name="stock" placeholder="Stock">
                        @error('stock')
                            <p class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    {{-- END Form Control Stock --}}

                    {{-- Form Control Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Product Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image">
                        @error('image')
                            <p class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                                </svg>
                                {{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
