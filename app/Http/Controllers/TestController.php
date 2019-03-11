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
        $gameSn = 4;
        $schedules = ScheduleModel::where('gameSn', $gameSn)->get();
        $gameName = GameModel::where('gameSn', $gameSn)->value('completeName');
        $genders = ['男', '女'];

        $locals = ['臺北市', '非北市'];

        return view('test')->with(compact('schedules','locals', 'gameName', 'genders', 'gameSn'));
    }

}
