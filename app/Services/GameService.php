<?php
namespace App\Services;

use App\Models\GameModel;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class GameService
{
    public function processTaipeiRankAndIntegral($level, $gender, $group, $item)
    {
        $enrollQuery = new EnrollModel();

        $taipeiResult = $enrollQuery->getTaipeiResult($level, $gender, $group, $item);

        $teamIntegralLimit = count($taipeiResult) <= 5 ? count($taipeiResult) : 7;

        $rank = 0;

        foreach ($taipeiResult as $key => $val) {

            $rank = $rank + 1;

            $updateData = [
                "rank" =>  $rank,
                "integral" =>  $teamIntegralLimit,
            ];
            $enrollQuery->where('sn', $val->sn)->update($updateData);

            if ($teamIntegralLimit > 0) {
                $teamIntegralLimit--;
                if ($teamIntegralLimit == 6) {  //沒有六分,直接754321
                    $teamIntegralLimit--;
                }
            }
        }

        return;
    }

    public function processOtherCityRankAndIntegral($level, $gender, $group, $item)
    {
        $enrollQuery = new EnrollModel();

        $taipeiResult = $enrollQuery->getTaipeiResult($level, $gender, $group, $item);

        $teamIntegralLimit = count($taipeiResult) <= 5 ? count($taipeiResult) : 7;

        $rank = 0;

        foreach ($taipeiResult as $key => $val) {

            $rank = $rank + 1;

            $updateData = [
                "rank" =>  $rank,
                "integral" =>  $teamIntegralLimit,
            ];
            $enrollQuery->where('sn', $val->sn)->update($updateData);

            if ($teamIntegralLimit > 0) {
                $teamIntegralLimit--;
                if ($teamIntegralLimit == 6) {  //沒有六分,直接754321
                    $teamIntegralLimit--;
                }
            }
        }

        return;
    }
//
//    public function arrangementSchedule($level, $group, $gender, $item)
//    {
//        $enrollQuery = new EnrollModel();
//        $numberOfPlayer = $enrollQuery->countGameItemNumberOfPlayer($level, $group, $gender, $item);
//
//        $scheduleQuery = new ScheduleModel();
//        $schedule = '場次' . ($scheduleQuery::where('game_id', config('app.game_id'))->count() + 1);
//        if ($numberOfPlayer) {
//            $insertData = [
//                'game_id' => config('app.game_id'),
//                'order' => $schedule,
//                'level' => $level,
//                'group' => $group,
//                'gender' => $gender,
//                'item' => $item,
//                'numberOfPlayer' => $numberOfPlayer,
//            ];
//            $scheduleQuery  = new ScheduleModel();
//            $scheduleQuery::insert($insertData);
//        }
//    }
}
