<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MerketarAccount;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BuyerAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.buyer.login');
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
            return back()->withErrors(['login' => 'Invalid login credentials.'])->withInput();
        }

        if ($user->status === 'inactive') {
            return back()->withErrors(['login' => 'Account is inactive.'])->withInput();
        }

        if ($user->role === 'seller') {
            return back()->withErrors(['login' => "This is a Buyer's platform. Go to seller login."])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('buyer.dashboard');
    }

    public function showSignup()
    {
        return view('auth.buyer.signup');
    }

    public function signupStep1(Request $request)
    {
        $username  = strtolower(trim($request->input('username')));
        $email     = strtolower(trim($request->input('email')));
        $password  = trim($request->input('password'));
        $cPassword = trim($request->input('confirmPassword'));

        $errors = [];

        if (empty($username)) {
            $errors['username'] = 'Username is required.';
        } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,19}$/', $username)) {
            $errors['username'] = '3–20 chars, start with a letter; letters & numbers only.';
        } elseif (User::where('username', $username)->exists()) {
            $errors['username'] = 'Username already in use.';
        }

        if (empty($email)) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is invalid.';
        } elseif (User::where('email', $email)->exists()) {
            $errors['email'] = 'Email already in use.';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is required.';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            $errors['password'] = '8+ chars, uppercase, lowercase, number & symbol required.';
        }

        if (empty($cPassword)) {
            $errors['confirmPassword'] = 'Confirm password is required.';
        } elseif ($password !== $cPassword) {
            $errors['confirmPassword'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput(['username' => $username, 'email' => $email]);
        }

        $request->session()->put('buyer_signup_step1', [
            'username' => $username,
            'email'    => $email,
            'password' => Hash::make($password),
            'role'     => 'buyer',
            'status'   => 'active',
        ]);

        return redirect()->route('buyer.signup.step2');
    }

    public function showSignupStep2()
    {
        if (!session()->has('buyer_signup_step1')) {
            return redirect()->route('buyer.signup');
        }

        return view('auth.buyer.signup-step2');
    }

    public function signupStep2(Request $request)
    {
        if (!session()->has('buyer_signup_step1')) {
            return redirect()->route('buyer.signup');
        }

        $firstName   = ucfirst(strtolower(trim($request->input('first_name', ''))));
        $midName     = ucfirst(strtolower(trim($request->input('mid_name', ''))));
        $lastName    = ucfirst(strtolower(trim($request->input('last_name', ''))));
        $phoneCode   = $request->input('phone_code', '+234');
        $phone       = trim($request->input('phone', ''));
        $gender      = $request->input('gender', 'male');
        $dob         = $request->input('dob', '');
        $addressLine = ucfirst(strtolower(trim($request->input('address_line', ''))));
        $state       = ucfirst(strtolower(trim($request->input('state', ''))));
        $city        = ucfirst(strtolower(trim($request->input('city', ''))));
        $postalCode  = trim($request->input('postal_code', ''));
        $country     = trim($request->input('country', 'Nigeria'));
        $nationality = trim($request->input('nationality', 'Nigerian'));

        $errors = [];

        if (empty($firstName) || !preg_match('/^[A-Za-z]+$/', $firstName)) {
            $errors['first_name'] = empty($firstName) ? 'First name is required.' : 'Letters only.';
        }
        if (!empty($midName) && !preg_match('/^[A-Za-z]+$/', $midName)) {
            $errors['mid_name'] = 'Letters only.';
        }
        if (empty($lastName) || !preg_match('/^[A-Za-z]+$/', $lastName)) {
            $errors['last_name'] = empty($lastName) ? 'Last name is required.' : 'Letters only.';
        }
        if (empty($phone)) {
            $errors['phone'] = 'Phone number is required.';
        } elseif (!preg_match('/^[789][01]\d{8}$/', $phone)) {
            $errors['phone'] = 'Invalid Nigerian phone number.';
        } elseif (UserProfile::where('phone_number', $phone)->exists()) {
            $errors['phone'] = 'Phone number already in use.';
        }
        if (empty($addressLine)) {
            $errors['address_line'] = 'Address is required.';
        }
        if (empty($state)) {
            $errors['state'] = 'State is required.';
        }
        if (empty($city)) {
            $errors['city'] = 'City is required.';
        }
        if (empty($postalCode) || !preg_match('/^\d+$/', $postalCode)) {
            $errors['postal_code'] = empty($postalCode) ? 'Postal code is required.' : 'Numbers only.';
        }
        if (empty($nationality)) {
            $errors['nationality'] = 'Nationality is required.';
        }

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $step1 = session('buyer_signup_step1');
        $fullname = trim("$firstName $midName $lastName");

        try {
            \DB::transaction(function () use ($step1, $firstName, $midName, $lastName, $phoneCode, $phone, $gender, $dob, $addressLine, $state, $city, $postalCode, $country, $nationality, $fullname) {

                $user = User::create([
                    'username'      => $step1['username'],
                    'email'         => $step1['email'],
                    'password_hash' => $step1['password'],
                    'role'          => $step1['role'],
                    'status'        => $step1['status'],
                ]);

                UserProfile::create([
                    'user_id'       => $user->id,
                    'first_name'    => $firstName,
                    'last_name'     => $lastName,
                    'middle_name'   => $midName,
                    'phone_code'    => $phoneCode,
                    'phone_number'  => $phone,
                    'gender'        => $gender,
                    'date_of_birth' => $dob ?: null,
                    'address_line'  => $addressLine,
                    'state'         => $state,
                    'city'          => $city,
                    'postal_code'   => $postalCode,
                    'country'       => $country,
                    'nationality'   => $nationality,
                ]);

                MerketarAccount::create([
                    'user_id'          => $user->id,
                    'account_number'   => $phone,
                    'account_fullname' => $fullname,
                    'balance'          => 0.00,
                    'currency'         => 'NGN',
                    'account_status'   => 'active',
                ]);
            });

            session()->forget('buyer_signup_step1');

            return redirect()->route('buyer.signup.success');

        } catch (\Exception $e) {
            return back()->withErrors(['general' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    public function signupSuccess()
    {
        return view('auth.buyer.signup-success');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('buyer.login');
    }
}
