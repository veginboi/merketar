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
            <div class="purch-wrap">

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0 py-2" role="alert" style="font-size:13px;border-radius:0;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                {{-- ── Header + stats ──────────────────────────── --}}
                <div class="purch-header">
                    <div>
                        <h4 class="purch-title">Purchase History</h4>
                        <p class="purch-sub">{{ $allOrders->count() }} order{{ $allOrders->count() !== 1 ? 's' : '' }}
                            · ₦{{ number_format($allOrders->sum('total_amount'), 2) }} total spent</p>
                    </div>
                    <div class="purch-search-wrap">
                        <input type="text" id="purchSearch" placeholder="Search store or order ID…" class="purch-search">
                    </div>
                </div>

                {{-- ── Status tabs ─────────────────────────────── --}}
                <div class="purch-tabs" id="purchTabs">
                    <button class="purch-tab active" data-filter="all">All</button>
                    <button class="purch-tab" data-filter="pending">Pending</button>
                    <button class="purch-tab" data-filter="processing">Processing</button>
                    <button class="purch-tab" data-filter="delivered">Delivered</button>
                    <button class="purch-tab" data-filter="completed">Completed</button>
                    <button class="purch-tab" data-filter="disputed">Disputes</button>
                    <button class="purch-tab" data-filter="refunded">Refunded</button>
                </div>

                {{-- ── Order list ───────────────────────────────── --}}
                <div class="purch-list" id="purchList">

                @forelse($allOrders as $order)
                @php
                    $statusStep = match($order->status) {
                        'pending'    => 0,
                        'paid'       => 1,
                        'processing' => 2,
                        'delivered','completed' => 3,
                        default      => 0,
                    };
                    $statusColor = match($order->status) {
                        'pending'    => 'purch-s-pending',
                        'paid'       => 'purch-s-paid',
                        'processing' => 'purch-s-processing',
                        'delivered'  => 'purch-s-delivered',
                        'completed'  => 'purch-s-completed',
                        'disputed'   => 'purch-s-disputed',
                        'refunded'   => 'purch-s-refunded',
                        default      => 'purch-s-pending',
                    };
                    $itemNames = $order->items->take(2)->map(fn($i) => $i->product->name ?? 'Item')->implode(', ');
                    $extra     = $order->items->count() > 2 ? ' +' . ($order->items->count() - 2) . ' more' : '';
                @endphp

                <div class="purch-card" data-status="{{ $order->status }}" data-search="{{ strtolower($order->store->store_name ?? '') }} {{ strtolower($order->transaction_id) }}">

                    {{-- Card header --}}
                    <div class="purch-card-head">
                        <div class="purch-store-info">
                            <div class="purch-store-avatar">
                                {{ strtoupper(substr($order->store->store_name ?? 'S', 0, 1)) }}
                            </div>
                            <div>
                                <div class="purch-store-name">{{ $order->store->store_name ?? 'Unknown Store' }}</div>
                                <div class="purch-txn-id">#{{ $order->transaction_id }}</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end gap-1">
                            <span class="purch-status-badge {{ $statusColor }}">{{ ucfirst($order->status) }}</span>
                            <span class="purch-date">{{ $order->created_at->format('d M Y, g:ia') }}</span>
                        </div>
                    </div>

                    {{-- Items preview --}}
                    <div class="purch-items-preview">
                        {{ $itemNames }}{{ $extra }}
                    </div>

                    {{-- Progress tracker --}}
                    @if(!in_array($order->status, ['disputed','refunded']))
                    <div class="purch-tracker">
                        @foreach(['Placed','Paid','Processing','Delivered'] as $si => $sl)
                        <div class="purch-track-step {{ $statusStep >= $si ? 'done' : '' }}">
                            <div class="purch-track-dot"></div>
                            <span>{{ $sl }}</span>
                        </div>
                        @if($si < 3)
                        <div class="purch-track-line {{ $statusStep > $si ? 'done' : '' }}"></div>
                        @endif
                        @endforeach
                    </div>
                    @elseif($order->status === 'disputed')
                    <div class="purch-dispute-banner">
                        ⚠️ Dispute open — our team is reviewing this order.
                        @if($order->dispute_reason)
                        <span class="purch-dispute-reason">"{{ Str::limit($order->dispute_reason, 80) }}"</span>
                        @endif
                    </div>
                    @else
                    <div class="purch-refund-banner">↩️ This order has been refunded.</div>
                    @endif

                    {{-- Footer: total + expand --}}
                    <div class="purch-card-foot">
                        <span class="purch-total">₦{{ number_format($order->total_amount, 2) }}</span>
                        <button class="purch-expand-btn" data-order="{{ $order->id }}">
                            Details <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16" class="purch-chevron">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Expandable details --}}
                    <div class="purch-details" id="purch-details-{{ $order->id }}">
                        <div class="purch-items-list">
                            @foreach($order->items as $item)
                            <div class="purch-item-row">
                                <span class="purch-item-name">{{ $item->product->name ?? 'Product' }}</span>
                                <span class="purch-item-qty">× {{ $item->quantity }}</span>
                                <span class="purch-item-price">₦{{ number_format($item->unit_price, 2) }}</span>
                                <span class="purch-item-sub">= ₦{{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                            </div>
                            @endforeach
                            <div class="purch-items-total">
                                <span>Order total</span>
                                <span>₦{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="purch-actions">
                            @if($order->status === 'delivered' && !$order->buyer_confirmed)
                            <form action="{{ route('buyer.order.confirm') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button type="submit" class="purch-action-btn purch-action-confirm">
                                    ✅ Confirm Delivery
                                </button>
                            </form>
                            @endif

                            @if(in_array($order->status, ['delivered','completed']) && $order->status !== 'disputed')
                            <button class="purch-action-btn purch-action-dispute"
                                    data-bs-toggle="modal" data-bs-target="#disputeModal{{ $order->id }}">
                                ⚠️ Open Dispute
                            </button>
                            @endif

                            <button class="purch-action-btn purch-action-contact">
                                💬 Contact Seller
                            </button>
                        </div>
                    </div>

                </div>

                {{-- Dispute modal for this order --}}
                @if(in_array($order->status, ['delivered','completed']))
                <div class="modal fade" id="disputeModal{{ $order->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header border-0" style="background:#c0392b;">
                                <h5 class="modal-title text-white">Open Dispute — #{{ $order->transaction_id }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('buyer.order.dispute') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <label class="form-label fw-semibold" style="font-size:13px;">Describe the issue</label>
                                    <textarea name="reason" class="form-control" rows="4"
                                              placeholder="e.g. Item not received, wrong product sent…"
                                              required style="font-size:13px;"></textarea>
                                    <div class="d-flex gap-2 mt-3">
                                        <button type="submit" class="btn btn-danger flex-grow-1 rounded-3">Submit Dispute</button>
                                        <button type="button" class="btn btn-light flex-grow-1 border rounded-3" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @empty
                <div class="purch-empty">
                    <div class="purch-empty-icon">🛍️</div>
                    <div class="purch-empty-title">No purchases yet</div>
                    <p class="purch-empty-sub">When you buy from a seller on the map, your orders will appear here.</p>
                    <a href="#market" data-target="market" class="purch-empty-btn">Browse Sellers</a>
                </div>
                @endforelse

                <div class="purch-no-results d-none" id="purchNoResults">
                    <div class="purch-empty-icon">🔍</div>
                    <div class="purch-empty-title">No orders match</div>
                    <p class="purch-empty-sub">Try a different filter or search term.</p>
                </div>

                </div>{{-- /purch-list --}}
            </div>{{-- /purch-wrap --}}

        </section>

        {{-- Contact Section --}}
        <section id="contact" class="section">
            <div class="ctc-wrap">

                {{-- ── Hero heading ────────────────────────────── --}}
                <div class="ctc-hero">
                    <h2 class="ctc-hero-title">How can we help you?</h2>
                    <p class="ctc-hero-sub">Our support team is available Monday – Friday, 8 am – 6 pm WAT.</p>
                </div>

                {{-- ── Quick-help chips ─────────────────────────── --}}
                <div class="ctc-chips">
                    @foreach([
                        ['icon'=>'🛍️','label'=>'Order Issues',      'val'=>'Order Issues'],
                        ['icon'=>'👤','label'=>'Account Help',       'val'=>'Account Help'],
                        ['icon'=>'🔧','label'=>'Technical Support',  'val'=>'Technical Support'],
                        ['icon'=>'🤝','label'=>'Partnerships',       'val'=>'Partnerships'],
                    ] as $chip)
                    <button class="ctc-chip" data-topic="{{ $chip['val'] }}">
                        <span>{{ $chip['icon'] }}</span> {{ $chip['label'] }}
                    </button>
                    @endforeach
                </div>

                {{-- ── Two-column body ──────────────────────────── --}}
                <div class="ctc-body">

                    {{-- Left: contact info --}}
                    <div class="ctc-info">
                        <div class="ctc-info-card">
                            <h5 class="ctc-info-title">Contact Information</h5>

                            <div class="ctc-info-row">
                                <div class="ctc-info-icon">📧</div>
                                <div>
                                    <div class="ctc-info-lbl">Email</div>
                                    <a href="mailto:support@merketar.com" class="ctc-info-val">support@merketar.com</a>
                                </div>
                            </div>

                            <div class="ctc-info-row">
                                <div class="ctc-info-icon">📞</div>
                                <div>
                                    <div class="ctc-info-lbl">Phone / WhatsApp</div>
                                    <a href="tel:+2348000000000" class="ctc-info-val">+234 800 000 0000</a>
                                </div>
                            </div>

                            <div class="ctc-info-row">
                                <div class="ctc-info-icon">📍</div>
                                <div>
                                    <div class="ctc-info-lbl">Office</div>
                                    <span class="ctc-info-val">Lagos, Nigeria</span>
                                </div>
                            </div>

                            <div class="ctc-info-row">
                                <div class="ctc-info-icon">🕐</div>
                                <div>
                                    <div class="ctc-info-lbl">Working hours</div>
                                    <span class="ctc-info-val">Mon – Fri &nbsp;8:00 am – 6:00 pm WAT</span>
                                </div>
                            </div>

                            <hr class="ctc-divider">

                            <div class="ctc-info-lbl mb-2">Follow us</div>
                            <div class="ctc-socials">
                                <a href="#" class="ctc-social-btn" aria-label="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                    </svg>
                                </a>
                                <a href="#" class="ctc-social-btn" aria-label="Twitter / X">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                    </svg>
                                </a>
                                <a href="#" class="ctc-social-btn" aria-label="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                    </svg>
                                </a>
                                <a href="#" class="ctc-social-btn" aria-label="WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Right: contact form --}}
                    <div class="ctc-form-col">
                        <div class="ctc-form-card">
                            <h5 class="ctc-form-title">Send us a message</h5>

                            {{-- Success toast (hidden by default) --}}
                            <div class="ctc-success d-none" id="ctcSuccess">
                                <span class="ctc-success-icon">✅</span>
                                <div>
                                    <strong>Message sent!</strong>
                                    <p>We'll get back to you within 24 hours.</p>
                                </div>
                            </div>

                            <form id="ctcForm" novalidate>
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="ctc-lbl">Full name <span class="ctc-req">*</span></label>
                                        <input type="text" name="fullname" class="ctc-input"
                                               placeholder="John Doe"
                                               value="{{ trim(($profile->first_name ?? '') . ' ' . ($profile->last_name ?? '')) }}"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="ctc-lbl">Email <span class="ctc-req">*</span></label>
                                        <input type="email" name="email" class="ctc-input"
                                               placeholder="you@email.com"
                                               value="{{ $user->email }}"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="ctc-lbl">Phone</label>
                                        <input type="tel" name="phone" class="ctc-input"
                                               placeholder="+234 800 000 0000"
                                               value="{{ $profile && $profile->phone_number ? ($profile->phone_code ?? '') . $profile->phone_number : '' }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="ctc-lbl">Subject <span class="ctc-req">*</span></label>
                                        <select name="subject" class="ctc-input" id="ctcSubject" required>
                                            <option value="">— Select a topic —</option>
                                            <option value="Order Issues">Order Issues</option>
                                            <option value="Account Help">Account Help</option>
                                            <option value="Technical Support">Technical Support</option>
                                            <option value="Partnerships">Partnerships</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="ctc-lbl">Message <span class="ctc-req">*</span></label>
                                        <textarea name="message" class="ctc-input ctc-textarea"
                                                  placeholder="Describe your issue or question in detail…"
                                                  required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="ctc-submit-btn" id="ctcSubmit">
                                    <span id="ctcBtnLabel">Send Message</span>
                                    <span id="ctcBtnSpinner" class="d-none">Sending…</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>{{-- /ctc-body --}}
            </div>{{-- /ctc-wrap --}}
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

// ── Purchases: tab filter ─────────────────────────────────────
document.querySelectorAll('.purch-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.purch-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        filterPurchases();
    });
});

// ── Purchases: search filter ──────────────────────────────────
const purchSearch = document.getElementById('purchSearch');
if (purchSearch) purchSearch.addEventListener('input', filterPurchases);

function filterPurchases() {
    const activeTab   = document.querySelector('.purch-tab.active');
    const filter      = activeTab ? activeTab.dataset.filter : 'all';
    const query       = (purchSearch ? purchSearch.value.toLowerCase().trim() : '');
    const cards       = document.querySelectorAll('.purch-card');
    let   visible     = 0;

    cards.forEach(card => {
        const statusMatch = filter === 'all' || card.dataset.status === filter;
        const searchMatch = !query || card.dataset.search.includes(query);
        const show = statusMatch && searchMatch;
        card.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    const noResults = document.getElementById('purchNoResults');
    if (noResults) noResults.classList.toggle('d-none', visible > 0 || document.querySelectorAll('.purch-empty').length > 0);
}

// ── Purchases: expand/collapse card details ───────────────────
document.querySelectorAll('.purch-expand-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id      = btn.dataset.order;
        const panel   = document.getElementById('purch-details-' + id);
        if (!panel) return;
        const isOpen  = panel.classList.contains('open');
        panel.classList.toggle('open', !isOpen);
        btn.classList.toggle('open', !isOpen);
    });
});

// ── Contact: quick-help chips → pre-fill subject ──────────────
document.querySelectorAll('.ctc-chip').forEach(chip => {
    chip.addEventListener('click', () => {
        document.querySelectorAll('.ctc-chip').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        const subject = document.getElementById('ctcSubject');
        if (subject) subject.value = chip.dataset.topic;
    });
});

// ── Contact: form submit (client-side demo) ───────────────────
const ctcForm = document.getElementById('ctcForm');
if (ctcForm) {
    ctcForm.addEventListener('submit', e => {
        e.preventDefault();
        if (!ctcForm.checkValidity()) { ctcForm.reportValidity(); return; }

        const btn     = document.getElementById('ctcSubmit');
        const label   = document.getElementById('ctcBtnLabel');
        const spinner = document.getElementById('ctcBtnSpinner');
        btn.disabled  = true;
        label.classList.add('d-none');
        spinner.classList.remove('d-none');

        setTimeout(() => {
            ctcForm.reset();
            btn.disabled = false;
            label.classList.remove('d-none');
            spinner.classList.add('d-none');
            document.querySelectorAll('.ctc-chip').forEach(c => c.classList.remove('active'));

            const success = document.getElementById('ctcSuccess');
            if (success) {
                success.classList.remove('d-none');
                setTimeout(() => success.classList.add('d-none'), 6000);
            }
        }, 1200);
    });
}
</script>
@endpush

@endsection
