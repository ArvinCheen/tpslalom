<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\PlayerModel;
use App\Services\PlayerService;
use Illuminate\Http\Request;
use App\Services\AccountService;
use Log;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = AccountModel::get();

        return view('admin.accounts')->with(compact('accounts'));
    }

    public function edit($accountId)
    {
        $account = AccountModel::find($accountId);

        return view('admin.accountEdit', compact('account'));
    }

    public function update(Request $request)
    {
        try {
            $account = AccountModel::find($request->accountId);

            $account->account   = $request->account;
            $account->email     = $request->email;
            $account->team_name = $request->team_name;
            $account->phone     = $request->phone;
            $account->address   = $request->address;
            $account->coach     = $request->coach;
            $account->leader    = $request->leader;
            $account->manager   = $request->manager;
            $account->save();
            return redirect('admin/account')->with(['success' => '修改帳戶成功']);
        } catch (\Exception $e) {
            Log::error("[AccountController@update] 修改帳號失敗", [$e->getMessage()]);
            return back()->with(['errpr' => '修改帳戶失敗']);
        }
    }
}
