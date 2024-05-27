<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLoginPage()
    {
        if (!Auth::check()) {
            return view('backend.auth.login');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function adminLogin(LoginRequest $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect()->route('dashboard');
            } else {
                return back()->with('fail', 'Email or password is incorrect!');
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'Something went wrong! Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
