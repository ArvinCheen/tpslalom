<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\RegistryFeeModel;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $gameInfo = GameModel::find(config('app.game_id'));


        return view('admin/setting')->with(compact('gameInfo'));
    }

    public function update(Request $request)
    {
        $gameInfo = GameModel::find(config('app.game_id'));
        $gameInfo->agency = $request->agency;
        $gameInfo->abridge_name = $request->abridge_name;
        $gameInfo->complete_name = $request->complete_name;
        $gameInfo->letter = $request->letter;
        $gameInfo->game_address = $request->game_address;
        $gameInfo->game_date = $request->game_date;
        $gameInfo->enroll_start_time = $request->enroll_start_time;
        $gameInfo->enroll_close_time = $request->enroll_close_time;
        $gameInfo->errata_close_time = $request->errata_close_time;
        $gameInfo->save();

        return back()->with(['success' => '修改成功']);
    }
}
