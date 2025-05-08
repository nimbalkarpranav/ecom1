@extends('BackEnd.admin.layout')

@section('title', 'All Orders')

@section('content1')
<div class="container py-4">
        <h2 class="mb-4">All Orders</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>₹{{ number_format($order->order_m_total_price, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->payment_status == 'Paid' ? 'success' : 'warning' }}">
                                    {{ $order->payment_status }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->order_status == 'Delivered' ? 'success' : ($order->order_status == 'Pending' ? 'secondary' : 'info') }}">
                                    {{ $order->order_status }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->order_m_date)->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
