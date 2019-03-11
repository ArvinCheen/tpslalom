<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Model\EnrollModel;
use App\Services\ResultService;

class TeamController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function teamList()
    {
        $enrollQuery = new EnrollModel();

        $gameList = $enrollQuery->getGameList();

        return view('admin/game/gameList')
            ->with('gameList', $gameList);
    }

    public function editAccount()
    {
        dd(1);
        $accountId = app('request')->user();
        dd($accountId);
    }



}
