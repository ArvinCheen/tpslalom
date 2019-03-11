<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\GameService;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
//        $this->middleware('guest')->except('login', 'logout');
    }

    public function index()
    {
        return view('/admin/login');
    }

    public function login(Request $request)
    {
        $accountId = $request->accountId;
        $password  = $request->password;

        if (\Auth::attempt(['accountId' => $accountId, 'password' => $password], true)) {
            app('request')->session()->flash('success', '登入成功');

            session(['gameSn' => config('app.gameSn')]);

            return redirect('/admin');
        } else {
            $request->session()->flash('error', '帳號密碼錯誤');
            return redirect('/admin/login')->withInput();
        }
    }

    public function logout()
    {
        \Auth::logout();
        app('request')->session()->flash('success', '登出成功');
        return redirect('admin/login');
    }
}
