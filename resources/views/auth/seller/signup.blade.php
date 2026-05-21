@extends('layouts.auth')
@section('title', 'Merketar - Register Your Store')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height:100vh; background:#f0f4ff;">
    <div class="card p-4 shadow" style="width:100%;max-width:460px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar Logo" style="height:45px;">
            <h4 class="mt-2 fw-bold" style="color:#004494;">Register as Seller</h4>
            <small class="text-muted">Step 1 of 2 — Business Credentials</small>
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

        <form action="{{ route('seller.signup.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Business Name</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="e.g. Collins Kitchen" required>
                <small class="text-muted">3–25 chars, letters and spaces only.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="business@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Create a strong password" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control" placeholder="Repeat password" required>
            </div>
            <button type="submit" class="btn w-100" style="background:#004494;color:#fff;">Continue →</button>
        </form>

        <hr>
        <p class="text-center mb-0" style="font-size:14px;">
            Already registered? <a href="{{ route('seller.login') }}" style="color:#004494;">Log In</a>
        </p>
    </div>
</div>
@endsection
