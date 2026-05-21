@extends('layouts.admin')
@section('title', 'Merketar Admin — Stores')
@section('page-title', 'Store Management')

@section('content')
<div class="card p-3">
    <div class="d-flex gap-2 mb-3 flex-wrap">
        @foreach(['all','pending','active','inactive'] as $s)
        <a href="{{ route('admin.stores', ['status' => $s]) }}" class="btn btn-sm {{ $status === $s ? '' : 'btn-outline-secondary' }}" style="{{ $status === $s ? 'background:#004494;color:#fff;' : '' }}">{{ ucfirst($s) }}</a>
        @endforeach
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="font-size:13px;">
            <thead style="background:#f0f4ff;"><tr>
                <th>#</th><th>Store Name</th><th>Seller</th><th>Address</th><th>Status</th><th>Created</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @forelse($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td class="fw-semibold">{{ $store->store_name }}</td>
                    <td>{{ $store->seller->username ?? 'N/A' }}</td>
                    <td>{{ $store->store_address ?? '—' }}</td>
                    <td><span class="badge badge-{{ $store->store_status }}" style="font-size:10px;">{{ ucfirst($store->store_status) }}</span></td>
                    <td>{{ $store->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            @if($store->store_status === 'pending')
                            <form action="{{ route('admin.stores.approve', $store) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-outline-success" style="font-size:11px;">Approve</button>
                            </form>
                            @endif
                            <form action="{{ route('admin.stores.suspend', $store) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm {{ $store->store_status === 'inactive' ? 'btn-outline-success' : 'btn-outline-warning' }}" style="font-size:11px;">
                                    {{ $store->store_status === 'inactive' ? 'Reactivate' : 'Suspend' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No stores found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2">{{ $stores->withQueryString()->links() }}</div>
</div>
@endsection
