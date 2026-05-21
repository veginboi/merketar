@extends('layouts.admin')
@section('title', 'Merketar Admin — Disputes')
@section('page-title', 'Dispute Resolution')

@section('content')
<div class="card p-3">
    @forelse($disputes as $dispute)
    <div class="card mb-3 p-3" style="border-left:4px solid #dc3545;">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
            <div>
                <h6 class="mb-1 fw-bold">Order #{{ $dispute->id }} — {{ $dispute->store->store_name ?? 'N/A' }}</h6>
                <div style="font-size:13px;" class="text-muted">
                    Buyer: <strong>{{ $dispute->buyer->username }}</strong> &nbsp;·&nbsp;
                    Amount: <strong>₦{{ number_format($dispute->total_amount,2) }}</strong> &nbsp;·&nbsp;
                    {{ $dispute->created_at->format('d M Y') }}
                </div>
                @if($dispute->dispute_reason)
                <div class="mt-2 p-2 rounded" style="background:#fff3cd;font-size:12px;">
                    <strong>Reason:</strong> {{ $dispute->dispute_reason }}
                </div>
                @endif
            </div>
            <div class="d-flex gap-2">
                <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="resolution" value="refund">
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Refund buyer for this order?')">Refund Buyer</button>
                </form>
                <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="resolution" value="release">
                    <button class="btn btn-sm btn-outline-success" onclick="return confirm('Release payment to seller?')">Release to Seller</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5 text-muted">
        <svg width="48" height="48" fill="#6c757d" viewBox="0 0 16 16" class="mb-3"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/></svg>
        <p>No active disputes. All good!</p>
    </div>
    @endforelse
    <div class="mt-2">{{ $disputes->links() }}</div>
</div>
@endsection
