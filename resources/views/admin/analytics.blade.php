@extends('layouts.admin')
@section('title', 'Merketar Admin — Analytics')
@section('page-title', 'Analytics')

@section('content')
<div class="row g-3">
    {{-- Monthly Revenue Table --}}
    <div class="col-lg-7">
        <div class="card p-3">
            <h6 class="fw-bold mb-3" style="color:#004494;">Monthly Revenue</h6>
            <div class="table-responsive">
                <table class="table table-sm table-hover" style="font-size:13px;">
                    <thead style="background:#f0f4ff;"><tr><th>Month</th><th>Orders</th><th>Revenue</th></tr></thead>
                    <tbody>
                        @forelse($monthlyOrders as $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($row->month)->format('M Y') }}</td>
                            <td>{{ $row->count }}</td>
                            <td class="fw-semibold">₦{{ number_format($row->revenue,2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">No data yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Top Sellers --}}
    <div class="col-lg-5">
        <div class="card p-3">
            <h6 class="fw-bold mb-3" style="color:#004494;">Top Sellers by Orders</h6>
            @forelse($topSellers as $i => $store)
            <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold" style="color:#004494;min-width:20px;">{{ $i+1 }}.</span>
                    <span style="font-size:13px;">{{ $store->store_name }}</span>
                </div>
                <span class="badge" style="background:#004494;font-size:11px;">{{ $store->orders_count }} orders</span>
            </div>
            @empty
            <p class="text-muted mb-0" style="font-size:13px;">No data yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
