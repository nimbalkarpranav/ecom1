@extends('BackEnd.admin.layout')

@section('content1')
<div class="container py-4">
    <div id="printArea"> <!-- ✅ Start Printable Area -->

        <h2 class="mb-4">🧾 Order #{{ $order->id }} Details</h2>

        <div class="card p-3 mb-4">
            <p><strong>👤 Customer:</strong> {{ $order->name }}</p>
            <p><strong>💰 Total:</strong> ₹{{ $order->order_m_total_price }}</p>
            <p><strong>💳 Payment Method:</strong> {{ $order->payment_method }}</p>
            <p><strong>🕒 Payment Status:</strong> {{ $order->payment_status }}</p>
            <p><strong>📅 Order Date:</strong> {{ $order->order_m_date }}</p>
            <p><strong>📍 Address:</strong> {{ $order->order_m_adderss }}</p>
        </div>

        <h4 class="mb-3">📦 Ordered Products:</h4>
        <table class="table table-bordered"> 
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
                                <img src="{{ asset('assets/storage/' . $item->product->img) }}" width="60">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->oc_master_qut }}</td>
                        <td>₹{{ $item->product->price ?? 'N/A' }}</td>
                        <td>₹{{ $item->oc_total_price }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">No products found for this order.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- ✅ End Printable Area -->

    <button onclick="printSection('printArea')" class="btn btn-primary mb-3">
        🖨️ Print Order Details
    </button>
</div>

<script>
function printSection(id) {
    var content = document.getElementById(id).innerHTML;
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Order</title>');
    printWindow.document.write('<style>body{ font-family: sans-serif; } table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}
</script>
@endsection
