<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/icons/merketar-favicon.png') }}" type="image/x-icon">
    <title>@yield('title', 'Merketar Admin')</title>
    <style>
        :root { --mk-blue: #004494; --mk-light: #f0f4ff; }
        body { background: #f8f9fa; }
        .admin-sidebar {
            width: 240px; min-height: 100vh; background: var(--mk-blue);
            position: fixed; top: 0; left: 0; z-index: 100; display: flex; flex-direction: column;
        }
        .admin-sidebar .brand { padding: 20px 16px; border-bottom: 1px solid rgba(255,255,255,.15); }
        .admin-sidebar .brand img { height: 36px; filter: brightness(0) invert(1); }
        .admin-sidebar .brand small { display: block; color: rgba(255,255,255,.6); font-size: 11px; margin-top: 2px; }
        .admin-sidebar nav a {
            display: flex; align-items: center; gap: 10px; padding: 12px 20px;
            color: rgba(255,255,255,.75); text-decoration: none; font-size: 14px; transition: .2s;
        }
        .admin-sidebar nav a:hover, .admin-sidebar nav a.active { background: rgba(255,255,255,.12); color: #fff; }
        .admin-sidebar nav a svg { opacity: .8; }
        .admin-content { margin-left: 240px; padding: 24px; }
        .admin-topbar {
            background: #fff; border-bottom: 1px solid #e9ecef;
            padding: 12px 24px; display: flex; justify-content: space-between;
            align-items: center; margin-left: 240px; position: sticky; top: 0; z-index: 99;
        }
        .stat-card { border: none; border-radius: 10px; }
        .stat-card .icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .badge-pending  { background: #fff3cd; color: #856404; }
        .badge-active   { background: #d1e7dd; color: #0f5132; }
        .badge-inactive { background: #f8d7da; color: #842029; }
        .badge-disputed { background: #cff4fc; color: #055160; }
        @media(max-width:768px){
            .admin-sidebar { width: 100%; min-height: auto; position: relative; }
            .admin-content, .admin-topbar { margin-left: 0; }
        }
    </style>
    @stack('head')
</head>
<body>

<div class="admin-sidebar">
    <div class="brand">
        <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar">
        <small>Admin Panel</small>
    </div>
    <nav class="flex-grow-1 py-2">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.517z"/><path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.63A7 7 0 0 0 8 3"/></svg>
            Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
            Users
        </a>
        <a href="{{ route('admin.stores') }}" class="{{ request()->routeIs('admin.stores*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/></svg>
            Stores
        </a>
        <a href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/></svg>
            Transactions
        </a>
        <a href="{{ route('admin.disputes') }}" class="{{ request()->routeIs('admin.disputes*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>
            Disputes
        </a>
        <a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/></svg>
            Analytics
        </a>
    </nav>
    <div class="p-3" style="border-top:1px solid rgba(255,255,255,.15);">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-sm w-100" style="background:rgba(255,255,255,.1);color:#fff;border:1px solid rgba(255,255,255,.2);">Logout</button>
        </form>
    </div>
</div>

<div class="admin-topbar">
    <span class="fw-semibold" style="color:#004494;">@yield('page-title', 'Dashboard')</span>
    <span class="text-muted" style="font-size:13px;">Logged in as <strong>{{ Auth::user()->username }}</strong></span>
</div>

<div class="admin-content">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show py-2">{{ $errors->first() }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
