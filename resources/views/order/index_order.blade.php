@extends('layouts.app', ['title' => 'Order ' . $user_name->name])
@section('content')
    <table class="table table-striped table-bordered">
        <thead>
            <th scope="col">No</th>
            <th scope="col">User</th>
            <th scope="col">Order Time</th>
            <th scope="col">Check Order List</th>
            <th scope="col">Payment Receipt</th>
            @if (Auth::user()->is_admin == true)
                <th scope="col">Action</th>
            @endif
        </thead>
        @forelse ($orders as $order)
            <tbody>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name }} </td>
                <td>{{ $order->created_at }}</td>
                <td><a href="{{ route('show.order', $order) }}">Check</a></td>
                <td>
                    <a target="__blank"
                        href="{{ url('storage/payment_receipts/' . $order->payment_receipt) }}">{{ $order->payment_receipt }}</a>
                </td>
                @if (Auth::user()->is_admin == true)
                    <td>
                        <form action="{{ route('confirm.payment', $order) }}" method="post">
                            @csrf
                            @if ($order->payment_receipt == null || $order->is_paid == false)
                                <button type="{{ $order->is_paid == false ? 'disabled' : 'submit' }}"
                                    class="btn btn-warning">Confirm</button>
                            @else
                                <button type="disabled" class="btn btn-success">Confirmed</button>
                            @endif
                        </form>

                        <form action="{{ route('delete.order', $order) }}" method="post">
                            @csrf
                            @method('delete')
                            <a href="{{ route('delete.order', $order) }}" class="btn btn-danger"
                                data-confirm-delete="true">Delete</a>
                        </form>
                    </td>
                @endif


            </tbody>
        @empty
            <td>No Data Yet</td>
        @endforelse
        <a href="{{ route('index.product') }}">Back</a>
    </table>
@endsection

</body>

</html>
