@extends('layouts.auth')
@section('title', 'Merketar Admin - Login')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:100vh;background:#001f4d;">
    <div class="card p-4 shadow-lg" style="width:100%;max-width:400px;border:none;border-radius:12px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar" style="height:42px;">
            <h5 class="mt-2 fw-bold" style="color:#004494;">Admin Panel</h5>
            <small class="text-muted">adm.merketar.com</small>
        </div>

        @if($errors->any())
        <div class="alert alert-danger py-2 text-center" style="font-size:13px;">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:13px;">Username or Email</label>
                <input type="text" name="login" class="form-control" value="{{ old('login') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold" style="font-size:13px;">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn w-100" style="background:#004494;color:#fff;font-weight:600;">Access Admin Panel</button>
        </form>
    </div>
    <p class="mt-3" style="color:rgba(255,255,255,.4);font-size:11px;">©️ 2025 Merketar. Restricted access.</p>
</div>
@endsection
