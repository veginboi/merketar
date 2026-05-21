@extends('layouts.admin')
@section('title', 'Merketar Admin — Users')
@section('page-title', 'User Management')

@section('content')
<div class="card p-3">
    <div class="d-flex gap-2 mb-3 flex-wrap">
        @foreach(['all','buyer','seller','admin'] as $r)
        <a href="{{ route('admin.users', ['role' => $r]) }}" class="btn btn-sm {{ $role === $r ? '' : 'btn-outline-secondary' }}" style="{{ $role === $r ? 'background:#004494;color:#fff;' : '' }}">{{ ucfirst($r) }}</a>
        @endforeach
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle" style="font-size:13px;">
            <thead style="background:#f0f4ff;"><tr>
                <th>#</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th>Actions</th>
            </tr></thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->username }}</td>
                    <td>{{ $u->email }}</td>
                    <td><span class="badge" style="background:#004494;font-size:10px;">{{ ucfirst($u->role) }}</span></td>
                    <td><span class="badge badge-{{ $u->status }}" style="font-size:10px;">{{ ucfirst($u->status) }}</span></td>
                    <td>{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <form action="{{ route('admin.users.suspend', $u) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm {{ $u->status === 'suspended' ? 'btn-outline-success' : 'btn-outline-warning' }}" style="font-size:11px;">
                                    {{ $u->status === 'suspended' ? 'Reactivate' : 'Suspend' }}
                                </button>
                            </form>
                            @if($u->id !== Auth::id())
                            <form action="{{ route('admin.users.delete', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $u->username }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" style="font-size:11px;">Delete</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-2">{{ $users->withQueryString()->links() }}</div>
</div>
@endsection
