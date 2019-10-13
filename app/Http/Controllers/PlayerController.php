<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use DB;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    public function deletePlayer(Request $request)
    {
        // todo 這裡應該做成軟刪除

        $playerId = $request->playerSn;

        DB::table('player')->where('id', $playerId)->delete();
        DB::table('enroll')->where('player_id', $playerId)->delete();
        DB::table('registry_fee')->where('player_id', $playerId)->delete();

        app('request')->session()->flash('success', '刪除選手成功');
        return redirect('players');
    }

    public function ajaxGetPlayer($playerId)
    {
        return response()->json([
            'player'  => PlayerModel::find($playerId),
            'enrolls' => EnrollModel::where('game_id', config('app.game_id'))->where('player_id', $playerId)->get()
        ]);
    }
}
