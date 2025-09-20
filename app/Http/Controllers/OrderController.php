<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use App\Models\FlutterNotification;
use App\Models\Order;
use App\Models\OrderChild;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\OrderConfirmedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use OrderConfirmed;

class OrderController extends Controller
{
    public function checkout1(Request $request)
    {
        $user = auth()->user();
        $items = json_decode($request->items, true);

        // Store logic for tbl_order_master and tbl_order_child can be added here

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

        foreach ($cart as $id => $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $customerId = auth()->check() ? auth()->user()->id : 0;

        $order = Order::create([
            'name' => $request->name,
            'order_m_customer_id' => $customerId,
            'order_m_total_price' => $total,
            'order_m_adderss' => $request->address,
            'order_m_date' => Carbon::now()->format('Y-m-d'),
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'Pending',
            'order_status' => 'Pending', // Use order_status consistently
        ]);

        foreach ($cart as $id => $item) {
            OrderChild::create([
                'oc_master_id' => $order->id,
                'oc_product_id' => $id,
                'oc_master_qut' => $item['quantity'],
                'oc_total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout')->with('success', '✅ Order placed successfully!');
    }

    public function showOrders()
    {
        $orders = Order::all();
        return view('BackEnd.pages.order', compact('orders'));
    }

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
                'order_status' => 'Pending', // consistent
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





 
public function confirmOrder($id)
{
    $order = Order::findOrFail($id);

    if ($order->order_status !== 'confirmed') {
        $order->order_status = 'confirmed';
        $order->save();

        $message = "✅ Your order #{$order->id} has been confirmed!";

        // Log before broadcasting
         Log::info('Firing OrderConfirmed event for user: ' . $order->user_id);

        event(new \App\Events\OrderConfirmed($order->user_id, $message));
    }

    return redirect()->back()->with('success', 'Order confirmed and user notified.');
}


}
