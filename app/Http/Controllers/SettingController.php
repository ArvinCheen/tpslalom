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
        $gameInfo     = GameModel::find(config('app.game_id'));
        $completeName = $gameInfo->complete_name;
        $letterOne    = explode(' ', $gameInfo->letter)[0];
        $letterTwo    = isset(explode(' ', $gameInfo->letter)[1]) ? explode(' ', $gameInfo->letter)[1] : null;

        return view('admin/setting')->with(compact('completeName', 'letterOne', 'letterTwo'));
    }

    public function update(Request $request)
    {
        $gameInfo                = GameModel::find(config('app.game_id'));
        $gameInfo->complete_name = $request->completeName;
        $gameInfo->letter        = $request->letterOne . ' ' . $request->letterTwo;
        $gameInfo->save();

        return back()->with(['success' => '修改成功']);
    }
}
