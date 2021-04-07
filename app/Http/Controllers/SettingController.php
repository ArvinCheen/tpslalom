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
        $gameInfo = GameModel::find(env('GAME'));

        return view('admin/setting')->with(compact('gameInfo'));
    }

    public function update(Request $request)
    {
        $gameInfo = GameModel::find(env('GAME'));

        $gameInfo->complete_name    = $request->completeName;
        $gameInfo->letter           = $request->letterOne . ' ' . $request->letterTwo;
        $gameInfo->is_open_enroll   = $request->is_open_enroll == 'on' ? 1 : 0;
        $gameInfo->is_open_document = $request->is_open_document == 'on' ? 1 : 0;

        $gameInfo->save();

        return back()->with(['success' => '修改成功']);
    }
}
