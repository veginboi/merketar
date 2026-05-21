<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\BuyerAuthController;
use App\Http\Controllers\Auth\SellerAuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;

// ============================================================
//  merketar.com  →  BUYER
// ============================================================
Route::domain(config('app.buyer_domain'))->group(function () {

    // Landing
    Route::get('/', function () {
        return view('buyer.static');
    })->name('home');

    // Auth (guest only)
    Route::middleware('guest')->prefix('auth')->name('buyer.')->group(function () {
        Route::get('/login',             [BuyerAuthController::class, 'showLogin'])->name('login');
        Route::post('/login',            [BuyerAuthController::class, 'login'])->name('login.post');
        Route::get('/signup',            [BuyerAuthController::class, 'showSignup'])->name('signup');
        Route::post('/signup',           [BuyerAuthController::class, 'signupStep1'])->name('signup.post');
        Route::get('/signup/step2',      [BuyerAuthController::class, 'showSignupStep2'])->name('signup.step2');
        Route::post('/signup/step2',     [BuyerAuthController::class, 'signupStep2'])->name('signup.step2.post');
        Route::get('/signup/successful', [BuyerAuthController::class, 'signupSuccess'])->name('signup.success');
    });

    // Logout
    Route::post('/auth/logout', [BuyerAuthController::class, 'logout'])->name('buyer.logout')->middleware('buyer');

    // Dashboard (authenticated buyers only)
    Route::middleware('buyer')->name('buyer.')->group(function () {
        Route::get('/dashboard',         [BuyerController::class, 'index'])->name('dashboard');
        Route::post('/upload-picture',   [BuyerController::class, 'uploadProfilePicture'])->name('upload.picture');
        Route::post('/update-profile',   [BuyerController::class, 'updateProfile'])->name('profile.update');
        Route::post('/order/confirm',    [BuyerController::class, 'confirmDelivery'])->name('order.confirm');
        Route::post('/order/dispute',    [BuyerController::class, 'openDispute'])->name('order.dispute');
    });

});

// ============================================================
//  seller.merketar.com  →  SELLER
// ============================================================
Route::domain(config('app.seller_domain'))->group(function () {

    // Landing
    Route::get('/', function () {
        return view('seller.static');
    })->name('seller.home');

    // Auth (guest only)
    Route::middleware('guest')->prefix('auth')->name('seller.')->group(function () {
        Route::get('/login',             [SellerAuthController::class, 'showLogin'])->name('login');
        Route::post('/login',            [SellerAuthController::class, 'login'])->name('login.post');
        Route::get('/signup',            [SellerAuthController::class, 'showSignup'])->name('signup');
        Route::post('/signup',           [SellerAuthController::class, 'signupStep1'])->name('signup.post');
        Route::get('/signup/step2',      [SellerAuthController::class, 'showSignupStep2'])->name('signup.step2');
        Route::post('/signup/step2',     [SellerAuthController::class, 'signupStep2'])->name('signup.step2.post');
        Route::get('/signup/successful', [SellerAuthController::class, 'signupSuccess'])->name('signup.success');
    });

    // Logout
    Route::post('/auth/logout', [SellerAuthController::class, 'logout'])->name('seller.logout')->middleware('seller');

    // Dashboard (authenticated sellers only)
    Route::middleware('seller')->name('seller.')->group(function () {
        Route::get('/dashboard',         [SellerController::class, 'index'])->name('dashboard');
        Route::post('/create-store',     [SellerController::class, 'createStore'])->name('store.create');
        Route::post('/save-location',    [SellerController::class, 'saveLocation'])->name('location.save');
        Route::post('/add-category',     [SellerController::class, 'addCategory'])->name('category.add');
        Route::post('/delete-category',  [SellerController::class, 'deleteCategory'])->name('category.delete');
        Route::post('/add-product',      [SellerController::class, 'addProduct'])->name('product.add');
        Route::post('/update-product',   [SellerController::class, 'updateProduct'])->name('product.update');
        Route::post('/delete-product',   [SellerController::class, 'deleteProduct'])->name('product.delete');
        Route::post('/upload-picture',   [SellerController::class, 'uploadProfilePicture'])->name('upload.picture');
        Route::post('/change-password',  [SellerController::class, 'changePassword'])->name('settings.password');
        Route::post('/change-username',  [SellerController::class, 'changeUsername'])->name('settings.username');
        Route::post('/upload-cover',     [SellerController::class, 'uploadCoverPhoto'])->name('upload.cover');
        Route::post('/order/accept',     [SellerController::class, 'acceptOrder'])->name('order.accept');
        Route::post('/order/cancel',     [SellerController::class, 'cancelOrder'])->name('order.cancel');
    });

});

// ============================================================
//  adm.merketar.com  →  ADMIN
// ============================================================
Route::domain(config('app.admin_domain'))->group(function () {

    // Landing → redirect to login
    Route::get('/', fn() => redirect()->route('admin.login'))->name('admin.home');

    // Auth (guest only)
    Route::middleware('guest')->name('admin.')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('admin');

    // Dashboard & management (admin only)
    Route::middleware('admin')->name('admin.')->group(function () {
        Route::get('/dashboard',                     [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users',                         [AdminController::class, 'users'])->name('users');
        Route::post('/users/{user}/suspend',         [AdminController::class, 'suspendUser'])->name('users.suspend');
        Route::delete('/users/{user}',               [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/stores',                        [AdminController::class, 'stores'])->name('stores');
        Route::post('/stores/{store}/approve',       [AdminController::class, 'approveStore'])->name('stores.approve');
        Route::post('/stores/{store}/suspend',       [AdminController::class, 'suspendStore'])->name('stores.suspend');
        Route::get('/transactions',                  [AdminController::class, 'transactions'])->name('transactions');
        Route::get('/disputes',                      [AdminController::class, 'disputes'])->name('disputes');
        Route::post('/disputes/{order}/resolve',     [AdminController::class, 'resolveDispute'])->name('disputes.resolve');
        Route::get('/analytics',                     [AdminController::class, 'analytics'])->name('analytics');
    });

});
