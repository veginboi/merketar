<?php

namespace App\Http\Controllers;

use App\Models\MerketarAccount;
use App\Models\Order;
use App\Models\Store;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $profile = $user->profile;
        $account = $user->merketarAccount;

        // Fetch all active sellers for the map
        $sellers = Store::with('seller')
            ->where('store_status', 'active')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(fn($s) => [
                'id'          => $s->id,
                'store_name'  => $s->store_name,
                'latitude'    => (float) $s->latitude,
                'longitude'   => (float) $s->longitude,
                'address'     => $s->store_address,
                'picture'     => $s->profile_picture,
            ]);

        $recentOrders = Order::with(['store', 'items.product'])
            ->where('buyer_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        $allOrders = Order::with(['store', 'items.product'])
            ->where('buyer_id', $user->id)
            ->latest()
            ->get();

        return view('buyer.index', compact('user', 'profile', 'account', 'sellers', 'recentOrders', 'allOrders'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate(['picture' => 'required|image|max:2048']);

        $filename = time() . '_' . Auth::id() . '.' . $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->move(public_path('uploads/profilePicture'), $filename);

        Auth::user()->update(['picture' => $filename]);

        return back()->with('success', 'Profile picture updated.');
    }
}
