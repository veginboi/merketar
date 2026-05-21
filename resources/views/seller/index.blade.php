@extends('layouts.seller')
@section('title', 'Merketar Seller - Naija Market in Your Pocket')

@section('content')

    {{-- Seller Header --}}
    <header class="seller-header py-3 px-5">
        <div class="d-flex justify-content-between align-items-center">

            <img src="{{ asset('assets/images/logos/seller-tradia-logo.png') }}" alt="Merketar" width="106" height="30" class="s-logo">

            <div class="d-flex align-items-center justify-content-end gap-4">
                <div>
                    <img src="{{ asset('assets/icons/seller-search.svg') }}" alt="search" width="18">
                </div>
                <div class="h-salute">
                    <span>Welcome back, {{ $user->username }}</span>
                </div>
                <div class="h-profile">
                    <a href="#wallet">
                        <img src="{{ asset('uploads/profilePicture/' . ($user->picture ?? 'default.png')) }}" alt="Profile" width="40" height="40" style="border-radius:50%;" class="rounded-circle">
                    </a>
                </div>
            </div>

        </div>
    </header>

    {{-- Seller Main --}}
    <main class="seller-main d-flex flex-fill">

        {{-- Left Sidebar --}}
        <div class="py-4 side-bar-divider" style="background-color:#004494;">
            <div class="d-flex flex-column gap-3 h-100 seller-sidebar">

                <div class="d-flex gap-3 align-items-center db-ctrl" style="padding-right:10px;">
                    <button type="button" class="border-0 dashboardBtn dashboard-link text-decoration-none px-4">
                        <img src="{{ asset('assets/icons/dashbord.svg') }}" alt="icon" class="dashboard-icon" width="20">
                        <span class="dashboardMoreInfo">Dashboard</span>
                    </button>
                    <button class="exitMoreInfo dashboardMoreInfo border-0" style="padding:0 5px;">
                        <img src="{{ asset('assets/icons/arrow-90.svg') }}" alt="return" width="14">
                    </button>
                </div>

                <a class="sidebar-link sActive text-decoration-none px-3 py-2 border-0" href="#order" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/Order management.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Order Management</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#store" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/product.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Store</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#analytic" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/Analysis.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Analytics</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#message" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/chat-dots.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Messages</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#wallet" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/wallet.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Wallet</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#storeSettings">
                    <img src="{{ asset('assets/icons/gear-wide-connected.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Store Settings</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#reviewRatings" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/star.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Review &amp; Ratings</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#notifications" style="display:{{ $storeDisplay }}">
                    <img src="{{ asset('assets/icons/bell.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Notification Center</span>
                </a>

                <a class="sidebar-link text-decoration-none px-3 py-2 border-0" href="#support">
                    <img src="{{ asset('assets/icons/question-circle.svg') }}" alt="icon" width="20">
                    <span class="dashboardMoreInfo">Support</span>
                </a>

            </div>
        </div>

        {{-- Seller Sections --}}
        <section class="seller-section h-100 flex-fill">

            {{-- ── ORDER MANAGEMENT ── --}}
            <div id="order" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="position-relative orderSlides h-100 overflow-hidden">

                        {{-- New Orders --}}
                        <div class="d-flex flex-column gap-4 align-items-center flex-fill h-100 orderSlide orderActive">
                            <h5 class="fw-bold">New Orders</h5>
                            <div class="w-100" style="overflow-y:scroll;height:100%;">
                                <div class="d-flex flex-column align-items-start gap-2 w-100">
                                    @forelse($orders->where('status','pending') as $order)
                                    <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4">
                                        <div class="d-flex gap-2 align-items-center b-profile">
                                            <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="buyer" width="24" class="rounded-circle">
                                            <span class="order-name" style="min-width:fit-content;font-size:12px;color:#004494;">{{ $order->buyer->username }}</span>
                                        </div>
                                        <span class="ms-auto me-2" style="font-size:11px;color:#666;">₦{{ number_format($order->total_amount, 2) }}</span>
                                        <button class="sec-btn" style="border:1px solid #004494;border-radius:20px;font-size:11px;" onclick="showOrderModal({{ $order->id }})">View Order</button>
                                        <div class="d-flex align-items-center ms-1 gap-2">
                                            <form action="{{ route('seller.order.accept') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <button type="submit" class="pri-btn" style="border:1px solid #004494;border-radius:20px;font-size:11px;">Accept</button>
                                            </form>
                                            <form action="{{ route('seller.order.cancel') }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this order?')">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <button type="submit" class="sec-btn" style="border:1px solid #004494;border-radius:20px;font-size:11px;">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="w-100 text-center" style="font-size:0.8rem;">No new orders.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        {{-- Accepted Orders --}}
                        <div class="d-flex flex-column gap-4 align-items-center h-100 flex-fill orderSlide">
                            <h5 class="fw-bold">Accepted Orders</h5>
                            <div class="d-flex flex-column align-items-start gap-2 w-100 h-100" style="overflow:scroll;">
                                @forelse($orders->whereIn('status',['processing','delivered']) as $order)
                                <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4">
                                    <div class="d-flex gap-2 align-items-center b-profile">
                                        <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="buyer" width="24" class="rounded-circle">
                                        <span class="order-name" style="min-width:fit-content;font-size:12px;color:#004494;">{{ $order->buyer->username }}</span>
                                    </div>
                                    <span class="ms-auto me-2" style="font-size:11px;color:#666;">₦{{ number_format($order->total_amount, 2) }}</span>
                                    <button class="sec-btn ms-auto" style="border:1px solid #004494;border-radius:20px;font-size:11px;" onclick="showOrderModal({{ $order->id }})">View Order</button>
                                    <div class="ms-1">
                                        <button class="border-0"><img src="{{ asset('assets/icons/check-clc.svg') }}" alt="Accepted"></button>
                                    </div>
                                </div>
                                @empty
                                <p class="w-100 text-center" style="font-size:0.8rem;">No accepted orders.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Cancelled Orders --}}
                        <div class="d-flex flex-column gap-4 align-items-center flex-fill orderSlide">
                            <h5 class="fw-bold">Cancelled Orders</h5>
                            <div class="d-flex flex-column align-items-start gap-2 w-100 h-100" style="overflow:scroll;">
                                @forelse($orders->where('status','refunded') as $order)
                                <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4">
                                    <div class="d-flex gap-2 align-items-center b-profile">
                                        <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="buyer" width="24" class="rounded-circle">
                                        <span style="min-width:fit-content;font-size:12px;color:#004494;">{{ $order->buyer->username }}</span>
                                    </div>
                                    <button class="sec-btn ms-auto" style="border:1px solid #004494;border-radius:20px;font-size:11px;" onclick="showOrderModal({{ $order->id }})">View Order</button>
                                    <div class="ms-1">
                                        <button class="border-0"><img src="{{ asset('assets/icons/cancel.svg') }}" alt="Cancelled"></button>
                                    </div>
                                </div>
                                @empty
                                <p class="w-100 text-center" style="font-size:0.8rem;">No cancelled orders.</p>
                                @endforelse
                            </div>
                        </div>

                        <button class="position-absolute border-0 prevBtn" style="top:0.7rem;left:25%;"><img src="{{ asset('assets/icons/prevBtn.svg') }}" alt="Prev"></button>
                        <button class="position-absolute border-0 nextBtn" style="top:0.7rem;right:25%;"><img src="{{ asset('assets/icons/nextBtn.svg') }}" alt="Next"></button>
                    </div>
                </div>
            </div>

            {{-- ── STORE ── --}}
            <div id="store" class="section active p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column align-items-center w-100 h-100" style="min-height:0;">

                        @if($store && $store->store_status === 'active')

                            <div><h5 class="fw-bold">{{ $store->store_name }} Store</h5></div>

                            <div class="d-flex flex-column align-items-start gap-2 w-100 productContent" style="flex:1;height:70%;overflow:scroll;">
                                @if(empty($categoriesWithProducts))
                                    <p style="font-size:0.7rem;color:#fff;" class="d-flex align-items-center justify-content-center w-100 h-100 text-center">No categories found. Add your first category!</p>
                                @else
                                    @foreach($categoriesWithProducts as $item)
                                    <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4 category">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="d-flex align-items-center justify-content-center" style="width:25px;height:25px;background-color:#004494;border-radius:50%;">
                                                <img src="{{ asset('assets/icons/product.svg') }}" alt="icon" width="20">
                                            </div>
                                            <span class="cat-name" style="min-width:fit-content;font-size:14px;font-weight:600;color:#004494;">{{ $item['category']->name }}</span>
                                        </div>
                                        <span class="ms-auto me-2" style="font-size:12px;color:#666;">{{ count($item['products']) }} products</span>
                                        <button type="button" class="sec-btn view-cat-btn" data-href="#category-{{ $item['category']->id }}" style="border:1px solid #004494;border-radius:20px;">View Category</button>
                                        <button type="button" class="pri-btn ms-2 add-product-btn" data-href="#add-product-{{ $item['category']->id }}" style="border:1px solid #004494;border-radius:20px;">Add Product</button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>

                            <div class="add-cat w-100 d-flex flex-column align-items-center mt-2">
                                <form action="{{ route('seller.category.add') }}" method="POST" class="d-flex flex-column align-items-center add_category" style="width:fit-content;">
                                    @csrf
                                    <input type="text" name="name" placeholder="Enter new Category name...">
                                    <button type="submit" name="add_category" class="sec-btn rounded-0 addCategory" style="padding:2px;" title="Add New Category">
                                        <img src="{{ asset('assets/icons/addCart.svg') }}" width="20" alt="Add Category">
                                    </button>
                                </form>
                            </div>

                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 w-100">
                                <h5 class="fw-bold mb-4">Create Your Merketar Store</h5>
                                <form action="{{ route('seller.store.create') }}" method="POST" class="store-signup w-100" style="max-width:420px;">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="color:#fff;">Store Name</label>
                                        <input type="text" name="store_name" class="form-control" value="{{ old('store_name', $user->username) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="color:#fff;">Description</label>
                                        <textarea name="store_description" class="form-control" rows="3" placeholder="What does your store sell?"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="color:#fff;">Store Address</label>
                                        <input type="text" name="store_address" class="form-control" placeholder="e.g. 10 Market Street, Lagos">
                                    </div>
                                    <button type="submit" name="create-store" class="pri-btn w-100">Create Store</button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            {{-- ── ANALYTICS ── --}}
            <div id="analytic" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer d-flex flex-column" style="background-color:#004494;overflow:hidden;">
                    <div class="d-flex flex-column align-items-center gap-3 w-100 h-100" style="min-height:0;">
                        <div class="flex-shrink-0"><h5 class="text-white mb-0 fw-bold">Analytics</h5></div>
                        <div class="d-flex flex-column flex-grow-1 w-100 gap-3 ana-content" style="min-height:0;overflow-y:scroll;">

                            {{-- Phase 1: Total Sales (sliding daily/weekly/monthly/yearly/all) --}}
                            <div class="d-flex justify-content-center gap-3 w-100 a-container" style="min-height:fit-content;">
                                <div class="p-3 seller-analytic" style="background:#fff;width:40%;border-radius:35px;overflow:hidden;">
                                    <div class="h-100 salesCards position-relative">
                                        @php
                                            $today = \Carbon\Carbon::today();
                                            $weekStart = \Carbon\Carbon::now()->startOfWeek();
                                            $monthStart = \Carbon\Carbon::now()->startOfMonth();
                                            $yearStart = \Carbon\Carbon::now()->startOfYear();
                                            $completedOrders = $orders->where('status','completed');
                                            $dailySales   = $completedOrders->filter(fn($o) => $o->created_at->isToday())->sum('total_amount');
                                            $weeklySales  = $completedOrders->filter(fn($o) => $o->created_at->gte($weekStart))->sum('total_amount');
                                            $monthlySales = $completedOrders->filter(fn($o) => $o->created_at->gte($monthStart))->sum('total_amount');
                                            $yearlySales  = $completedOrders->filter(fn($o) => $o->created_at->gte($yearStart))->sum('total_amount');
                                            $allTimeSales = $completedOrders->sum('total_amount');
                                        @endphp
                                        <div class="d-flex flex-column align-items-center justify-content-between h-100 salesCard orderActive">
                                            <h4 class="card-title mb-2">Total Sales</h4>
                                            <span class="card-digit">₦{{ number_format($dailySales, 2) }}</span>
                                            <h5 class="card-bottom-details">Daily</h5>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between h-100 salesCard">
                                            <h4 class="card-title mb-2">Total Sales</h4>
                                            <span class="card-digit">₦{{ number_format($weeklySales, 2) }}</span>
                                            <h5 class="card-bottom-details">Weekly</h5>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between h-100 salesCard">
                                            <h4 class="card-title mb-2">Total Sales</h4>
                                            <span class="card-digit">₦{{ number_format($monthlySales, 2) }}</span>
                                            <h5 class="card-bottom-details">Monthly</h5>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between h-100 salesCard">
                                            <h4 class="card-title mb-2">Total Sales</h4>
                                            <span class="card-digit">₦{{ number_format($yearlySales, 2) }}</span>
                                            <h5 class="card-bottom-details">Yearly</h5>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between h-100 salesCard">
                                            <h4 class="card-title mb-2">Total Sales</h4>
                                            <span class="card-digit">₦{{ number_format($allTimeSales, 2) }}</span>
                                            <h5 class="card-bottom-details">All Time</h5>
                                        </div>
                                        <button class="position-absolute border-0 cardPrevBtn" style="bottom:0.3rem;left:25%;background:transparent;"><img src="{{ asset('assets/icons/prevCardBtn.svg') }}" alt="Prev"></button>
                                        <button class="position-absolute border-0 cardNextBtn" style="bottom:0.3rem;right:25%;background:transparent;"><img src="{{ asset('assets/icons/cardNextBtn.svg') }}" alt="Next"></button>
                                    </div>
                                </div>
                                <div class="p-3 seller-analytic" style="background:#fff;width:40%;border-radius:35px;">
                                    <div class="d-flex flex-column align-items-center justify-content-between h-100">
                                        <h4 class="card-title mb-2">Total Orders</h4>
                                        <span class="card-digit">{{ $orders->count() }}</span>
                                        <span class="card-bottom-details" style="color:#004494;">All Time</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Phase 2 --}}
                            <div class="d-flex justify-content-center gap-3 w-100" style="min-height:fit-content;">
                                <div class="p-3 seller-analytic" style="background:#fff;width:40%;border-radius:35px;">
                                    <div class="d-flex flex-column align-items-center justify-content-between gap-2 h-100">
                                        <h4 class="card-title mb-2">Pending - Completed</h4>
                                        <div>
                                            <span class="card-digit">{{ $orders->where('status','pending')->count() }}</span>
                                            <span class="card-digit"> - </span>
                                            <span class="card-digit">{{ $orders->where('status','completed')->count() }}</span>
                                        </div>
                                        <button class="border-0 pri-btn" onclick="document.querySelector('[href=\'#order\']')?.click()">View</button>
                                    </div>
                                </div>
                                <div class="p-3 seller-analytic" style="background:#fff;width:40%;border-radius:35px;">
                                    <div class="d-flex flex-column align-items-center justify-content-between gap-2 h-100">
                                        <h4 class="card-title mb-2">Top Selling Product</h4>
                                        @php
                                            $topProduct = null;
                                            if ($orders->count()) {
                                                $productSales = [];
                                                foreach ($orders->where('status','completed') as $o) {
                                                    foreach ($o->items as $item) {
                                                        $pid = $item->product_id;
                                                        $productSales[$pid] = ($productSales[$pid] ?? 0) + $item->quantity;
                                                    }
                                                }
                                                if (!empty($productSales)) {
                                                    arsort($productSales);
                                                    $topPid = array_key_first($productSales);
                                                    $topProduct = \App\Models\Product::find($topPid);
                                                }
                                            }
                                        @endphp
                                        <span class="card-digit" style="font-size:1rem;text-align:center;">{{ $topProduct?->name ?? '—' }}</span>
                                        <button class="border-0 pri-btn" data-href="#store">View Store</button>
                                    </div>
                                </div>
                            </div>

                            {{-- Phase 3 --}}
                            <div class="d-flex justify-content-center gap-3 w-100 flex-grow-1" style="min-height:200px;">
                                <div class="p-3 seller-analytic" style="background:#fff;width:45%;border-radius:35px;overflow:hidden;">
                                    <div id="graph" class="h-100 w-100 d-flex align-items-center justify-content-center">
                                        <span class="text-dark" style="font-size:0.85rem;">Sales Graph Coming Soon</span>
                                    </div>
                                </div>
                                <div class="p-3 seller-analytic" style="background:#fff;width:45%;border-radius:35px;overflow:hidden;">
                                    <div id="calendar" class="h-100 w-100"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ── MESSAGES ── --}}
            <div id="message" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column gap-4 align-items-center flex-fill h-100">
                        <h5 class="fw-bold">Messages</h5>
                        <div class="w-100" style="overflow-y:scroll;height:100%;">
                            <div class="d-flex flex-column align-items-start gap-2 w-100">
                                @forelse($orders->whereIn('status',['processing','completed'])->take(5) as $order)
                                <a href="#" class="text-decoration-none w-100">
                                    <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4">
                                        <div class="d-flex gap-2 align-items-center b-m-profile">
                                            <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="buyer" width="24" class="rounded-circle">
                                            <span style="width:200px;font-size:12px;color:#004494;">{{ $order->buyer->username }}</span>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center gap-2 m-m-detail">
                                            <span style="color:#004494;font-size:10px;">{{ $order->updated_at->format('g:ia') }}</span>
                                            <span style="color:#004494;font-size:10px;">{{ $order->updated_at->isToday() ? 'Today' : $order->updated_at->format('d/m/y') }}</span>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <p class="w-100 text-center" style="font-size:0.85rem;">No messages yet. Accepted orders appear here.</p>
                                @endforelse
                                @if($orders->count() === 0)
                                    {{-- Placeholder items for empty state visual --}}
                                    @foreach(['Mary James','Gift Joy','John Johnson'] as $name)
                                    <a href="#" class="text-decoration-none w-100" style="opacity:0.4;pointer-events:none;">
                                        <div class="d-flex p-2 justify-content-between align-items-center w-100 bg-white rounded-4">
                                            <div class="d-flex gap-2 align-items-center b-m-profile">
                                                <img src="{{ asset('uploads/profilePicture/default.png') }}" alt="buyer" width="24" class="rounded-circle">
                                                <span style="width:200px;font-size:12px;color:#004494;">{{ $name }}</span>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center gap-2">
                                                <span style="color:#004494;font-size:10px;">— — —</span>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── WALLET ── --}}
            <div id="wallet" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column align-items-center h-100 overflow-scroll bg-white">

                        {{-- Cover Photo --}}
                        <div class="w-100 position-relative">
                            <img src="{{ asset('uploads/coverPhoto/' . (optional($store)->cover_photo ?? 'default.jpg')) }}" alt="Cover" class="w-100" style="height:300px;object-fit:cover;object-position:center;">
                            <form action="{{ route('seller.upload.cover') }}" method="POST" enctype="multipart/form-data" style="position:absolute;bottom:10px;right:10px;">
                                @csrf
                                <label class="btn btn-sm btn-light" style="cursor:pointer;font-size:11px;">
                                    Change Cover
                                    <input type="file" name="cover" accept="image/*" style="display:none;" onchange="this.form.submit()">
                                </label>
                            </form>
                        </div>

                        {{-- Account Balance --}}
                        <div class="w-100 b-cover-pic" style="margin-top:calc(-80px);">
                            <div class="d-flex align-items-center justify-content-between account p-4 w-100">
                                <div class="d-flex align-items-end gap-3" style="width:fit-content;">
                                    <div class="profile">
                                        <img src="{{ asset('uploads/profilePicture/' . ($user->picture ?? 'default.png')) }}" alt="Profile" class="p-pic">
                                    </div>
                                    <div class="d-flex flex-column profile p-content">
                                        <div class="d-flex align-items-center gap-3 fullname" style="height:fit-content;">
                                            <span>{{ $account->account_fullname ?? $user->username }}</span>
                                            <img src="{{ asset('assets/icons/verifyicon.svg') }}" alt="Verified" style="object-fit:contain;width:18px;height:18px;" class="v-img">
                                        </div>
                                        <div class="d-flex align-items-center gap-5 status">
                                            <span>Balance</span>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" id="seller-balanceBtn">
                                                    <img src="{{ asset('assets/icons/eye-slash-fill.svg') }}" alt="Visibility" id="seller-balance-visibility">
                                                </button>
                                            </div>
                                        </div>
                                        <div class="amount">
                                            <div style="min-width:230px;">
                                                <span id="currency">{{ $account->currency ?? 'NGN' }}</span>
                                                <span id="seller-balance">{{ number_format($account->balance ?? 0, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#storeSettings" title="Settings">
                                    <img src="{{ asset('assets/icons/gear-fill.svg') }}" alt="Settings" id="settings-profile-btn">
                                </a>
                            </div>

                            {{-- Actions --}}
                            <div class="p-4 action-btn-container bg-white w-100">
                                <div class="d-flex align-items-center justify-content-between flex-wrap action-btn">
                                    <button class="d-flex align-items-center gap-2 pri-btn">Deposit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/></svg>
                                    </button>
                                    <button class="d-flex align-items-center gap-2 pri-btn">Merketar
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bank" viewBox="0 0 16 16"><path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"/></svg>
                                    </button>
                                    <button class="d-flex align-items-center gap-2 pri-btn">Withdraw</button>
                                    <button class="d-flex align-items-center gap-2 pri-btn">Recharge</button>
                                    <button class="d-flex align-items-center gap-2 pri-btn">Crypto
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/><path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/><path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/><path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/></svg>
                                    </button>
                                </div>
                            </div>

                            {{-- Recent Completed Orders --}}
                            <div class="d-flex flex-column w-100 p-4 gap-3 recent-histories bg-white mt-0">
                                <div class="history"><span>Recent Completed Orders</span></div>
                                <hr style="border:1px solid #004494;">
                                <div class="d-flex flex-column gap-3">
                                    @forelse($orders->where('status','completed')->take(3) as $order)
                                    <div class="history-container">
                                        <div class="flex-grow-1">
                                            {{-- Initial Summary --}}
                                            <div class="initial w-100">
                                                <a href="#" class="text-decoration-none">
                                                    <div class="d-flex align-items-center gap-2 seller-profile">
                                                        <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="" class="purchase-pic">
                                                        <div class="purchase-fullname d-flex"><span style="color:#004494;">{{ $order->buyer->username }}</span></div>
                                                    </div>
                                                </a>
                                                <div class="d-flex flex-row justify-content-around align-items-center progress-bar">
                                                    <span>Purchased</span>
                                                    <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                                    <span>Processing</span>
                                                    <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                                    <span>Delivered</span>
                                                </div>
                                                <div class="d-flex gap-4 d-t">
                                                    <span>{{ $order->created_at->format('d/m/y') }}</span>
                                                    <span>{{ $order->created_at->format('g:ia') }}</span>
                                                </div>
                                            </div>
                                            {{-- More Details (expandable) --}}
                                            <div class="more-detail w-100" style="display:none;">
                                                <div class="d-flex gap-2 py-2 flex-column align-items-center flex-grow-1">
                                                    <a href="#" class="text-decoration-none">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="{{ asset('uploads/profilePicture/' . ($order->buyer->picture ?? 'default.png')) }}" alt="" class="purchase-pic">
                                                            <div class="purchase-fullname">
                                                                <span>{{ $order->buyer->username }}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="d-flex flex-row justify-content-around align-items-center progress-bar">
                                                        <span>Purchased</span>
                                                        <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                                        <span>Processing</span>
                                                        <img src="{{ asset('assets/icons/arrows1.svg') }}" alt="">
                                                        <span>Delivered</span>
                                                    </div>
                                                    <div class="history-details w-100">
                                                        <div class="detail"><span class="history-prop">Date:</span><span class="history-val">{{ $order->created_at->format('d/m/y') }}</span></div>
                                                        <div class="detail"><span class="history-prop">Time:</span><span class="history-val">{{ $order->created_at->format('g:ia') }}</span></div>
                                                        <div class="detail"><span class="history-prop">Order ID:</span><span class="history-val">{{ $order->id }}</span></div>
                                                        <div class="detail"><span class="history-prop">Amount:</span><span class="history-val">₦{{ number_format($order->total_amount, 2) }}</span></div>
                                                        <div class="detail"><span class="history-prop">Status:</span><span class="history-val">{{ ucfirst($order->status) }}</span></div>
                                                    </div>
                                                    <button class="sec-btn">View Purchase</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <button type="button" class="border-0 h-tgl-btn">
                                                <img src="{{ asset('assets/icons/Expand.svg') }}" alt="Expand">
                                            </button>
                                        </div>
                                    </div>
                                    @empty
                                    <p style="color:#004494;font-size:0.85rem;">No completed orders yet.</p>
                                    @endforelse
                                </div>
                                @if($orders->where('status','completed')->count() > 3)
                                <div class="text-center mt-2">
                                    <button type="button" class="sec-btn" style="border:1px solid #004494;border-radius:20px;font-size:12px;">See All Completed Orders</button>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ── STORE SETTINGS ── --}}
            <div id="storeSettings" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column px-5 py-4 settings gap-4 bg-white h-100 overflow-scroll">

                        {{-- Profile Picture --}}
                        <form action="{{ route('seller.upload.picture') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center setting-pro-initial profile">
                            @csrf
                            <img src="{{ asset('uploads/profilePicture/' . ($user->picture ?? 'default.png')) }}" alt="Profile" style="border:0.5px solid #0056B3;">
                            <div class="d-flex flex-column justify-content-between gap-4 set-pp">
                                <span style="color:#0056B3;">{{ $account->account_fullname ?? $user->username }}</span>
                                <div class="d-flex align-items-center">
                                    <label for="profileUpload" class="file-input-simple">Choose Profile Picture</label>
                                    <input type="file" name="picture" id="profileUpload" accept="image/*">
                                </div>
                                <div class="d-flex gap-2">
                                    <button class="border-0 pri-btn upload-btn" type="submit">Upload Picture</button>
                                </div>
                            </div>
                        </form>

                        <hr style="border-color:#004494;">

                        {{-- Change Username --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ route('seller.settings.username') }}" method="POST" class="d-flex flex-column gap-2 set-property">
                                @csrf
                                <h5>Change Username <span style="font-size:0.7rem;color:#666;">(choose carefully)</span></h5>
                                <div class="d-flex update-content">
                                    <span>Current:</span><input type="text" value="{{ $user->username }}" disabled style="color:#004494;background:#f0f0f0;">
                                </div>
                                <div class="d-flex update-content">
                                    <span>New:</span><input type="text" name="new_username" id="newUsername" maxlength="24" placeholder="new username" required>
                                </div>
                                <div class="d-flex px-md-5 gap-md-5 justify-content-end reset-btn">
                                    <button type="submit" class="sec-btn change-btn">Change</button>
                                </div>
                            </form>
                            <div>
                                <img src="{{ asset('assets/icons/check-clc.svg') }}" class="proUpdate" alt="Updated" width="28" height="28" style="display:none;">
                            </div>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Change Email (UI only - requires verification) --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="#" class="d-flex flex-column gap-2 set-property">
                                <h5>Change Email</h5>
                                <div class="d-flex update-content"><span>Current:</span><input type="email" value="{{ $user->email }}" disabled style="color:#004494;background:#f0f0f0;"></div>
                                <div class="d-flex update-content"><span>New:</span><input type="email" name="newEmail" id="newEmail" maxlength="100" placeholder="new@email.com"></div>
                                <div class="d-flex px-md-5 gap-md-5 justify-content-end reset-btn">
                                    <button type="button" class="sec-btn change-btn">Change</button>
                                    <button type="button" class="border-0 pri-btn verify-btn">Verify</button>
                                </div>
                            </form>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Change Password --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="{{ route('seller.settings.password') }}" method="POST" class="d-flex flex-column gap-2 set-property">
                                @csrf
                                <h5>Change Password</h5>
                                <div class="d-flex update-content"><span>Current:</span><input type="password" name="current_password" placeholder="current password" required></div>
                                <div class="d-flex update-content"><span>New:</span><input type="password" name="new_password" placeholder="new password (min 6)" minlength="6" required></div>
                                <div class="d-flex update-content"><span>Confirm:</span><input type="password" name="new_password_confirmation" placeholder="confirm new password" minlength="6" required></div>
                                <div class="d-flex px-md-5 gap-md-5 justify-content-end reset-btn">
                                    <button type="submit" class="sec-btn change-btn">Change</button>
                                </div>
                            </form>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Change Phone --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="#" class="d-flex flex-column gap-2 set-property">
                                <h5>Change Phone</h5>
                                <div class="d-flex update-content"><span>Current:</span>+234<input type="number" name="currentPhone" id="currentPhone" maxlength="10" placeholder="0000000000" disabled style="color:#004494;background:#f0f0f0;"></div>
                                <div class="d-flex update-content"><span>New:</span>+234<input type="number" name="newPhone" id="newPhone" maxlength="10" placeholder="new number"></div>
                                <div class="d-flex px-md-5 gap-md-5 justify-content-end reset-btn">
                                    <button type="button" class="sec-btn change-btn">Change</button>
                                    <button type="button" class="border-0 pri-btn verify-btn">Verify</button>
                                </div>
                            </form>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Change Address --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <form action="#" class="d-flex flex-column gap-2 set-property">
                                <h5>Change Address <span style="font-size:0.7rem;color:#666;">(admin validation)</span></h5>
                                <div class="d-flex update-content"><span>Current:</span><input type="text" value="{{ $profile->address_line ?? '' }}" disabled style="color:#004494;background:#f0f0f0;"></div>
                                <div class="d-flex update-content"><span>New:</span><input type="text" name="newAddress" id="newAddress" placeholder="new address"></div>
                                <div class="d-flex px-md-5 gap-md-5 justify-content-end reset-btn">
                                    <button type="button" class="sec-btn change-btn">Change</button>
                                    <button type="button" class="border-0 pri-btn verify-btn">Verify</button>
                                </div>
                            </form>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Notification Mode --}}
                        <div class="d-flex flex-column gap-2 set-property">
                            <h5>Notification Mode</h5>
                            <ul style="list-style:none;padding:0;margin:0;">
                                <li class="d-flex align-items-center justify-content-between py-1">
                                    <span style="color:#004494;">Email notifications</span>
                                    <img src="{{ asset('assets/icons/tgl-icon-on.svg') }}" alt="toggle" id="notification" style="cursor:pointer;width:40px;">
                                </li>
                                <li class="d-flex align-items-center justify-content-between py-1">
                                    <span style="color:#004494;">SMS notifications</span>
                                    <img src="{{ asset('assets/icons/tgl-icon-off.svg') }}" alt="toggle" id="notification" style="cursor:pointer;width:40px;">
                                </li>
                                <li class="d-flex align-items-center justify-content-between py-1">
                                    <span style="color:#004494;">In-app notifications</span>
                                    <img src="{{ asset('assets/icons/tgl-icon-off.svg') }}" alt="toggle" id="notification" style="cursor:pointer;width:40px;">
                                </li>
                            </ul>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Store Location --}}
                        @if($store && $store->store_status === 'active')
                        <div>
                            <h5>Store Location</h5>
                            @php
                                $hasLocation = $store->latitude && $store->longitude;
                                $locationMsg = $hasLocation ? 'Change your business location if necessary.' : 'Set your business location so customers can find you on the map.';
                            @endphp
                            <p style="color:#004494;font-size:0.75rem;margin:0 0 8px;">{{ $locationMsg }}</p>
                            <div id="storeMap" style="height:280px;border-radius:8px;border:1px solid #004494;"></div>
                            <form action="{{ route('seller.location.save') }}" method="POST" class="mt-2 d-flex gap-2 align-items-end">
                                @csrf
                                <input type="hidden" name="latitude" id="storeLatInput">
                                <input type="hidden" name="longitude" id="storeLngInput">
                                @if($hasLocation)
                                <small style="color:#004494;font-size:10px;">Lat: {{ $store->latitude }}, Lng: {{ $store->longitude }}</small>
                                @endif
                                <button type="submit" name="submit_location" class="pri-btn ms-auto">Save Location</button>
                            </form>
                        </div>
                        <hr style="border-color:#004494;">
                        @endif

                        {{-- Manage Categories --}}
                        @if($store && $store->store_status === 'active' && !empty($categoriesWithProducts))
                        <div>
                            <h5>Manage Categories</h5>
                            @foreach($categoriesWithProducts as $item)
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span style="color:#004494;">{{ $item['category']->name }}</span>
                                <span style="font-size:12px;color:#666;">{{ count($item['products']) }} products</span>
                                <form action="{{ route('seller.category.delete') }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category and all its products?')">
                                    @csrf
                                    <input type="hidden" name="category_id" value="{{ $item['category']->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        <hr style="border-color:#004494;">
                        @endif

                        {{-- Account Info --}}
                        <div>
                            <h5>Account Info</h5>
                            <div class="d-flex flex-column gap-2" style="color:#004494;">
                                <div><strong>Username:</strong> {{ $user->username }}</div>
                                <div><strong>Email:</strong> {{ $user->email }}</div>
                                <div><strong>Account #:</strong> {{ $account->account_number ?? 'Not assigned' }}</div>
                                <div><strong>Status:</strong> {{ ucfirst($user->status) }}</div>
                                <div><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        <hr style="border-color:#004494;">

                        {{-- Logout --}}
                        <div>
                            <form action="{{ route('seller.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── REVIEW & RATINGS ── --}}
            <div id="reviewRatings" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column h-100 w-100" style="min-height:0;">

                        {{-- Header --}}
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-shrink-0">
                            <h5 class="mb-0 fw-bold">Reviews &amp; Ratings</h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fs-4 fw-bold">4.8</span>
                                <span style="color:#ffc107;font-size:1.2rem;">★★★★☆</span>
                                <span style="font-size:0.8rem;">(0 reviews)</span>
                            </div>
                        </div>

                        <div class="row flex-shrink-0 mb-3">
                            {{-- Rating Breakdown --}}
                            <div class="col-md-6">
                                <div class="bg-white p-3 rounded-4">
                                    <h6 style="color:#004494;" class="mb-3">Rating Breakdown</h6>
                                    @foreach([5=>0, 4=>0, 3=>0, 2=>0, 1=>0] as $stars => $pct)
                                    <div class="d-flex align-items-center mb-2">
                                        <span style="color:#004494;width:60px;font-size:12px;">{{ $stars }} stars</span>
                                        <div class="progress flex-grow-1" style="height:10px;background:#e9ecef;">
                                            <div class="progress-bar" style="width:{{ $pct }}%;background:{{ $stars >= 4 ? '#198754' : ($stars == 3 ? '#ffc107' : '#dc3545') }};"></div>
                                        </div>
                                        <span style="color:#004494;font-size:12px;margin-left:8px;">{{ $pct }}%</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- Recent Reviews --}}
                            <div class="col-md-6 mt-3 mt-md-0">
                                <div class="bg-white p-3 rounded-4 h-100">
                                    <h6 style="color:#004494;" class="mb-3">Recent Reviews</h6>
                                    <div style="max-height:200px;overflow-y:auto;">
                                        <p style="color:#666;font-size:0.85rem;text-align:center;padding-top:40px;">No reviews yet. Your ratings will appear here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- All Reviews --}}
                        <div class="flex-grow-1 bg-white rounded-4 p-3" style="overflow-y:auto;min-height:0;">
                            <h6 style="color:#004494;" class="mb-3">All Reviews</h6>
                            <div id="reviewsList" class="text-center py-5">
                                <p style="color:#666;font-size:0.85rem;">No reviews yet. Complete orders will earn reviews from buyers.</p>
                            </div>
                            <div class="text-center mt-3">
                                <button class="pri-btn">Load More Reviews</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── NOTIFICATIONS ── --}}
            <div id="notifications" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column h-100 w-100" style="min-height:0;">

                        <div class="d-flex justify-content-between align-items-center mb-3 flex-shrink-0">
                            <h5 class="mb-0 fw-bold">Notification Center</h5>
                            <div class="d-flex gap-2">
                                <button class="sec-btn btn-sm border-0" style="font-size:12px;">Mark All Read</button>
                                <button class="pri-btn btn-sm" style="font-size:12px;">Settings</button>
                            </div>
                        </div>

                        {{-- Tabs --}}
                        <ul class="nav nav-tabs mb-3 flex-shrink-0" id="notificationTabs" role="tablist" style="border-color:rgba(255,255,255,0.3);">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ntf-all-tab" data-bs-toggle="tab" data-bs-target="#ntf-all" type="button" style="color:#fff;border-color:transparent;">
                                    All <span class="badge bg-primary ms-1">{{ $orders->where('status','pending')->count() }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ntf-unread-tab" data-bs-toggle="tab" data-bs-target="#ntf-unread" type="button" style="color:#fff;border-color:transparent;">
                                    Unread <span class="badge bg-danger ms-1">{{ $orders->where('status','pending')->count() }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ntf-orders-tab" data-bs-toggle="tab" data-bs-target="#ntf-orders" type="button" style="color:#fff;border-color:transparent;">Orders</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="ntf-system-tab" data-bs-toggle="tab" data-bs-target="#ntf-system" type="button" style="color:#fff;border-color:transparent;">System</button>
                            </li>
                        </ul>

                        <div class="tab-content flex-grow-1" style="overflow-y:auto;min-height:0;">

                            <div class="tab-pane fade show active" id="ntf-all">
                                @forelse($orders->where('status','pending')->take(5) as $order)
                                <div class="bg-white rounded-4 p-3 mb-3 border-start border-5 border-primary">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ asset('assets/icons/bell.svg') }}" width="20" alt="Order">
                                            </div>
                                            <div>
                                                <h6 style="color:#004494;" class="mb-1">New Order Received</h6>
                                                <p style="color:#004494;" class="mb-0 small">You have a new order from <strong>{{ $order->buyer->username }}</strong> — ₦{{ number_format($order->total_amount, 2) }}</p>
                                                <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" data-href="#order">View Order</button>
                                    </div>
                                </div>
                                @empty
                                <div class="bg-white rounded-4 p-3 mb-3 border-start border-5 border-success">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="{{ asset('assets/icons/check-clc.svg') }}" width="20" alt="OK">
                                        </div>
                                        <div>
                                            <h6 style="color:#004494;" class="mb-1">All caught up!</h6>
                                            <p style="color:#004494;" class="mb-0 small">No pending notifications at this time.</p>
                                        </div>
                                    </div>
                                </div>
                                @endforelse

                                @if($store && $store->store_status === 'active')
                                <div class="bg-white rounded-4 p-3 mb-3 border-start border-5 border-warning">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img src="{{ asset('assets/icons/star.svg') }}" width="20" alt="Review">
                                        </div>
                                        <div>
                                            <h6 style="color:#004494;" class="mb-1">Store Active</h6>
                                            <p style="color:#004494;" class="mb-0 small">Your store <strong>{{ $store->store_name }}</strong> is live and visible to buyers.</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="ntf-unread">
                                <div class="text-center py-5">
                                    <p style="color:#fff;font-size:0.85rem;">{{ $orders->where('status','pending')->count() > 0 ? $orders->where('status','pending')->count() . ' unread order(s) awaiting your action.' : 'No unread notifications.' }}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ntf-orders">
                                <div class="text-center py-5">
                                    <p style="color:#fff;font-size:0.85rem;">{{ $orders->count() }} total orders found.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ntf-system">
                                <div class="bg-white rounded-4 p-3 mb-3">
                                    <h6 style="color:#004494;" class="mb-1">Welcome to Merketar!</h6>
                                    <p style="color:#004494;" class="mb-0 small">Your seller account is active. Start adding products to your store.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-center flex-shrink-0">
                            <a href="#storeSettings" class="text-white text-decoration-underline" style="font-size:0.8rem;">Configure Notification Preferences</a>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── SUPPORT ── --}}
            <div id="support" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer d-flex flex-column" style="background-color:#004494;overflow:hidden;">
                    <div class="d-flex flex-column h-100 w-100" style="min-height:0;">

                        <h5 class="mb-3 fw-bold flex-shrink-0">Support Center</h5>

                        <div class="row flex-grow-1" style="min-height:0;">

                            {{-- Left: Quick Help --}}
                            <div class="col-md-4 d-flex flex-column" style="min-height:0;">
                                <div class="bg-white rounded-4 p-3 h-100 d-flex flex-column" style="min-height:0;overflow:auto;">
                                    <h6 style="color:#004494;" class="mb-3">Quick Help</h6>
                                    <div class="mb-4 flex-shrink-0">
                                        <h6 style="color:#004494;">FAQ</h6>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action border-0 py-2" style="color:#004494;font-size:13px;">How to manage orders?</a>
                                            <a href="#" class="list-group-item list-group-item-action border-0 py-2" style="color:#004494;font-size:13px;">Payment issues</a>
                                            <a href="#" class="list-group-item list-group-item-action border-0 py-2" style="color:#004494;font-size:13px;">Product listing guidelines</a>
                                            <a href="#" class="list-group-item list-group-item-action border-0 py-2" style="color:#004494;font-size:13px;">Shipping &amp; delivery</a>
                                        </div>
                                    </div>
                                    <div class="mt-auto flex-shrink-0">
                                        <h6 style="color:#004494;">Contact Support</h6>
                                        <div style="color:#004494;font-size:13px;">
                                            <p class="mb-1"><strong>Email:</strong><br>support@merketar.com</p>
                                            <p class="mb-1"><strong>Phone:</strong><br>+234 800 MERKETAR</p>
                                            <p class="mb-0"><strong>Hours:</strong><br>24/7 Support Available</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right: Submit Ticket --}}
                            <div class="col-md-8 mt-4 mt-md-0 d-flex flex-column" style="min-height:0;">
                                <div class="bg-white rounded-4 p-3 h-100 d-flex flex-column" style="min-height:0;overflow:auto;">
                                    <h6 style="color:#004494;" class="mb-3 flex-shrink-0">Submit a Ticket</h6>

                                    <form id="supportForm" class="d-flex flex-column flex-grow-1" style="min-height:0;">
                                        <div class="mb-3">
                                            <label class="form-label" style="color:#004494;">Subject</label>
                                            <select class="form-select" style="color:#004494;">
                                                <option value="">Select issue type</option>
                                                <option>Technical Issue</option>
                                                <option>Payment Problem</option>
                                                <option>Account Issue</option>
                                                <option>Product Listing</option>
                                                <option>Order Dispute</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 flex-grow-1 d-flex flex-column" style="min-height:0;">
                                            <label class="form-label" style="color:#004494;">Description</label>
                                            <textarea class="form-control flex-grow-1" style="min-height:80px;color:#004494;" placeholder="Describe your issue in detail..."></textarea>
                                        </div>
                                        <div class="mb-3 flex-shrink-0">
                                            <label class="form-label" style="color:#004494;">Attachments <small>(Optional)</small></label>
                                            <input type="file" class="form-control" multiple style="color:#004494;">
                                            <small class="text-muted">Upload screenshots or documents (Max 5 files, 10MB each)</small>
                                        </div>
                                        <div class="mb-3 flex-shrink-0">
                                            <label class="form-label" style="color:#004494;">Priority</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority" id="pLow" checked>
                                                <label class="form-check-label" style="color:#004494;" for="pLow">Low — General inquiry</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority" id="pMedium">
                                                <label class="form-check-label" style="color:#004494;" for="pMedium">Medium — Needs attention</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="priority" id="pHigh">
                                                <label class="form-check-label" style="color:#004494;" for="pHigh">High — Urgent issue affecting sales</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-2 flex-shrink-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="emailUpdates" checked>
                                                <label class="form-check-label" style="color:#004494;" for="emailUpdates">Send me email updates</label>
                                            </div>
                                            <button type="submit" class="pri-btn">Submit Ticket</button>
                                        </div>
                                    </form>

                                    <div class="mt-3 flex-shrink-0">
                                        <h6 style="color:#004494;">Recent Support Tickets</h6>
                                        <div style="max-height:80px;overflow-y:auto;">
                                            <p style="color:#666;font-size:12px;text-align:center;">No tickets submitted yet.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 text-center flex-shrink-0">
                            <button class="pri-btn d-inline-flex align-items-center gap-2">
                                <img src="{{ asset('assets/icons/chat-dots.svg') }}" width="18">
                                Start Live Chat
                            </button>
                            <p class="text-white mt-2 small">Average wait time: <strong>3 minutes</strong></p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ── DYNAMIC: PER-CATEGORY PRODUCT VIEW ── --}}
            @foreach($categoriesWithProducts as $item)
            <div id="category-{{ $item['category']->id }}" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column align-items-center w-100 h-100" style="min-height:0;position:relative;">

                        <a style="position:absolute;top:5px;left:10px;color:#fff;" data-href="#store">
                            <img src="{{ asset('assets/icons/arrow-90.svg') }}" alt="back" width="14"> Back
                        </a>

                        <div><h5 class="fw-bold">{{ $item['category']->name }}</h5></div>

                        <div class="d-flex flex-column align-items-center gap-3 py-4 w-100" style="flex:1;overflow:scroll;">
                            @if($item['products']->isEmpty())
                                <p style="font-size:0.75rem;color:#fff;" class="text-center">No products yet. Click "Add Product" to get started.</p>
                            @else
                                <div class="d-flex flex-wrap gap-4 w-100 justify-content-start">
                                @foreach($item['products'] as $product)
                                <div class="modern-product-card">
                                    <div class="card h-100 border-0 bg-white">
                                        <div class="product-image-wrapper position-relative overflow-hidden">
                                            <div class="image-gradient-overlay"></div>
                                            @if($product->images->count())
                                                <img src="{{ asset('uploads/products/picture/' . $product->images->first()->image_url) }}" class="product-main-image" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('uploads/products/picture/defaultL.jpg') }}" class="product-main-image" alt="{{ $product->name }}">
                                            @endif
                                            <span class="product-status-badge">
                                                ✓ {{ ucfirst($product->status ?? 'active') }}
                                            </span>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="card-title mb-1" style="color:#004494;font-weight:600;">{{ $product->name }}</h6>
                                            <p class="mb-1" style="color:#1E7E34;font-weight:700;font-size:1rem;">₦{{ number_format($product->price, 2) }}</p>
                                            <p class="mb-2" style="color:#666;font-size:11px;">Stock: {{ $product->stock_quantity }}</p>
                                            @if($product->description)
                                            <p class="mb-2" style="color:#888;font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Str::limit($product->description, 60) }}</p>
                                            @endif
                                            <div class="d-flex gap-2">
                                                <button type="button" class="pri-btn flex-grow-1" style="font-size:11px;" data-bs-toggle="modal" data-bs-target="#editProductModal"
                                                    data-id="{{ $product->id }}"
                                                    data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}"
                                                    data-stock="{{ $product->stock_quantity }}"
                                                    data-description="{{ $product->description }}">
                                                    Edit
                                                </button>
                                                <form action="{{ route('seller.product.delete') }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Delete this product?')">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="sec-btn w-100" style="font-size:11px;border:1px solid #dc3545;color:#dc3545;">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                </div>
                            @endif
                        </div>

                        <button type="button" class="pri-btn mt-2" data-href="#add-product-{{ $item['category']->id }}" style="border-radius:20px;">
                            + Add Product to {{ $item['category']->name }}
                        </button>

                    </div>
                </div>
            </div>

            {{-- Add Product Form for this Category --}}
            <div id="add-product-{{ $item['category']->id }}" class="section p-5 h-100 section-first-layer">
                <div class="p-5 h-100 section-second-layer" style="background-color:#004494;">
                    <div class="d-flex flex-column h-100 w-100" style="min-height:0;position:relative;">

                        <a style="position:absolute;top:5px;left:10px;color:#fff;cursor:pointer;" data-href="#category-{{ $item['category']->id }}">
                            <img src="{{ asset('assets/icons/arrow-90.svg') }}" alt="back" width="14"> Back
                        </a>

                        <h5 class="fw-bold text-center mb-3">Add Product to {{ $item['category']->name }}</h5>

                        <div style="overflow-y:scroll;flex:1;">
                            <form action="{{ route('seller.product.add') }}" method="POST" enctype="multipart/form-data" class="w-100" style="max-width:520px;margin:0 auto;">
                                @csrf
                                <input type="hidden" name="category_id" value="{{ $item['category']->id }}">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. iPhone 15 Pro Max" required>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Price (₦) <span class="text-danger">*</span></label>
                                        <input type="number" name="price" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                                        <input type="number" name="stock_quantity" class="form-control" placeholder="0" min="0" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Describe this product..."></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Product Image</label>
                                    <input type="file" name="picture" class="form-control" accept="image/*">
                                    <small class="text-white" style="font-size:11px;">JPG/PNG/WebP, max 2MB</small>
                                </div>

                                <button type="submit" class="pri-btn w-100">Add Product</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

        </section>

    </main>

    {{-- ── EDIT PRODUCT MODAL ── --}}
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:#004494;color:#fff;">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('seller.product.update') }}" method="POST" id="editProductForm">
                    @csrf
                    <input type="hidden" name="product_id" id="editProductId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" id="editProductName" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Price (₦)</label>
                                <input type="number" name="price" id="editProductPrice" class="form-control" step="0.01" min="0" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock_quantity" id="editProductStock" class="form-control" min="0" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="editProductDesc" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="sec-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="pri-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Store location map
    const mapEl = document.getElementById('storeMap');
    if (mapEl) {
        const lat = {{ optional($store)->latitude ?? 6.5244 }};
        const lng = {{ optional($store)->longitude ?? 3.3792 }};
        const map = L.map('storeMap').setView([lat, lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        let marker = L.marker([lat, lng], {draggable: true}).addTo(map);
        function updateInputs(latlng) {
            document.getElementById('storeLatInput').value = latlng.lat;
            document.getElementById('storeLngInput').value = latlng.lng;
        }
        updateInputs({lat, lng});
        marker.on('dragend', function(e) { updateInputs(e.target.getLatLng()); });
        map.on('click', function(e) { marker.setLatLng(e.latlng); updateInputs(e.latlng); });
    }

    // Wallet history toggle (expand/collapse)
    document.querySelectorAll('.h-tgl-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.classList.toggle('toggle-drop');
            const container = this.closest('.history-container');
            if (!container) return;
            const initial = container.querySelector('.initial');
            const moreDetail = container.querySelector('.more-detail');
            if (initial && moreDetail) {
                if (initial.style.display !== 'none') {
                    initial.style.display = 'none';
                    moreDetail.style.display = 'flex';
                } else {
                    moreDetail.style.display = 'none';
                    initial.style.display = 'flex';
                }
            }
        });
    });

    // Edit product modal population
    const editModal = document.getElementById('editProductModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(e) {
            const btn = e.relatedTarget;
            document.getElementById('editProductId').value    = btn.dataset.id;
            document.getElementById('editProductName').value  = btn.dataset.name;
            document.getElementById('editProductPrice').value = btn.dataset.price;
            document.getElementById('editProductStock').value = btn.dataset.stock;
            document.getElementById('editProductDesc').value  = btn.dataset.description;
        });
    }

    // Notification toggles (UI only)
    document.querySelectorAll('#notification').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const isOn = this.src.includes('tgl-icon-on');
            this.src = this.src.replace(isOn ? 'tgl-icon-on' : 'tgl-icon-off', isOn ? 'tgl-icon-off' : 'tgl-icon-on');
        });
    });

    // data-href triggers for category navigation (supplement the bundle.js activateTriggers)
    document.querySelectorAll('[data-href]').forEach(function(el) {
        if (el.tagName === 'A' || el.tagName === 'BUTTON') {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.dataset.href.replace(/^#/, '');
                document.querySelectorAll('.section.active').forEach(s => s.classList.remove('active'));
                const target = document.getElementById(targetId);
                if (target) {
                    target.classList.add('active');
                    sessionStorage.setItem('activeSection', targetId);
                }
            });
        }
    });

});
</script>
@endpush
