<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Services\PlayerService;
use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function index()
    {
        $accountService = new AccountService();
        $playerService  = new PlayerService();

        $account = $accountService->getAccount();
        $players = $playerService->getPlayers();

        return view('account/index')
            ->with(compact('players'))
            ->with(compact('account'));
    }

    public function update(Request $request)
    {
        $accountService = new AccountService();

        if ($accountService->update($request)) {
            $request->session()->flash('success', '修改帳戶成功');
        } else {
            $request->session()->flash('errpr', '修改帳戶失敗');
        }

        return back();
    }
}
