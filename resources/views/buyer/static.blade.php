@extends('layouts.auth')
@section('title', 'Merketar - Naija Market in Your Pocket')
@section('content')
<div id="body" class="d-flex flex-column w-100" style="height:100vh;">
    <header class="d-flex justify-content-between align-items-center px-5" style="max-height:80px;padding:20px;border-bottom:1px solid #004494;">
        <div class="logo" style="min-width:125px;"><img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar"></div>
        <div class="d-flex gap-3">
            <a href="{{ route('buyer.signup') }}" class="pri-btn">Get Started</a>
            <a href="{{ route('buyer.login') }}" class="sec-btn">Log In</a>
        </div>
    </header>
    <main class="d-flex flex-column align-items-center justify-content-center flex-grow-1 px-5 text-center">
        <h1 style="color:#004494;font-weight:700;">Naija Market in Your Pocket</h1>
        <p class="lead text-muted">Connect with verified sellers near you, shop securely, and confirm delivery before payment is released.</p>
        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('buyer.signup') }}" class="btn btn-lg pri-btn" style="background:#004494;color:#fff;">Get Started as Buyer</a>
            <a href="{{ route('seller.signup') }}" class="btn btn-lg sec-btn" style="border:1px solid #004494;color:#004494;">Register as Seller</a>
        </div>
    </main>
    <footer class="text-center py-3" style="font-size:11px;color:#6c757d;border-top:1px solid #eee;">
        ©️ 2025 Merketar. Naija Market in Your Pocket.
    </footer>
</div>
@endsection
