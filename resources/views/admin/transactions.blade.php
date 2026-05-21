@extends('layouts.admin')
@section('title', 'Merketar Admin — Transactions')
@section('page-title', 'Transactions')

@section('content')
<div class="card p-3">
    <div class="d-flex gap-2 mb-3 flex-wrap">
        @foreach(['all','pending','paid','processing','delivered','completed','disputed','refunded'] as $s)
        <a href="{{ route('admin.transactions', ['status' => $s]) }}" class="btn btn-sm {{ $status === $s ? '' : 'btn-outline-secondary' }}" style="{{ $status === $s ? 'background:#004494;color:#fff;' : '' }}; font-size:11px;">{{ ucfirst($s) }}</a>
        @endforeach
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="font-size:13px;">
            <thead style="background:#f0f4ff;"><tr>
                <th>#</th><th>Buyer</th><th>Store</th><th>Transaction ID</th><th>Amount</th><th>Status</th><th>Date</th>
            </tr></thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->buyer->username ?? 'N/A' }}</td>
                    <td>{{ $order->store->store_name ?? 'N/A' }}</td>
                    <td style="font-size:11px;font-family:monospace;">{{ $order->transaction_id }}</td>
                    <td class="fw-semibold">₦{{ number_format($order->total_amount,2) }}</td>
                    <td><span class="badge" style="background:#004494;font-size:10px;">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('d M Y, g:ia') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No transactions found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2">{{ $orders->withQueryString()->links() }}</div>
</div>
@endsection
