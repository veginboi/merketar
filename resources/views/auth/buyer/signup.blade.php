@extends('layouts.auth')
@section('title', 'Merketar Buyer - Create Account')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:100vh; background:#f0f4ff;">
    <div class="card p-4 shadow" style="width:100%;max-width:460px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar Logo" style="height:45px;">
            <h4 class="mt-2 fw-bold" style="color:#004494;">Create Buyer Account</h4>
            <small class="text-muted">Step 1 of 2 — Account Credentials</small>
        </div>

        @if($errors->any())
        <div class="alert alert-danger py-2">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('buyer.signup.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="e.g. johnbuyer" required>
                <small class="text-muted">3–20 chars, start with a letter, letters & numbers only.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a strong password" required>
                <small class="text-muted">8+ chars, uppercase, lowercase, number & symbol.</small>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control" placeholder="Repeat your password" required>
            </div>
            <button type="submit" class="btn w-100" style="background:#004494;color:#fff;">Continue →</button>
        </form>

        <hr>
        <p class="text-center mb-0" style="font-size:14px;">
            Already have an account? <a href="{{ route('buyer.login') }}" style="color:#004494;">Log In</a>
        </p>
    </div>
</div>
@endsection
