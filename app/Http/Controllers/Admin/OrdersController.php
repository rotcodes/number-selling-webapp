<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display the orders management page.
     */
    public function manageOrders()
    {
        // Fetch all purchases with related number and user details
        $orders = Purchase::with(['number', 'user'])->latest()->paginate(8); // 8 records per page

        return view('auth.admin.orders.manage-orders', compact('orders'));
    }

    /**
     * Update the specified order's status.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'order_status' => 'required|in:pending,completed',
        ]);

        // Find the order by ID
        $order = Purchase::findOrFail($id);

        // Update the order status
        $order->order_status = $request->input('order_status');
        $order->save();

        session()->flash('success', 'Order status updated successfully!');
        // Return success response for AJAX
        return response()->json(['status' => true, 'message' => 'Order status updated successfully!']);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        // Find the order by ID
        $order = Purchase::findOrFail($id);

        // Delete the order
        $order->delete();

        session()->flash('success', 'Order deleted successfully!');

        // Return success response for AJAX
        return response()->json(['status' => true, 'message' => 'Order deleted successfully!']);
    }
}
