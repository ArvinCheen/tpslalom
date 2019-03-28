<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
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

        $enrollDataTaipei = DB::table('enroll')
            ->select(
                'enroll.id',
                'final_result',
                'rank',
                'player_number',
                'name',
                'city',
                'agency',
                'round_one_second',
                'round_one_miss_conr',
                'round_two_second',
                'round_two_miss_conr',
                'final_result',
                'integral'
            )
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $schedule->level)
            ->where('group', $schedule->group)
            ->where('gender', $schedule->gender)
            ->where('item', $schedule->item)
            ->where('city', '臺北市')
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->limit(6)
            ->get();

        foreach ($enrollDataTaipei as $val) {
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

        $enrollDataOtherCity = DB::table('enroll')
            ->select(
                'enroll.id',
                'final_result',
                'rank',
                'player_number',
                'name',
                'city',
                'agency',
                'round_one_second',
                'round_one_miss_conr',
                'round_two_second',
                'round_two_miss_conr',
                'final_result',
                'integral'
            )
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', $gameId)
            ->where('level', $schedule->level)
            ->where('group', $schedule->group)
            ->where('gender', $schedule->gender)
            ->where('item', $schedule->item)
            ->where('city', '<>', '臺北市')
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->limit(6)
            ->get();

        foreach ($enrollDataOtherCity as $val) {
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
            ->with('order', $order)
            ->with('enrollDataTaipei', $enrollDataTaipei)
            ->with('enrollDataOtherCity', $enrollDataOtherCity)
            ->with('active', '成績查詢');
    }
}
