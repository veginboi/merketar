<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSeller
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('seller.login');
        }

        if (Auth::user()->role !== 'seller') {
            Auth::logout();
            return redirect()->route('seller.login')->withErrors(['login' => 'Access denied. Seller account required.']);
        }

        return $next($request);
    }
}
