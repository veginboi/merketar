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
        <section class="section active p-5" id="home">
            <div class="d-flex flex-column mb-3 gap-1">

                <div id="myCarousel" class="carousel slide mb-1" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" class="active" aria-current="true"></button>
                    </div>
                    <div class="carousel-inner rounded-4 overflow-hidden">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/images/slides/Property 1=Default.png') }}" class="d-block w-100 carousel-img" alt="">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Shop Fresh, Shop Smart</h1>
                                <p class="sub-cap">Get farm-fresh food and trending products delivered straight to your doorstep.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#" data-target="market">Browse Categories</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#" data-target="market">Start Shopping</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant2.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Buy From Verified Sellers</h1>
                                <p class="sub-cap">Explore trusted sellers offering quality goods around you.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#" data-target="market">Find Sellers</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#" data-target="market">View Map</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant3.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Safe &amp; Secure Transaction</h1>
                                <p class="sub-cap">Every purchase is protected with Merketar's secure payment system.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#" data-target="profile">Checkout Now</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#" data-target="faq">Learn More</a>
                                </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/images/slides/Property 1=Variant4.png') }}" class="d-block w-100 carousel-img" alt="" loading="lazy">
                            <div class="carousel-caption text-start slide-cap">
                                <h1>Shop, Trade &amp; Connect</h1>
                                <p class="sub-cap">Be part of a growing community of buyers and sellers making trade easier.</p>
                                <p class="sub-cap-btn">
                                    <a class="btn btn-lg sec-btn-slide" href="#" data-target="more">Invite &amp; Earn</a>
                                    <a class="btn btn-lg pri-btn-slide" href="#" data-target="more">Explore Deals</a>
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

                <div class="ticker seamless" aria-label="News ticker">
                    <div class="ticker__track">
                        <div class="ticker__group">
                            <span class="ticker__item">⚡ Breaking: Merketar launches seller features</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">New arrivals this week</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Free shipping over ₦10,000</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">⚡ Breaking: Merketar launches seller features</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">New arrivals this week</span>
                            <span class="ticker__sep">•</span>
                            <span class="ticker__item">Free shipping over ₦10,000</span>
                            <span class="ticker__sep">•</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Profile Section --}}
        <section id="profile" class="section">
            <div class="d-flex flex-column align-items-center justify-content-between p-4 gap-2 mb-3 profile-container">
                <div class="d-flex align-items-center justify-content-between account px-4 w-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="profile">
                            <form action="{{ route('buyer.upload.picture') }}" method="POST" enctype="multipart/form-data" id="ppForm">
                                @csrf
                                <label for="ppInput" style="cursor:pointer;">
                                    <img src="{{ asset('uploads/profilePicture/' . $user->picture) }}" alt="Profile Picture" style="border:0.5px solid #0056B3;">
                                </label>
                                <input type="file" id="ppInput" name="picture" class="d-none" accept="image/*" onchange="document.getElementById('ppForm').submit()">
                            </form>
                        </div>
                        <div class="d-flex flex-column gap-1 profile">
                            <div class="d-flex gap-1 fullname">
                                <span>{{ $account->account_fullname ?? $user->username }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-md-5 status">
                                <span>Balance</span>
                                <button type="button" id="balanceBtn">
                                    <img src="{{ asset('assets/icons/eye-slash-fill.svg') }}" alt="Toggle" id="balance-visibility">
                                </button>
                            </div>
                            <div class="amount">
                                <span id="currency">{{ $account->currency ?? 'NGN' }}</span>
                                <span id="balance">{{ number_format($account->balance ?? 0, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="#settings" data-href="#settings">
                        <img src="{{ asset('assets/icons/gear-fill.svg') }}" alt="Settings" id="settings-profile-btn">
                    </a>
                </div>

                <div class="px-4 action-btn-container" style="width:80%;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 action-btn">
                        <button class="d-flex align-items-center gap-2 pri-btn">Deposit</button>
                        <button class="d-flex align-items-center gap-2 pri-btn">Merketar Pay</button>
                        <button class="d-flex align-items-center gap-2 pri-btn">Others</button>
                        <button class="d-flex align-items-center gap-2 pri-btn">Recharge</button>
                        <button class="d-flex align-items-center gap-2 pri-btn">Crypto</button>
                    </div>
                </div>

                <div class="d-flex flex-column w-100 px-3 gap-3 recent-histories">
                    <div class="history"><span>Recent Purchases</span></div>
                    <hr style="border:1px solid #004494;">
                    @forelse($recentOrders as $order)
                    <div class="history-container">
                        <div class="flex-grow-1">
                            <div class="initial w-100">
                                <div class="d-flex align-items-center gap-2 seller-profile">
                                    <span class="purchase-fullname">{{ $order->store->store_name ?? 'Unknown Store' }}</span>
                                </div>
                                <div class="d-flex flex-row justify-content-around align-items-center progress-bar">
                                    <span>Purchased</span>
                                    <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                    <span>Processing</span>
                                    <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                    <span>Delivered</span>
                                </div>
                                <div class="d-flex gap-4 d-t">
                                    <span>{{ $order->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <span style="color:#004494;">No recent purchases...</span>
                    @endforelse
                </div>

                <form action="{{ route('buyer.logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="sec-btn border-0">Logout</button>
                </form>
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

@endsection
