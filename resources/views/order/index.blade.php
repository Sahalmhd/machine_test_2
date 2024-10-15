@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->customername }}</td>
                <td>{{ $order->orderdate }}</td>
                <td>₹{{ $order->totalamount }}</td>
                <td>{{ $order->orderstatus }}</td>
                <td>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
