<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function players()
    {
        $accountId  = auth()->user()->accountId;
        $players = DB::table('player')->where('accountId', $accountId)->orderBy('playerSn')->get();
        return view('players')->with('players', $players);
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
        return redirect('players');
    }

    public function deletePlayer(Request $request)
    {
        $playerSn = $request->playerSn;

        DB::table('player')->where('sn', $playerSn)->delete();
        DB::table('enroll')->where('playerSn', $playerSn)->delete();
        DB::table('registryfee')->where('playerSn', $playerSn)->delete();

        app('request')->session()->flash('success', '刪除選手成功');
        return redirect('players');
    }

    public function ajaxGetPlayer($playerId)
    {
        $player = PlayerModel::find($playerId);
        $player->doubleS = app(EnrollModel::class)->getItemLevel($playerId, '前進雙足S型');
        $player->singleS = app(EnrollModel::class)->getItemLevel($playerId, '前進單足S型');
        $player->cross   = app(EnrollModel::class)->getItemLevel($playerId, '前進交叉型');
        $player->group   = app(EnrollModel::class)->getGroup($playerId);

        return response()->json($player);
    }
}
