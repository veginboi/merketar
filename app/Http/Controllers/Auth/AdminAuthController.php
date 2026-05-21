<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $login    = strtolower(trim($request->input('login')));
        $password = trim($request->input('password'));

        if (empty($login) || empty($password)) {
            return back()->withErrors(['login' => 'All fields are required.'])->withInput();
        }

        $user = User::where('username', $login)->orWhere('email', $login)->first();

        if (!$user || !Hash::check($password, $user->password_hash)) {
            return back()->withErrors(['login' => 'Invalid credentials.'])->withInput();
        }

        if ($user->role !== 'admin') {
            return back()->withErrors(['login' => 'Access denied. Admin account required.'])->withInput();
        }

        if ($user->status === 'inactive') {
            return back()->withErrors(['login' => 'Account is inactive.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
