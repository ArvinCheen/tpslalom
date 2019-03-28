<?php

namespace App\Http\Controllers;

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
        $account = AccountModel::find(auth()->user()->id);

        $players = app(PlayerModel::class)->getPlayers();

        return view('account/index')->with(compact('players', 'account'));
    }

    public function update(Request $request)
    {
        try {
            AccountModel::where('id', $request->accountId)->update([
                'email'      => $request->email,
                'team_name'  => $request->teamName,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'coach'      => $request->coach,
                'leader'     => $request->leader,
                'management' => $request->management,
            ]);

            return back()->with(['success' => '修改帳戶成功']);
        } catch (\Exception $e) {
            Log::error("[AccountController@update] 修改帳號失敗", [$e->getMessage()]);
            return back()->with(['errpr' => '修改帳戶失敗']);
        }
    }
}
