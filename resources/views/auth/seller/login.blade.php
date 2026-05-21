@extends('layouts.auth')
@section('title', 'Merketar Seller - Login')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:100vh; background:#f0f4ff;">
    <div class="card p-4 shadow" style="width:100%;max-width:420px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar Logo" style="height:45px;">
            <h4 class="mt-2 fw-bold" style="color:#004494;">Seller Login</h4>
        </div>

        @if($errors->any())
        <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('seller.login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Business Name or Email</label>
                <input type="text" name="login" class="form-control" value="{{ old('login') }}" placeholder="Business name or email" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn w-100" style="background:#004494;color:#fff;">Log In</button>
        </form>

        <hr>
        <p class="text-center mb-1" style="font-size:14px;">
            New seller? <a href="{{ route('seller.signup') }}" style="color:#004494;">Register your store</a>
        </p>
        <p class="text-center mb-0" style="font-size:13px;">
            Are you a buyer? <a href="{{ route('buyer.login') }}" style="color:#004494;">Buyer Login</a>
        </p>
    </div>
</div>
@endsection
