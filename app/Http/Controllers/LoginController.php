<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin()
    {
       return view('login');
    }

    public function postLogin(LoginRequest $request) 
    {
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
           
           session()->flash('success', 'Đăng nhập thành công');
           return redirect()->route('home');
        } else {
            return back()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('getLogin');
    }
}
