<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class DrawLotsController extends Controller
{
    public function drawLots()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            if ($schedule->item == '雙人花式繞樁') {
                $this->setDoubleFreeStyle();
            } else {
                $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $schedule->id)->first();

                $enrolls = EnrollModel::select('enroll.id')->where('game_id', config('app.game_id'))
                    ->leftJoin('player', 'player.id', 'enroll.player_id')
                    ->where('game_id', config('app.game_id'))
                    ->where('group', $gameInfo->group)
                    ->where('item', $gameInfo->item)
                    ->where('gender', $gameInfo->gender)
                    ->inRandomOrder()
                    ->get();

                foreach ($enrolls as $key => $enroll) {
                    $enroll->appearance = $key + 1;
                    $enroll->save();
                }
            }
        }

        return back()->with(['success' => '抽籤完畢']);
    }

    public function setDoubleFreeStyle()
    {
        $playerNumber = [
            ['0002', '0449'],
            ['0737', '0745'],
            ['0744', '0797'],
            ['0781', '0796'],
            ['0798', '0394'],
        ];

        shuffle($playerNumber);

        foreach ($playerNumber as $key => $val) {
            EnrollModel::select('enroll.id')->where('game_id', config('app.game_id'))->where('item','雙人花式繞樁')->whereIn('player_number', $val)->update(['appearance' => $key + 1]);
        }
    }

    public function clear()
    {
        EnrollModel::where('game_id', config('app.game_id'))->update(['appearance' => null]);

        return back()->with(['success' => '已清空出場序資料']);
    }
}
