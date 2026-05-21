<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureBuyer
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('buyer.login');
        }

        if (Auth::user()->role !== 'buyer') {
            Auth::logout();
            return redirect()->route('buyer.login')->withErrors(['login' => 'Access denied. Buyer account required.']);
        }

        return $next($request);
    }
}
