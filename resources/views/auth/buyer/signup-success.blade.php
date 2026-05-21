@extends('layouts.auth')
@section('title', 'Account Created!')
@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh; background:#f0f4ff;">
    <div class="text-center card p-5 shadow" style="max-width:420px;">
        <img src="{{ asset('assets/icons/check-circle.svg') }}" alt="Success" style="width:60px;" class="mx-auto mb-3">
        <h2 style="color:#004494;">Account Created!</h2>
        <p class="text-muted">Welcome to Merketar. Your buyer account is ready.</p>
        <a href="{{ route('buyer.login') }}" class="btn mt-3" style="background:#004494;color:#fff;">Log In Now</a>
    </div>
</div>
@endsection
