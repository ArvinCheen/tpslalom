<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\ResultService;
use App\Services\SearchService;
use App\Services\ScheduleService;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $gameId = 4;
        $schedules = ScheduleModel::where('game_id', $gameId)->get();
        $gameName = GameModel::where('game_id', $gameId)->value('completeName');
        $genders = ['男', '女'];

        $locals = ['臺北市', '非北市'];

        return view('test')->with(compact('schedules','locals', 'gameName', 'genders', 'game_id'));
    }

}
