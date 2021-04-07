<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use DB;
use Illuminate\Http\Request;
use App\Models\ScheduleModel;

class ResultController extends Controller
{
    public function searchResult($order)
    {
        // todo 這裡應該可以帶 schedule id
        $scheduleModel = new ScheduleModel();
        $schedules     = $scheduleModel->getSchedules();
        $schedule      = $scheduleModel->getSchedule($order);

        $enrollData = EnrollModel::where('game_id', env('GAME'))
            ->where('group', $schedule->group)
            ->where('gender', $schedule->gender)
            ->where('item', $schedule->item)
            ->where('level', $schedule->level)
            ->orderBy('rank')
            ->get();

        foreach ($enrollData as $val) {
            if (! is_null($val->finalResult)) {
                $explodeSecond = explode(".", $val->finalResult);
                if ($explodeSecond[0] <> '無成績') {

                    if ($explodeSecond[0] >= 60) {
                        $result = gmdate("i分s秒", $explodeSecond[0]);
                    } else {
                        $result = gmdate("s秒", $explodeSecond[0]);
                    }

                    if (count($explodeSecond) == 2) {
                        $result .= $explodeSecond[1];
                    }

                    $val->finalResult = $result;
                }
            }
        }

        return view('searchResult')
            ->with('schedules', $schedules)
            ->with('schedule', $schedule)
            ->with('order', $order)
            ->with('enrollData', $enrollData)
            ->with('active', '成績查詢');
    }
}
