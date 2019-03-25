<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\GameService;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $account  = $request->account;
        $password = $request->password;

        if (\Auth::attempt(['account' => $account, 'password' => $password], true)) {
            return redirect('/')->with(['success' => '登入成功']);
        } else {
            return redirect('/login')->with(['error' => '帳號密碼錯誤']);
        }
    }

    public function logout()
    {
        \Auth::logout();

        session()->flush();

        return redirect('login')->with(['success' => '登出成功']);
    }
}
