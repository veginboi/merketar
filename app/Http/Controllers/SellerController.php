<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MerketarAccount;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $profile = $user->profile;
        $account = $user->merketarAccount;
        $store   = $user->store;

        $categoriesWithProducts = [];
        $storeDisplay = 'none';
        $createStore  = 'flex';

        if ($store && $store->store_status === 'active') {
            $storeDisplay = 'flex';
            $createStore  = 'none';

            $categories = Category::where('store_id', $store->id)->get();
            foreach ($categories as $category) {
                $products = Product::with(['images', 'variants.attributes'])
                    ->where('category_id', $category->id)
                    ->where('store_id', $store->id)
                    ->get();

                $categoriesWithProducts[] = [
                    'category' => $category,
                    'products' => $products,
                ];
            }
        }

        $orders = Order::with(['buyer', 'items.product'])
            ->where('store_id', optional($store)->id)
            ->latest()
            ->get();

        return view('seller.index', compact(
            'user', 'profile', 'account', 'store',
            'categoriesWithProducts', 'storeDisplay', 'createStore', 'orders'
        ));
    }

    public function createStore(Request $request)
    {
        $user = Auth::user();

        $existing = Store::where('seller_id', $user->id)->where('store_status', 'active')->first();
        if ($existing) {
            return back()->with('error', 'You already have an active Merketar store.');
        }

        $request->validate([
            'store_name'        => 'required|string|max:100',
            'store_description' => 'nullable|string|max:300',
            'store_address'     => 'nullable|string|max:200',
        ]);

        Store::updateOrCreate(
            ['seller_id' => $user->id],
            [
                'store_name'        => $request->input('store_name'),
                'store_description' => $request->input('store_description'),
                'store_address'     => $request->input('store_address'),
                'store_status'      => 'active',
            ]
        );

        return back()->with('success', 'Store created successfully!');
    }

    public function saveLocation(Request $request)
    {
        $store = Auth::user()->store;
        if (!$store) {
            return back()->withErrors(['error' => 'No store found.']);
        }

        $store->update([
            'latitude'  => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return back()->with('success', 'Location saved.');
    }

    public function addCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $store = Auth::user()->store;
        if (!$store) return back()->withErrors(['error' => 'No store found.']);

        Category::create([
            'store_id' => $store->id,
            'name'     => $request->input('name'),
        ]);

        return back()->with('success', 'Category added.');
    }

    public function deleteCategory(Request $request)
    {
        $store = Auth::user()->store;
        Category::where('id', $request->input('category_id'))
            ->where('store_id', optional($store)->id)
            ->delete();

        return back()->with('success', 'Category deleted.');
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:200',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|integer',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $store = Auth::user()->store;
        if (!$store) return back()->withErrors(['error' => 'No store found.']);

        $pictureName = 'defaultL.jpg';
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $pictureName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products/picture'), $pictureName);
        }

        Product::create([
            'store_id'       => $store->id,
            'category_id'    => $request->input('category_id'),
            'name'           => $request->input('name'),
            'description'    => $request->input('description'),
            'price'          => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
            'picture'        => $pictureName,
        ]);

        return back()->with('success', 'Product added.');
    }

    public function updateProduct(Request $request)
    {
        $store = Auth::user()->store;
        $product = Product::where('id', $request->input('product_id'))
            ->where('store_id', optional($store)->id)
            ->firstOrFail();

        $product->update([
            'name'           => $request->input('name'),
            'description'    => $request->input('description'),
            'price'          => $request->input('price'),
            'stock_quantity' => $request->input('stock_quantity'),
        ]);

        return back()->with('success', 'Product updated.');
    }

    public function deleteProduct(Request $request)
    {
        $store = Auth::user()->store;
        Product::where('id', $request->input('product_id'))
            ->where('store_id', optional($store)->id)
            ->delete();

        return back()->with('success', 'Product deleted.');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate(['picture' => 'required|image|max:2048']);

        $filename = time() . '_' . Auth::id() . '.' . $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->move(public_path('uploads/profilePicture'), $filename);

        Auth::user()->update(['picture' => $filename]);

        return back()->with('success', 'Profile picture updated.');
    }

    public function uploadCoverPhoto(Request $request)
    {
        $request->validate(['cover' => 'required|image|max:5120']);

        $filename = time() . '_cover_' . Auth::id() . '.' . $request->file('cover')->getClientOriginalExtension();
        $request->file('cover')->move(public_path('uploads/coverPhoto'), $filename);

        $store = Auth::user()->store;
        if ($store) {
            $store->update(['cover_photo' => $filename]);
        }

        return back()->with('success', 'Cover photo updated.');
    }

    public function acceptOrder(Request $request)
    {
        $store = Auth::user()->store;
        $order = \App\Models\Order::where('id', $request->input('order_id'))
            ->where('store_id', optional($store)->id)
            ->firstOrFail();
        $order->update(['status' => 'processing']);
        return back()->with('success', 'Order accepted.');
    }

    public function cancelOrder(Request $request)
    {
        $store = Auth::user()->store;
        $order = \App\Models\Order::where('id', $request->input('order_id'))
            ->where('store_id', optional($store)->id)
            ->firstOrFail();
        $order->update(['status' => 'refunded']);
        return back()->with('success', 'Order cancelled.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('current_password'), $user->getAuthPassword())) {
            return back()->withErrors(['error' => 'Current password is incorrect.']);
        }

        $user->update(['password_hash' => Hash::make($request->input('new_password'))]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function changeUsername(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|min:3|max:24|unique:users,username,' . Auth::id(),
        ]);

        Auth::user()->update(['username' => $request->input('new_username')]);

        return back()->with('success', 'Username updated successfully.');
    }
}
