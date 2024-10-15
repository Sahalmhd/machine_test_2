@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <!-- Customer Details -->
        <div class="mb-3">
            <label for="customername">Customer Name</label>
            <input type="text" name="customername" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address">Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mobile">Mobile</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="orderdate">Order Date</label>
            <input type="date" name="orderdate" class="form-control" required>
        </div>

        <!-- Order Items -->
        <h4>Order Items</h4>
        <div id="order-items">
            <div class="mb-3">
                <select name="items[0][itemid]" class="form-control" required>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->itemname }} (₹{{ $item->price }})</option>
                    @endforeach
                </select>
                <input type="number" name="items[0][qty]" class="form-control mt-2" placeholder="Quantity" required>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" onclick="addItem()">Add Another Item</button>
        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>

<script>
function addItem() {
    var itemIndex = document.querySelectorAll('#order-items div').length;
    var html = `
        <div class="mb-3">
            <select name="items[${itemIndex}][itemid]" class="form-control" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->itemname }} (₹{{ $item->price }})</option>
                @endforeach
            </select>
            <input type="number" name="items[${itemIndex}][qty]" class="form-control mt-2" placeholder="Quantity" required>
        </div>`;
    document.getElementById('order-items').insertAdjacentHTML('beforeend', html);
}
</script>
@endsection
