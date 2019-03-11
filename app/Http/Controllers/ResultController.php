<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleModel;

class ResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchResult($order)
    {
        $scheduleModel = new ScheduleModel();
        $schedules = $scheduleModel->getSchedules();
        $schedule = $scheduleModel->getSchedule($order);

        $enrollDataTaipei = DB::table('enroll')
            ->select(
                'enroll.enrollSn',
                'finalResult',
                'rank',
                'playerNumber',
                'name',
                'city',
                'agency',
                'roundOneSecond',
                'roundOneMissConr',
                'roundTwoSecond',
                'roundTwoMissConr',
                'finalResult',
                'integral'
            )
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
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
            if (!is_null($val->finalResult)) {
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
                'enroll.enrollSn',
                'finalResult',
                'rank',
                'playerNumber',
                'name',
                'city',
                'agency',
                'roundOneSecond',
                'roundOneMissConr',
                'roundTwoSecond',
                'roundTwoMissConr',
                'finalResult',
                'integral'
            )
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', $gameSn)
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
            if (!is_null($val->finalResult)) {
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
