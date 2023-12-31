@extends('layouts.app', ['title' => 'Order ' . ''])

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <th>No</th>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Amount</th>
            <th>Transaction Time</th>
        </thead>
        @php
            $total_price = 0;
        @endphp
        @forelse ($order->transactions as $transaction)
            <tbody>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset('storage/products/' . $transaction->product->image) }}  " alt=""
                        style="width: 200px">
                </td>
                <td>{{ $transaction->product->name }}</td>
                <td>{{ $transaction->product->price }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tbody>
            @php
                $total_price += $transaction->amount * $transaction->product->price;
            @endphp
        @empty
            <thead>No Data Yet</thead>
        @endforelse

        {{-- @if ($order->user_id === Auth::id()) --}}
        @if ($order->is_paid == false && $order->payment_receipt == null)
            <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row pb-3">
                    <div class="col-md-8">
                        <input type="file" name="payment_receipt" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('index.order') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </form>
            {{-- @endif --}}
        @endif

    </table>

    <td>Total Payment: Rp. {{ $total_price }}</td><br>
    <td>
        @if ($order->payment_receipt != null)
            Order been have paid <span class="badge text-bg-success">Paid</span>
        @else
            Order not paid yet<span class="badge text-bg-danger">Unpaid</span>
        @endif
    </td>
@endsection
