@extends('BackEnd.admin.layout')

@section('content1')
<div class="container py-4">
    <div id="printArea"> <!-- Printable Area -->

        <h2 class="mb-4">🧾 Order #{{ $order->id }} Details</h2>

        <div class="card p-3 mb-4 shadow-sm">
            <p><strong>👤 Customer:</strong> {{ $order->name }}</p>
            <p><strong>💰 Total:</strong> ₹{{ number_format($order->order_m_total_price, 2) }}</p>
            <p><strong>💳 Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>🕒 Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>📅 Order Date:</strong> {{ \Carbon\Carbon::parse($order->order_m_date)->format('d M, Y H:i') }}</p>
            <p><strong>📍 Address:</strong> {{ $order->order_m_adderss }}</p>
            <p><strong>📌 Order Status:</strong>
                <span class="badge bg-{{ $order->status == 'confirmed' ? 'success' : 'warning' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>

        <h4 class="mb-3">📦 Ordered Products:</h4>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Line Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->products as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product Deleted' }}</td>
                        <td>
                            @if (!empty($item->product->img))
                                <img src="{{ asset('assets/storage/' . $item->product->img) }}" alt="Product Image" width="60" style="border-radius: 4px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->oc_master_qut }}</td>
                        <td>₹{{ number_format($item->product->price ?? 0, 2) }}</td>
                        <td>₹{{ number_format($item->oc_total_price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">No products found for this order.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- End Printable Area -->

    <div class="d-flex gap-3 mt-3">
        <button onclick="printSection('printArea')" class="btn btn-primary">
            🖨️ Print Order Details
        </button>

        @if ($order->status != 'confirmed')
<!-- Send Message to All Users -->
<!-- Confirm Order and Send Notification -->
<form action="{{ route('admin.order.confirm', $order->id) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-success">
        ✅ Confirm Order & Notify
    </button>
</form>



        @else
            <span class="btn btn-secondary disabled">Order Already Confirmed</span>
        @endif
    </div>
</div>

<script>
function printSection(id) {
    var content = document.getElementById(id).innerHTML;
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Order</title>');
    printWindow.document.write('<style>body{ font-family: sans-serif; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ccc; padding: 8px; text-align: left; } img { max-width: 60px; border-radius: 4px; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}
</script>
@endsection
