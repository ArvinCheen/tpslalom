<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function playerList()
    {
        $accountId  = auth()->user()->accountId;
        $playerList = DB::table('player')->where('accountId', $accountId)->orderBy('playerSn')->get();
        return view('playerList')->with('playerList', $playerList);
    }

    public function editPlayer($playerSn)
    {
        $playerData = DB::table('player')->where('sn', $playerSn)->first();

        return view('editPlayer')->with('playerData', $playerData);
    }

    public function updatePlayer(Request $request)
    {
        $playerSn = $request->playerSn;
        $name     = $request->name;
        $gender   = $request->gender;
        $city     = $request->city;
        $agency   = $request->agency;

        $updateData = [
            'name'   => $name,
            'gender' => $gender,
            'city'   => $city,
            'agency' => $agency,
        ];

        DB::table('player')->where('sn', $playerSn)->update($updateData);

        $request->session()->flash('success', '修改成功');
        return redirect('playerList');
    }

    public function deletePlayer(Request $request)
    {
        $playerSn = $request->playerSn;

        DB::table('player')->where('sn', $playerSn)->delete();
        DB::table('enroll')->where('playerSn', $playerSn)->delete();
        DB::table('registryfee')->where('playerSn', $playerSn)->delete();

        app('request')->session()->flash('success', '刪除選手成功');
        return redirect('playerList');
    }

    public function ajaxGetPlayer($playerSn)
    {
        $playerService = new PlayerService();

        $player = $playerService->getPlayerWithEnrollInfo($playerSn);

        return response()->json($player);
    }
}
