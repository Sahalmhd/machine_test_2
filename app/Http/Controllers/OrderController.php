<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OrderMaster;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Form to create order
    public function create()
    {
        $items = Item::all(); // Get all items to display in the form
        return view('order.create', compact('items'));
    }

    // Store the order
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'customername' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'orderdate' => 'required|date',
            'items' => 'required|array',
            'items.*.itemid' => 'required|exists:items,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        // Create the order master record
        $order = OrderMaster::create([
            'customername' => $request->customername,
            'address' => $request->address,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'orderdate' => $request->orderdate,
            'totalamount' => 0, // Initial total amount will be calculated later
            'orderstatus' => 'pending',
        ]);

        $totalAmount = 0;

        // Create order items and calculate the total amount
        foreach ($request->items as $itemData) {
            $item = Item::find($itemData['itemid']);
            $totalAmount += $item->price * $itemData['qty'];

            OrderItem::create([
                'orderid_fk' => $order->id,
                'itemid_fk' => $item->id,
                'qty' => $itemData['qty'],
                'price' => $item->price,
            ]);
        }

        // Update the total amount for the order
        $order->update(['totalamount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    // View all items
    public function viewItems()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    // View all orders with items
    public function viewOrders()
    {
        $orders = OrderMaster::with('orderItems.item')->get(); // Load items through orderItems relation
        return view('order.index', compact('orders'));
    }

    // Edit order
    public function edit($id)
    {
        $order = OrderMaster::with('orderItems.item')->findOrFail($id); // Load items
        $items = Item::all(); // Get all items for the edit form
        return view('order.edit', compact('order', 'items'));
    }

    // Update order
    public function update(Request $request, $id)
    {
        $request->validate([
            'customername' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'orderdate' => 'required|date',
            'items' => 'required|array',
            'items.*.itemid' => 'required|exists:items,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        $order = OrderMaster::findOrFail($id);

        // Update order master details
        $order->update([
            'customername' => $request->customername,
            'address' => $request->address,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'orderdate' => $request->orderdate,
        ]);

        // Recalculate and update order items
        $totalAmount = 0;
        $order->orderItems()->delete(); // Delete old order items

        foreach ($request->items as $itemData) {
            $item = Item::find($itemData['itemid']);
            $totalAmount += $item->price * $itemData['qty'];

            OrderItem::create([
                'orderid_fk' => $order->id,
                'itemid_fk' => $item->id,
                'qty' => $itemData['qty'],
                'price' => $item->price,
            ]);
        }

        // Update total amount
        $order->update(['totalamount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    // Delete order
    public function destroy($id)
    {
        $order = OrderMaster::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
