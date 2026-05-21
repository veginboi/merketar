<?php

namespace App\Http\Controllers;

use App\Models\MerketarAccount;
use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $stats = [
            'total_buyers'   => User::where('role', 'buyer')->count(),
            'total_sellers'  => User::where('role', 'seller')->count(),
            'total_orders'   => Order::count(),
            'pending_stores' => Store::where('store_status', 'pending')->count(),
            'total_revenue'  => Order::where('status', 'completed')->sum('total_amount'),
            'active_stores'  => Store::where('store_status', 'active')->count(),
        ];

        $recentUsers  = User::whereIn('role', ['buyer', 'seller'])->latest()->take(10)->get();
        $pendingStores = Store::with('seller')->where('store_status', 'pending')->latest()->take(10)->get();
        $recentOrders  = Order::with(['buyer', 'store'])->latest()->take(10)->get();
        $disputes      = Order::with(['buyer', 'store'])->where('status', 'disputed')->latest()->get();

        return view('admin.index', compact('stats', 'recentUsers', 'pendingStores', 'recentOrders', 'disputes'));
    }

    // --- Users ---
    public function users(Request $request)
    {
        $role  = $request->query('role', 'all');
        $query = User::with('profile');

        if (in_array($role, ['buyer', 'seller', 'admin'])) {
            $query->where('role', $role);
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users', compact('users', 'role'));
    }

    public function suspendUser(User $user)
    {
        $user->update(['status' => $user->status === 'suspended' ? 'active' : 'suspended']);

        return back()->with('success', "User {$user->username} " . ($user->status === 'suspended' ? 'suspended' : 'reactivated') . '.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted.');
    }

    // --- Sellers / Stores ---
    public function stores(Request $request)
    {
        $status = $request->query('status', 'all');
        $query  = Store::with('seller');

        if (in_array($status, ['active', 'pending', 'inactive'])) {
            $query->where('store_status', $status);
        }

        $stores = $query->latest()->paginate(20);

        return view('admin.stores', compact('stores', 'status'));
    }

    public function approveStore(Store $store)
    {
        $store->update(['store_status' => 'active']);

        return back()->with('success', "Store \"{$store->store_name}\" approved.");
    }

    public function suspendStore(Store $store)
    {
        $store->update(['store_status' => $store->store_status === 'inactive' ? 'active' : 'inactive']);

        return back()->with('success', "Store \"{$store->store_name}\" status updated.");
    }

    // --- Transactions / Orders ---
    public function transactions(Request $request)
    {
        $status = $request->query('status', 'all');
        $query  = Order::with(['buyer', 'store']);

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.transactions', compact('orders', 'status'));
    }

    // --- Disputes ---
    public function disputes()
    {
        $disputes = Order::with(['buyer', 'store'])
            ->where('status', 'disputed')
            ->latest()
            ->paginate(20);

        return view('admin.disputes', compact('disputes'));
    }

    public function resolveDispute(Request $request, Order $order)
    {
        $resolution = $request->input('resolution');

        if ($resolution === 'refund') {
            $order->update(['status' => 'refunded']);
        } elseif ($resolution === 'release') {
            $order->update(['status' => 'completed', 'buyer_confirmed' => true]);
        }

        return back()->with('success', 'Dispute resolved.');
    }

    // --- Analytics ---
    public function analytics()
    {
        $monthlyOrders = Order::selectRaw("DATE_TRUNC('month', created_at) as month, COUNT(*) as count, SUM(total_amount) as revenue")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        $topSellers = Store::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        return view('admin.analytics', compact('monthlyOrders', 'topSellers'));
    }
}
