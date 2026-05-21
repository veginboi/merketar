@extends('layouts.buyer')
@section('title', 'Merketar Buyer - Naija Market in Your Pocket')

@section('content')

    {{-- Buyer Header - Big Screen --}}
    <header id="header-big-screen" class="d-flex justify-content-between align-items-center px-5" style="max-height:80px;padding:20px;border-bottom:0.2px solid #004494;">
        <div class="logo" style="min-width:125px;height:100%;margin-right:10px;">
            <img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar Logo">
        </div>
        <div class="d-flex align-items-center justify-content-between" style="min-width:570px;width:1000px;gap:20px;">
            <nav class="d-flex justify-content-between" style="min-width:400px;width:650px;">
                <a class="header-navlink active" href="#home">Home</a>
                <a class="header-navlink" href="#profile">Profile</a>
                <a class="header-navlink" href="#market">Market</a>
                <a class="header-navlink" href="#purchases">Purchases</a>
                <a class="header-navlink" href="#contact">Contact</a>
                <a class="header-navlink" href="#faq">FAQ</a>
                <a class="header-navlink" href="#more">More</a>
            </nav>
            <a href="{{ route('buyer.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img src="{{ asset('uploads/profilePicture/' . $user->picture) }}" alt="Profile" class="profile-pic">
                <span class="profile-fullname">{{ session('username', $user->username) }}</span>
            </a>
        </div>
    </header>

    {{-- Buyer Header - Small Screen --}}
    <header id="header-small-screen" class="container-fluid" style="border-bottom:1px solid #004494;padding:15px 20px;">
        <div class="row align-items-center justify-content-between">
            <div class="col-6"><img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar" style="height:35px;"></div>
            <div class="col-6 d-flex justify-content-end">
                <a href="#profile" class="text-decoration-none d-flex align-items-center gap-2">
                    <img src="{{ asset('uploads/profilePicture/' . $user->picture) }}" alt="Profile" class="profile-pic">
                    <span class="d-none d-md-block">{{ $user->username }}</span>
                </a>
            </div>
        </div>
        <div class="row align-items-center mt-2">
            <div class="col d-flex gap-2">
                <a class="header-navlink active" href="#home">Home</a>
                <a class="header-navlink" href="#profile">Profile</a>
                <a class="header-navlink" href="#market">Market</a>
            </div>
            <div class="col-auto">
                <div class="dropdown">
                    <button class="btn btn-light border-0" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#0056B3" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="z-index:99999;">
                        <li><a class="dropdown-item" href="#purchases">Purchases</a></li>
                        <li><a class="dropdown-item" href="#contact">Contact</a></li>
                        <li><a class="dropdown-item" href="#faq">FAQ</a></li>
                        <li><a class="dropdown-item" href="#more">More</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('buyer.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    {{-- Buyer Main --}}
    <main class="w-100 main active" style="flex:1;">

        {{-- Home Section --}}
        <section class="section active" id="home">
            <div class="home-wrap">

                {{-- ── Carousel ─────────────────────────────────────── --}}
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3"></button>
                    </div>
                    <div class="carousel-inner rounded-4 overflow-hidden">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/slides/Property 1=Default.png') }}" class="d-block w-100 carousel-img" alt="">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Shop Fresh, Shop Smart</h1>
                                <p class="sub-cap">Get farm-fresh food and trending products delivered straight to your doorstep.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#market" data-target="market">Browse Categories</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#market" data-target="market">Start Shopping</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant2.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Buy From Verified Sellers</h1>
                                <p class="sub-cap">Explore trusted sellers offering quality goods around you.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#market" data-target="market">Find Sellers</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#market" data-target="market">View Map</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant3.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Safe &amp; Secure Transaction</h1>
                                <p class="sub-cap">Every purchase is protected with Merketar's secure payment system.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#faq" data-target="faq">Learn More</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#market" data-target="market">Shop Now</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant4.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Shop, Trade &amp; Connect</h1>
                                <p class="sub-cap">Be part of a growing community of buyers and sellers making trade easier.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#more" data-target="more">Invite &amp; Earn</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#more" data-target="more">Explore Deals</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev" style="width:70px;">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next" style="width:70px;">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                {{-- ── News ticker ───────────────────────────────────── --}}
                <div class="ticker seamless" aria-label="News ticker">
                    <div class="ticker__track">
                        <div class="ticker__group">
                            <span class="ticker__item">⚡ Merketar is live — explore sellers near you</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">New arrivals every week</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Free delivery on orders over ₦10,000</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Verified sellers, secure payments</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">⚡ Merketar is live — explore sellers near you</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">New arrivals every week</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Free delivery on orders over ₦10,000</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Verified sellers, secure payments</span>
                            <span class="ticker__sep">•</span>
                        </div>
                    </div>
                </div>

                {{-- ── Category quick-links ─────────────────────────── --}}
                <div class="home-block">
                    <div class="home-cats-scroll">
                        @php
                            $cats = [
                                ['icon'=>'🥦','label'=>'Fresh Food'],
                                ['icon'=>'👗','label'=>'Fashion'],
                                ['icon'=>'📱','label'=>'Electronics'],
                                ['icon'=>'🏠','label'=>'Home & Living'],
                                ['icon'=>'💊','label'=>'Health & Beauty'],
                                ['icon'=>'📚','label'=>'Books'],
                                ['icon'=>'🚗','label'=>'Auto Parts'],
                                ['icon'=>'🧸','label'=>'Toys & Kids'],
                                ['icon'=>'⚽','label'=>'Sports'],
                                ['icon'=>'🐾','label'=>'Pet Supplies'],
                                ['icon'=>'🛠️','label'=>'Hardware'],
                                ['icon'=>'🎶','label'=>'Music & Arts'],
                            ];
                        @endphp
                        @foreach($cats as $cat)
                        <a href="#market" data-target="market" class="home-cat-pill text-decoration-none">
                            <span class="home-cat-icon">{{ $cat['icon'] }}</span>
                            <span class="home-cat-label">{{ $cat['label'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- ── Flash deals banner ───────────────────────────── --}}
                <div class="home-block">
                    <div class="home-flash-banner">
                        <div class="home-flash-left">
                            <span class="home-flash-badge">⚡ Flash Deal</span>
                            <h3>Up to <strong>40% OFF</strong> on selected stores</h3>
                            <p>Limited time — grab it before it's gone</p>
                            <a href="#market" data-target="market" class="home-flash-btn">Shop Now</a>
                        </div>
                        <div class="home-flash-right">
                            <div class="home-flash-label">Ends in</div>
                            <div class="home-countdown" id="homeCountdown">
                                <div class="home-cd-block"><span id="cdH">00</span><small>hrs</small></div>
                                <div class="home-cd-sep">:</div>
                                <div class="home-cd-block"><span id="cdM">00</span><small>min</small></div>
                                <div class="home-cd-sep">:</div>
                                <div class="home-cd-block"><span id="cdS">00</span><small>sec</small></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── Nearby sellers ────────────────────────────────── --}}
                @if($sellers->count())
                <div class="home-block">
                    <div class="home-section-head">
                        <h4>Nearby Sellers</h4>
                        <a href="#market" data-target="market" class="home-see-all">See all on map →</a>
                    </div>
                    <div class="home-sellers-scroll">
                        @foreach($sellers as $seller)
                        <div class="home-seller-card">
                            <div class="home-seller-cover">
                                <img src="{{ asset('assets/images/default.png') }}" alt="{{ $seller['store_name'] }}">
                            </div>
                            <div class="home-seller-info">
                                <div class="home-seller-name">{{ $seller['store_name'] }}</div>
                                @if($seller['address'])
                                <div class="home-seller-addr">📍 {{ Str::limit($seller['address'], 32) }}</div>
                                @endif
                                <a href="#market" data-target="market" class="home-seller-visit">Visit Store</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- ── Trending products ────────────────────────────── --}}
                <div class="home-block">
                    <div class="home-section-head">
                        <h4>Trending Products</h4>
                        <a href="#market" data-target="market" class="home-see-all">Browse all →</a>
                    </div>
                    @if($trendingProducts->count())
                    <div class="home-products-grid">
                        @foreach($trendingProducts as $product)
                        @php
                            $thumb = $product->images->first()->image_url
                                ?? ($product->picture !== 'defaultL.jpg' ? $product->picture : null);
                        @endphp
                        <div class="home-product-card">
                            <div class="home-product-img">
                                @if($thumb)
                                    <img src="{{ asset('uploads/products/picture/' . $thumb) }}" alt="{{ $product->name }}"
                                         onerror="this.src='{{ asset('assets/images/default.png') }}'">
                                @else
                                    <img src="{{ asset('assets/images/default.png') }}" alt="{{ $product->name }}">
                                @endif
                            </div>
                            <div class="home-product-body">
                                <div class="home-product-name">{{ Str::limit($product->name, 30) }}</div>
                                <div class="home-product-store">{{ $product->store->store_name ?? '' }}</div>
                                <div class="home-product-price">₦{{ number_format($product->price) }}</div>
                                <button class="home-product-btn" data-target="market">View in Store</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted text-center py-4">No products listed yet — check back soon.</p>
                    @endif
                </div>

            </div>
        </section>

        {{-- Profile Section --}}
        <section id="profile" class="section">
            <div class="bpro-wrap">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-4 mt-3 py-2" role="alert" style="font-size:13px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                {{-- ── Header card ─────────────────────────────── --}}
                <div class="bpro-header-card">
                    <div class="bpro-avatar-wrap">
                        <form action="{{ route('buyer.upload.picture') }}" method="POST" enctype="multipart/form-data" id="ppForm">
                            @csrf
                            <label for="ppInput" class="bpro-avatar-label">
                                <img src="{{ asset('uploads/profilePicture/' . $user->picture) }}"
                                     alt="Profile" class="bpro-avatar"
                                     onerror="this.src='{{ asset('assets/images/default.png') }}'">
                                <div class="bpro-avatar-overlay">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 16 16">
                                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 0 2.828 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"/>
                                    </svg>
                                </div>
                            </label>
                            <input type="file" id="ppInput" name="picture" class="d-none" accept="image/*"
                                   onchange="document.getElementById('ppForm').submit()">
                        </form>
                    </div>
                    <div class="bpro-header-info">
                        <div class="bpro-fullname">
                            {{ trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? '')) ?: $user->username }}
                        </div>
                        <div class="bpro-username">@{{ $user->username }}</div>
                        <div class="d-flex align-items-center gap-2 flex-wrap mt-1">
                            <span class="bpro-badge bpro-badge-role">{{ ucfirst($user->role) }}</span>
                            <span class="bpro-badge {{ $user->status === 'active' ? 'bpro-badge-active' : 'bpro-badge-inactive' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                            <span class="bpro-badge bpro-badge-date">
                                Member since {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                    <button class="bpro-edit-trigger" data-bs-toggle="modal" data-bs-target="#editProfileModal"
                            title="Edit profile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#004494" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>
                    </button>
                </div>

                {{-- ── Wallet card ──────────────────────────────── --}}
                <div class="bpro-wallet-card">
                    <div class="bpro-wallet-top">
                        <div>
                            <div class="bpro-wallet-label">Merketar Wallet</div>
                            <div class="bpro-wallet-accnum">
                                {{ $account->account_number ?? 'Not assigned' }}
                                <span class="bpro-wallet-status {{ ($account->account_status ?? '') === 'active' ? 'ws-active' : 'ws-other' }}">
                                    {{ ucfirst($account->account_status ?? 'inactive') }}
                                </span>
                            </div>
                        </div>
                        <div class="bpro-wallet-bal-wrap">
                            <span class="bpro-wallet-cur">{{ $account->currency ?? 'NGN' }}</span>
                            <span class="bpro-wallet-bal" id="balance">{{ number_format($account->balance ?? 0, 2) }}</span>
                            <button class="bpro-bal-eye" id="balanceBtn" type="button" title="Toggle balance">
                                <img src="{{ asset('assets/icons/eye-slash-fill.svg') }}" id="balance-visibility" width="18" alt="toggle">
                            </button>
                        </div>
                    </div>
                    <div class="bpro-wallet-actions">
                        <button class="bpro-wact">
                            <span class="bpro-wact-icon">⬇️</span>Deposit
                        </button>
                        <button class="bpro-wact">
                            <span class="bpro-wact-icon">📤</span>Send
                        </button>
                        <button class="bpro-wact">
                            <span class="bpro-wact-icon">📱</span>Recharge
                        </button>
                        <button class="bpro-wact">
                            <span class="bpro-wact-icon">💳</span>Pay
                        </button>
                        <button class="bpro-wact">
                            <span class="bpro-wact-icon">•••</span>More
                        </button>
                    </div>
                </div>

                {{-- ── Personal details ─────────────────────────── --}}
                <div class="bpro-details-card">
                    <div class="bpro-card-head">
                        <span>Personal Details</span>
                        <button class="bpro-edit-trigger" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit</button>
                    </div>
                    <div class="bpro-details-grid">
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Full name</span>
                            <span class="bpro-detail-val">
                                {{ trim(($profile->first_name ?? '') . ' ' . ($profile->middle_name ?? '') . ' ' . ($profile->last_name ?? '')) ?: '—' }}
                            </span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Email</span>
                            <span class="bpro-detail-val">{{ $user->email }}</span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Phone</span>
                            <span class="bpro-detail-val">
                                {{ $profile && $profile->phone_number ? ($profile->phone_code ?? '') . ' ' . $profile->phone_number : '—' }}
                            </span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Gender</span>
                            <span class="bpro-detail-val">{{ $profile->gender ? ucfirst($profile->gender) : '—' }}</span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Date of birth</span>
                            <span class="bpro-detail-val">
                                {{ $profile && $profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d M Y') : '—' }}
                            </span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Location</span>
                            <span class="bpro-detail-val">
                                {{ collect([$profile->city ?? null, $profile->state ?? null, $profile->country ?? null])->filter()->implode(', ') ?: '—' }}
                            </span>
                        </div>
                        <div class="bpro-detail-row">
                            <span class="bpro-detail-lbl">Address</span>
                            <span class="bpro-detail-val">{{ $profile->address_line ?? '—' }}</span>
                        </div>
                    </div>
                </div>

                {{-- ── Recent purchases ─────────────────────────── --}}
                <div class="bpro-details-card">
                    <div class="bpro-card-head">
                        <span>Recent Purchases</span>
                        <a href="#purchases" data-target="purchases" class="bpro-see-all">See all →</a>
                    </div>
                    @forelse($recentOrders as $order)
                    @php
                        $stages = ['pending'=>0,'processing'=>1,'shipped'=>2,'delivered'=>3,'completed'=>3];
                        $step   = $stages[$order->status] ?? 0;
                    @endphp
                    <div class="bpro-order-row">
                        <div class="bpro-order-top">
                            <span class="bpro-order-store">{{ $order->store->store_name ?? 'Unknown Store' }}</span>
                            <span class="bpro-order-time">{{ $order->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="bpro-order-track">
                            <div class="bpro-track-step {{ $step >= 0 ? 'done' : '' }}">
                                <div class="bpro-track-dot"></div><span>Placed</span>
                            </div>
                            <div class="bpro-track-line {{ $step >= 1 ? 'done' : '' }}"></div>
                            <div class="bpro-track-step {{ $step >= 1 ? 'done' : '' }}">
                                <div class="bpro-track-dot"></div><span>Processing</span>
                            </div>
                            <div class="bpro-track-line {{ $step >= 2 ? 'done' : '' }}"></div>
                            <div class="bpro-track-step {{ $step >= 2 ? 'done' : '' }}">
                                <div class="bpro-track-dot"></div><span>Shipped</span>
                            </div>
                            <div class="bpro-track-line {{ $step >= 3 ? 'done' : '' }}"></div>
                            <div class="bpro-track-step {{ $step >= 3 ? 'done' : '' }}">
                                <div class="bpro-track-dot"></div><span>Delivered</span>
                            </div>
                        </div>
                        @if($order->total_amount)
                        <div class="bpro-order-amount">₦{{ number_format($order->total_amount, 2) }}</div>
                        @endif
                    </div>
                    @empty
                    <p class="text-muted text-center py-3" style="font-size:13px;">No purchases yet.</p>
                    @endforelse
                </div>

                {{-- ── Logout ───────────────────────────────────── --}}
                <div class="bpro-logout-wrap">
                    <form action="{{ route('buyer.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bpro-logout-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>

            </div>

            {{-- ── Edit Profile Modal ───────────────────────────── --}}
            <div class="modal fade" id="editProfileModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content rounded-4">
                        <div class="modal-header border-0 pb-0" style="background:#004494;">
                            <h5 class="modal-title text-white">Edit Profile</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body pt-3">
                            <form action="{{ route('buyer.profile.update') }}" method="POST" id="editProfileForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-6">
                                        <label class="form-label bpro-form-lbl">First name</label>
                                        <input type="text" name="first_name" class="form-control"
                                               value="{{ old('first_name', $profile->first_name ?? '') }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label bpro-form-lbl">Last name</label>
                                        <input type="text" name="last_name" class="form-control"
                                               value="{{ old('last_name', $profile->last_name ?? '') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label bpro-form-lbl">Phone number</label>
                                        <div class="input-group">
                                            <input type="text" name="phone_code" class="form-control" style="max-width:80px;"
                                                   placeholder="+234" value="{{ old('phone_code', $profile->phone_code ?? '+234') }}">
                                            <input type="text" name="phone_number" class="form-control"
                                                   placeholder="08012345678" value="{{ old('phone_number', $profile->phone_number ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label bpro-form-lbl">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="">— Select —</option>
                                            <option value="male"   {{ ($profile->gender ?? '') === 'male'   ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ ($profile->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other"  {{ ($profile->gender ?? '') === 'other'  ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label bpro-form-lbl">Date of birth</label>
                                        <input type="date" name="date_of_birth" class="form-control"
                                               value="{{ old('date_of_birth', optional($profile)->date_of_birth) }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label bpro-form-lbl">Address</label>
                                        <input type="text" name="address_line" class="form-control"
                                               placeholder="Street address" value="{{ old('address_line', $profile->address_line ?? '') }}">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label bpro-form-lbl">City</label>
                                        <input type="text" name="city" class="form-control"
                                               value="{{ old('city', $profile->city ?? '') }}">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label bpro-form-lbl">State</label>
                                        <input type="text" name="state" class="form-control"
                                               value="{{ old('state', $profile->state ?? '') }}">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label bpro-form-lbl">Country</label>
                                        <input type="text" name="country" class="form-control"
                                               value="{{ old('country', $profile->country ?? 'Nigeria') }}">
                                    </div>
                                </div>
                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary flex-grow-1" style="background:#004494;border:none;border-radius:10px;">
                                        Save Changes
                                    </button>
                                    <button type="button" class="btn btn-light flex-grow-1 border rounded-3" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- Market Section --}}
        <section id="market" class="section" style="height:100%;">
            <div class="d-flex flex-column align-items-center px-5 mb-3 map-section w-100" style="gap:10px;padding:20px;height:100%;overflow-x:hidden;">
                <div class="d-flex align-items-center justify-content-between market-section-top w-100">
                    <button class="border-0 market-menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button>
                    <div class="d-flex search-bar align-items-center">
                        <div class="search-contain d-flex justify-content-center align-items-center">
                            <img src="{{ asset('assets/icons/search.svg') }}" alt="Search" width="18">
                        </div>
                        <form action="" class="w-100">
                            <input type="text" id="searchBar" name="searchBar" placeholder="Search...">
                        </form>
                    </div>
                    <button class="border-0 toggle-mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-toggle-on" id="toggle-mode" viewBox="0 0 16 16">
                            <path d="M5 3a5 5 0 0 0 0 10h6a5 5 0 0 0 0-10zm6 9a4 4 0 1 1 0-8 4 4 0 0 1 0 8" />
                        </svg>
                    </button>
                </div>
                <div class="d-flex w-100 h-100 position-relative overflow-hidden">
                    <aside class="market-sidebar collapsed left" id="cartSidebar">
                        <div class="market-sidebar-header">
                            <h3>🛒 Cart</h3>
                            <button class="collapse-btn" id="collapseCart">«</button>
                        </div>
                        <div class="market-sidebar-content"></div>
                    </aside>
                    <div id="marketAreaMap" class="w-100"></div>
                    <aside class="market-sidebar collapsed right" id="sellerSidebar">
                        <div class="market-sidebar-header">
                            <h3>📦 Seller Categories</h3>
                            <button class="collapse-btn" id="collapseSeller">»</button>
                        </div>
                        <div class="market-sidebar-content"></div>
                    </aside>
                </div>
            </div>
        </section>

        {{-- Purchases Section --}}
        <section id="purchases" class="section">
            <div class="d-flex flex-column px-5 py-4 mb-3 gap-3 history-contain">
                <div class="history"><span>Purchase History</span></div>
                <hr style="border:1px solid #004494;">
                @forelse($allOrders as $order)
                <div class="history-container">
                    <div class="flex-grow-1">
                        <div class="initial w-100">
                            <div class="d-flex align-items-center gap-2 seller-profile">
                                <span class="purchase-fullname">{{ $order->store->store_name ?? 'Unknown' }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-around align-items-center progress-bar">
                                <span>Purchased</span>
                                <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                <span>Processing</span>
                                <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                <span>Delivered</span>
                            </div>
                            <div class="d-flex gap-2 d-t">
                                <span>{{ $order->created_at->format('d/m/y') }}</span>
                                <span>{{ $order->created_at->format('g:ia') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <span style="color:#004494;">No purchases yet.</span>
                @endforelse
            </div>
        </section>

        {{-- Contact Section --}}
        <section id="contact" class="section h-100 w-100">
            <div class="d-flex justify-content-center align-items-center h-100">
                <form action="" class="d-flex flex-column align-items-center justify-content-center contact-form">
                    <h1>Contact Form</h1>
                    <div class="d-flex flex-column align-items-center justify-content-center gap-3 w-100">
                        <label for="fullname" class="d-flex align-items-start gap-4 w-100">
                            <span>Full Name:</span>
                            <input type="text" name="fullname" id="fullname" placeholder="Firstname Middle Lastname" required>
                        </label>
                        <label for="c_email" class="d-flex align-items-start gap-4 w-100">
                            <span>Email:</span>
                            <input type="email" name="email" id="c_email" placeholder="Email" required>
                        </label>
                        <label for="phone" class="d-flex align-items-start gap-4 w-100">
                            <span>Phone:</span>
                            <input type="text" name="phone" id="phone" placeholder="Phone" required>
                        </label>
                        <label for="message" class="d-flex align-items-start gap-4 w-100">
                            <span>Message:</span>
                            <textarea name="message" id="message" placeholder="Write your message here..." required></textarea>
                        </label>
                        <button type="submit" name="send" class="pri-btn border-0" data-target="contactSalutary">Send</button>
                    </div>
                </form>
            </div>
        </section>

        {{-- FAQ Section --}}
        <section id="faq" class="section">
            <div class="p-5 d-flex flex-column gap-4 faq-container-list">
                @php
                $faqs = [
                    ['q' => 'How do I find sellers near me?', 'a' => 'Merketar uses a digital map showing approved sellers around your location. Verified sellers appear as icons — click one to view their categories and products.'],
                    ['q' => 'Can I trust the sellers on the platform?', 'a' => 'Yes. Every seller goes through registration and approval before appearing on the map. Buyer Protection policies also ensure your transactions are safe.'],
                    ['q' => 'How do I add products to my cart?', 'a' => 'Click a seller → select a category → choose a product → click "Add to Cart." You can review, edit, or remove items from the cart anytime.'],
                    ['q' => 'Can I buy from multiple sellers at once?', 'a' => 'Yes. Your cart is divided by seller sections, and you can checkout with one seller or all sellers together.'],
                    ['q' => 'How do I track my orders?', 'a' => 'Check your Purchase History to see seller name, amount, date, and order status: Paid → Processing → Delivered.'],
                    ['q' => 'What if I don\'t receive my item?', 'a' => 'If your order isn\'t delivered within the expected time, you can open a dispute and request a refund through Buyer Protection.'],
                    ['q' => 'How do I access my account settings?', 'a' => 'Go to your Profile section and click the gear icon.'],
                ];
                @endphp
                @foreach($faqs as $i => $faq)
                <div class="main-faq align-items-center justify-content-center w-100">
                    <input type="checkbox" name="Dropdown" id="faq-toggle{{ $i }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <span class="num">{{ $i + 1 }}.</span>
                            <span class="question">{{ $faq['q'] }}</span>
                        </div>
                        <label for="faq-toggle{{ $i }}" style="border:none;"><img src="{{ asset('assets/icons/Expand.svg') }}" alt="expand"></label>
                    </div>
                    <div class="main-dd">
                        <div class="d-flex gap-2">
                            <span class="answer-placeholder">Answer:</span>
                            <span class="answer">{{ $faq['a'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- More Section --}}
        <section id="more" class="section">
            <div class="more-container d-flex flex-column gap-2 px-5 py-4">
                <div class="more-sublink-container py-4">
                    <div class="d-flex flex-wrap gap-4 justify-content-center more-sublink px-3">
                        @foreach(['Deals','Wishlist','Notification','Cart','Blog','Community','About Us','Help Center','Invite & Earn','Gift Cards','Best Sellers','New Arrivals','Saved Searches','Events & Promotions','Settings','Purchase History'] as $link)
                        <button class="border-0"><a class="pri-btn more-btn">{{ $link }}</a></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- Footer --}}
    <footer style="border-top:0.2px solid #004494;">
        <div id="footer" class="footer-container d-flex flex-wrap justify-content-between align-items-center px-5 py-3">
            <div class="logo d-none d-md-block" style="width:125px;"><img src="{{ asset('assets/images/slides/HDlogo.png') }}" alt="Merketar"></div>
            <div class="d-flex flex-wrap justify-content-center gap-3 social-links">
                <a>Instagram merketar.com</a>
                <a>Facebook merketar.com</a>
                <a>Twitter merketar.com</a>
            </div>
        </div>
        <p class="w-100 text-center mt-0 mb-0" style="font-size:9px;color:#6c757d;">©️ 2025 Merketar. Naija Market in Your Pocket.</p>
    </footer>

@push('scripts')
<script>
// ── Flash-deal countdown (resets every 24 h) ─────────────────
(function () {
    const now   = new Date();
    const end   = new Date(now);
    end.setHours(23, 59, 59, 999);          // counts to midnight each day

    function tick() {
        const diff = Math.max(0, end - Date.now());
        const h  = Math.floor(diff / 3600000);
        const m  = Math.floor((diff % 3600000) / 60000);
        const s  = Math.floor((diff % 60000)   / 1000);
        const pad = n => String(n).padStart(2, '0');
        const cdH = document.getElementById('cdH');
        const cdM = document.getElementById('cdM');
        const cdS = document.getElementById('cdS');
        if (cdH) cdH.textContent = pad(h);
        if (cdM) cdM.textContent = pad(m);
        if (cdS) cdS.textContent = pad(s);
    }

    tick();
    setInterval(tick, 1000);
})();

// ── "View in Store" product buttons → go to market section ───
document.querySelectorAll('.home-product-btn[data-target]').forEach(btn => {
    btn.addEventListener('click', () => {
        const targetId = btn.dataset.target;
        const target = document.getElementById(targetId);
        if (!target) return;
        document.querySelectorAll('.section.active').forEach(s => s.classList.remove('active'));
        target.classList.add('active');
        sessionStorage.setItem('activeSection', targetId);
    });
});
</script>
@endpush

@endsection
