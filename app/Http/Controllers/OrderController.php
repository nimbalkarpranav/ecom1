<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderChild;
use Illuminate\Http\Request;
use App\Models\OrderMaster;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function checkout1(Request $request)
{
    $user = auth()->user();
    $items = json_decode($request->items, true);

    ///Store in tbl_order_master and tbl_order_child
    // Save total, status, etc.

    return response()->json(['message' => 'Order successful']);
}

    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('frantEnd.pages.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $total = 0;

        // Calculate the total price
        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ✅ Fix for customer ID (with or without login)
        $customerId = auth()->check() ? auth()->user()->id : 0;

        // Save the order to the Order Master table
        $order = Order::create([
            'name' => $request->name,
            'order_m_customer_id' => $customerId,
            'order_m_total_price' => $total,
            'order_m_adderss' => $request->address,
            'order_m_date' => Carbon::now()->format('Y-m-d'),
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'Pending',
            'order_status' => 'Pending',
        ]);

        // Save to Order Child table
        foreach ($cart as $id => $item) {
            OrderChild::create([
                'oc_master_id' => $order->id,  // This references the Order Master ID
                'oc_product_id' => $id,         // The product ID
                'oc_master_qut' => $item['quantity'],
                'oc_total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear the cart after order is placed
        session()->forget('cart');

        return redirect()->route('checkout')->with('success', '✅ Order placed successfully!');
    }

    public function showOrders()
{
    // Fetch all orders from tbl_order_master
    $orders = Order::all(); // or OrderMaster::latest()->get(); for latest orders first

    return view('BackEnd.pages.order', compact('orders'));
}
// public function showOrder($id)
// {
//     $order = Order::with('products')->findOrFail($id);
//     return view('BackEnd.pages.showorder', compact('order'));
// }
public function showOrder($id)
{
    $order = Order::with(['products.product'])->findOrFail($id);
    return view('BackEnd.pages.showorder', compact('order'));
}
public function checkoutFromApi(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'address' => 'required|string',
        'phone' => 'required|string',
        'items' => 'required|array',
        'items.*.id' => 'required|integer',
        'items.*.quantity' => 'required|integer',
        'items.*.price' => 'required|numeric',
    ]);

    try {
        $total = 0;

        foreach ($request->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $customerId = auth()->check() ? auth()->id() : 0;

        $order = Order::create([
            'name' => $request->name,
            'order_m_customer_id' => $customerId,
            'order_m_total_price' => $total,
            'order_m_adderss' => $request->address,
            'order_m_date' => now()->format('Y-m-d'),
            'total' => $total,
            'payment_method' => 'COD',
            'payment_status' => 'Pending',
            'order_status' => 'Pending',
        ]);

        foreach ($request->items as $item) {
            OrderChild::create([
                'oc_master_id' => $order->id,
                'oc_product_id' => $item['id'],
                'oc_master_qut' => $item['quantity'],
                'oc_total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully'], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}


}

