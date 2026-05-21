@extends('layouts.admin')
@section('title', 'Merketar Admin — Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label' => 'Total Buyers',     'value' => $stats['total_buyers'],   'bg' => '#dbeafe', 'color' => '#1e40af'],
        ['label' => 'Total Sellers',    'value' => $stats['total_sellers'],  'bg' => '#dcfce7', 'color' => '#166534'],
        ['label' => 'Active Stores',    'value' => $stats['active_stores'],  'bg' => '#f0fdf4', 'color' => '#15803d'],
        ['label' => 'Pending Stores',   'value' => $stats['pending_stores'], 'bg' => '#fef9c3', 'color' => '#854d0e'],
        ['label' => 'Total Orders',     'value' => $stats['total_orders'],   'bg' => '#ede9fe', 'color' => '#5b21b6'],
        ['label' => 'Revenue (NGN)',     'value' => '₦'.number_format($stats['total_revenue'],2), 'bg' => '#fee2e2', 'color' => '#991b1b'],
    ];
    @endphp
    @foreach($cards as $card)
    <div class="col-6 col-md-4 col-xl-2">
        <div class="card stat-card p-3 h-100" style="background:{{ $card['bg'] }};">
            <div class="fw-bold fs-4" style="color:{{ $card['color'] }};">{{ $card['value'] }}</div>
            <div class="text-muted" style="font-size:12px;">{{ $card['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-3">
    {{-- Pending Stores --}}
    <div class="col-lg-6">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold" style="color:#004494;">Pending Store Approvals</h6>
                <a href="{{ route('admin.stores', ['status' => 'pending']) }}" class="btn btn-sm" style="background:#004494;color:#fff;font-size:11px;">View All</a>
            </div>
            @forelse($pendingStores as $store)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <div>
                    <div class="fw-semibold" style="font-size:13px;">{{ $store->store_name }}</div>
                    <div class="text-muted" style="font-size:11px;">{{ $store->seller->username }} · {{ $store->created_at->diffForHumans() }}</div>
                </div>
                <form action="{{ route('admin.stores.approve', $store) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm" style="background:#004494;color:#fff;font-size:11px;">Approve</button>
                </form>
            </div>
            @empty
            <p class="text-muted mb-0" style="font-size:13px;">No pending stores.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="col-lg-6">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold" style="color:#004494;">Recent Orders</h6>
                <a href="{{ route('admin.transactions') }}" class="btn btn-sm" style="background:#004494;color:#fff;font-size:11px;">View All</a>
            </div>
            @forelse($recentOrders as $order)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <div>
                    <div class="fw-semibold" style="font-size:13px;">{{ $order->store->store_name ?? 'N/A' }}</div>
                    <div class="text-muted" style="font-size:11px;">by {{ $order->buyer->username }} · ₦{{ number_format($order->total_amount,2) }}</div>
                </div>
                <span class="badge" style="font-size:10px;background:#004494;">{{ ucfirst($order->status) }}</span>
            </div>
            @empty
            <p class="text-muted mb-0" style="font-size:13px;">No orders yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Active Disputes --}}
    @if($disputes->count())
    <div class="col-12">
        <div class="card p-3 border-danger">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold text-danger">Active Disputes ({{ $disputes->count() }})</h6>
                <a href="{{ route('admin.disputes') }}" class="btn btn-sm btn-outline-danger" style="font-size:11px;">Manage All</a>
            </div>
            @foreach($disputes->take(5) as $dispute)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <div>
                    <div class="fw-semibold" style="font-size:13px;">Order #{{ $dispute->id }} — {{ $dispute->store->store_name ?? 'N/A' }}</div>
                    <div class="text-muted" style="font-size:11px;">Buyer: {{ $dispute->buyer->username }} · ₦{{ number_format($dispute->total_amount,2) }}</div>
                </div>
                <a href="{{ route('admin.disputes') }}" class="btn btn-sm btn-outline-danger" style="font-size:11px;">Resolve</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Recent Users --}}
    <div class="col-12">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold" style="color:#004494;">Recent Signups</h6>
                <a href="{{ route('admin.users') }}" class="btn btn-sm" style="background:#004494;color:#fff;font-size:11px;">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0" style="font-size:13px;">
                    <thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th></tr></thead>
                    <tbody>
                        @foreach($recentUsers as $u)
                        <tr>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td><span class="badge" style="background:#004494;font-size:10px;">{{ ucfirst($u->role) }}</span></td>
                            <td>
                                <span class="badge badge-{{ $u->status }}" style="font-size:10px;">{{ ucfirst($u->status) }}</span>
                            </td>
                            <td>{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
