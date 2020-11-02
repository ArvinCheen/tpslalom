<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SlackNotify;
use App\Models\AccountModel;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class RegisterController extends Controller
{
    public function index()
    {
        \Auth::logout();
        return view('auth/register');
    }

    public function register(Request $request)
    {
        $account  = $request->account;
        $password = $request->password;
        $email    = $request->email;
        $teamName = $request->teamName;
        $phone    = $request->phone;
        $coach    = $request->coach;
        $leader   = $request->leader;
        $manager  = $request->manager;
        $address  = $request->address;

        if ($account == '' || $email == '' || $teamName == '' || $phone == '' || $coach == '') {
            return back()->with(['error' => '請輸入必填欄位']);
        }

        if (app(AccountModel::class)->isAccountExist($account)) {
            return back()->with(['error' => '帳號重覆'])->withInput();
        } else {
            try {
                DB::beginTransaction();
                AccountModel::create([
                    'account'   => $account,
                    'password'  => bcrypt($password),
                    'email'     => $email,
                    'team_name' => $teamName,
                    'phone'     => $phone,
                    'coach'     => $coach,
                    'leader'    => $leader,
                    'manager'   => $manager,
                    'address'   => $address,
                ]);

                app()->make(SlackNotify::class)->setMsg("註冊成功：{$account}")->notify();

                Auth::attempt(['account' => $request->account, 'password' => $request->password], true);

                DB::commit();
            } catch (\Exception $e) {
                Log::error("[EnrollController@cancel] 取消報名失敗", [$e->getMessage()]);
                DB::rollBack();
                return back()->with(['error' => '帳號註冊失敗'])->withInput();
            }

            return redirect('/')->with(['success' => '註冊成功']);
        }
    }
}
