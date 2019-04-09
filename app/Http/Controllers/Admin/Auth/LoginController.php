<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\GameService;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('/admin/login');
    }

    public function login(Request $request)
    {
        $account = $request->account;
        $password  = $request->password;

        if (\Auth::attempt(['account' => $account, 'password' => $password], true)) {
            app('request')->session()->flash('success', '登入成功');

            session(['game_id' => config('app.game_id')]);

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
