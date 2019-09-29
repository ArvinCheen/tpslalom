<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\CheckInService;
use App\Services\ScheduleService;

class DrawLotsController extends Controller
{
    public function drawLots()
    {
        $numberOfAppearance = app(EnrollModel::class)->where('game_id', config('app.game_id'))->whereNull('appearance')->count();

        if ($numberOfAppearance == 0) {
            return back()->with(['error' => '已抽籤過，無法再抽']);
        }

        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $schedule->id)->first();

            $enrolls = EnrollModel::select('enroll.id')->where('game_id', config('app.game_id'))
                ->leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('level', $gameInfo->level)
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item);

            if ($schedule->gender <> '不分組') {
                $enrolls->where('gender', $gameInfo->gender);
            }

            $enrolls = $enrolls->inRandomOrder()->get();

            foreach ($enrolls as $key => $enroll) {
                $enroll->appearance = $key + 1;
                $enroll->save();
            }
        }

        return back()->with(['success' => '抽籤完畢']);
    }

    public function clear()
    {
        EnrollModel::where('game_id', config('app.game_id'))->update(['appearance' => null]);

        return back()->with(['success' => '已清空出場序資料']);
    }
}
