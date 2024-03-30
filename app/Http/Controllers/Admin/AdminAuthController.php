<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        // return Inertia::render('admin.auth.login');
        return Inertia::render('Admin/Auth/Login');
    }

    public function login(Request $request)
    {
        // if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect()->route('admin.dashboard');
        // }
        if (auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => true])) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }
}
