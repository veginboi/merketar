@extends('layouts.auth')
@section('title', 'Merketar Buyer - Personal Details')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center py-5" style="min-height:100vh; background:#f0f4ff;">
    <div class="card p-4 shadow" style="width:100%;max-width:520px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar Logo" style="height:45px;">
            <h4 class="mt-2 fw-bold" style="color:#004494;">Personal Details</h4>
            <small class="text-muted">Step 2 of 2 — Complete your profile</small>
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

        <form action="{{ route('buyer.signup.step2.post') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">First Name *</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Middle Name</label>
                    <input type="text" name="mid_name" class="form-control" value="{{ old('mid_name') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Last Name *</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Code</label>
                    <select name="phone_code" class="form-select">
                        <option value="+234" selected>+234</option>
                    </select>
                </div>
                <div class="col-md-9">
                    <label class="form-label fw-semibold">Phone Number *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="e.g. 08012345678" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Gender *</label>
                    <select name="gender" class="form-select">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Address *</label>
                    <input type="text" name="address_line" class="form-control" value="{{ old('address_line') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">State *</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">City *</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Postal Code *</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', 'Nigeria') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Nationality *</label>
                    <input type="text" name="nationality" class="form-control" value="{{ old('nationality', 'Nigerian') }}" required>
                </div>
            </div>
            <button type="submit" class="btn w-100 mt-4" style="background:#004494;color:#fff;">Create Account</button>
        </form>
    </div>
</div>
@endsection
