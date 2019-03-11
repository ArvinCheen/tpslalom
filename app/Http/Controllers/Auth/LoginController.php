<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\GameService;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
//        $this->middleware('guest')->except('logout', 'admi/dev.tpslalomnLogout');
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $accountId = $request->accountId;
        $password  = $request->password;

        if (\Auth::attempt(['accountId' => $accountId, 'password' => $password], true)) {
            app('request')->session()->flash('success', '登入成功');



            return redirect('/');
        } else {
            $request->session()->flash('error', '帳號密碼錯誤');
            return redirect('/login')->withInput();
        }
    }

    public function logout()
    {
        \Auth::logout();
        session()->flush();
        app('request')->session()->flash('success', '登出成功');
        return redirect('login');
    }
}
