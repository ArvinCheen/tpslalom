<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Level;
use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Models\EnrollModel;

class RankController extends Controller
{
    public function rank(Request $request)
    {
        $this->processOverGame($request->scheduleId);

        app(SlackNotify::class)->setMsg(ScheduleModel::find($request->scheduleId)->order . " 比賽結束")->notify();

        return back()->with(['info' => '排名成功']);
    }


    private function processOverGame($scheduleId)
    {
        $gameInfo = ScheduleModel::find($scheduleId);
        $level    = $gameInfo->level;
        $gender   = $gameInfo->gender;
        $group    = $gameInfo->group;
        $item     = $gameInfo->item;

        $numberOfPlayer = ScheduleModel::find($scheduleId)->number_of_player;

        app(EnrollModel::class)->cleanRankAndIntegral($scheduleId);
        
        if (env('GAME') == 11) {
            if ($numberOfPlayer >= 6) {
                $rankLimit = 6;
            } else {
                $rankLimit = $numberOfPlayer;
            }

            if ($level == '選手組') {
                $this->processRank($level, $gender, $group, $item, $rankLimit, null);
            } else {
                $this->processRank($level, $gender, $group, $item, $rankLimit, '臺北市');
                $this->processRank($level, $gender, $group, $item, $rankLimit, '外縣市');
            }
        }
        
        if (env('GAME') == 12) {
            dd('未設定');
        }
        
        if (env('GAME') == 13) {
            $rankLimit = $this->getHualienRankLimit($numberOfPlayer);
            $this->processRank($level, $gender, $group, $item, $rankLimit);
        }
        
        $gameInfo->open_result_time = now();
        $gameInfo->save();

        $this->processIntegral($level, $gender, $group, $item);
    }

    private function getHualienRankLimit($numberOfPlayer)
    {
        switch ($numberOfPlayer) {
            case ('1'):
                return 1;
            case ('2'):
                return 2;
            case ('3'):
                return 3;
            case ('4'):
                return 3;
            case ('5'):
                return 3;
            case ('6'):
                return 4;
            case ('7'):
                return 5;
            case ('8'):
                return 5;
            case ('9'):
                return 5;
            case ('10'):
                return 6;
            case ('11'):
                return 6;
            case ('12'):
                return 6;
            case ('13'):
                return 6;
            case ('14'):
                return 6;
            case ('15'):
                return 7;
            case ('16'):
                return 8;
            case ('17'):
                return 8;
            case ('18'):
                return 8;
            case ('21'):
                return 10;
            case ('22'):
                return 10;
            case ('23'):
                return 10;
            case ('24'):
                return 10;
            case ('25'):
                return 10;
            default:
                dd('人數異常');
            }
    }

    public function processRank($level, $gender, $group, $item, $rankLimit, $city = null)
    {
        $results = app(EnrollModel::class)->getResults($level, $gender, $group, $item, $rankLimit, $city);

        foreach ($results as $key => $result) {
            if ($key <> 0) {
                if ($results[$key - 1]->final_result == $results[$key]->final_result) { //同成績處理 start
                    $前一個選手的名次 = EnrollModel::where('id', $results[$key - 1]->id)->first()->rank; // todo 這裡的命名要改
                    EnrollModel::where('id', $result->id)->update(['rank' => $前一個選手的名次]);
                } else {
                    EnrollModel::where('id', $result->id)->update(['rank' => $key + 1]);
                }
            } else {
                EnrollModel::where('id', $result->id)->update(['rank' => $key + 1]);
            }
        }
    }

    public function processIntegral($level, $gender, $group, $item)
    {
        $enrolls = EnrollModel::where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            // ->whereNotNull('final_result')
            // ->limit(6)
            // ->orderBy(\DB::raw('final_result * 1'))
            ->orderByRaw('-`final_result` desc')
            ->get();

        $integrals = $this->getIntegrals($level);
        // dd($integrals);

        $count = count($enrolls) - 1;

        if ($count > 5) { // 最多取六名
            $count = 5;
        }

        foreach ($enrolls as $enroll) {
            $integral = $integrals[$count];
            // echo "count: $count  |  rank: $enroll->rank <br>";
            
            if (is_null($enroll->rank)) {
                continue;
            }

            if ($item == '前進單足S形') {
                $integral++;
            }

            EnrollModel::where('id', $enroll->id)->update(['integral' => $integral]);
            
            $count--;

            if ($count < 0) {
                break;
            }
        }
        // dd();
    }

    private function getIntegrals($level)
    {
        switch ($level) {
//            case Level::Primary:  //109北市中正盃不開放
//                return [1, 2, 3, 4, 5, 7];
            case Level::Novice:
                return [2, 3, 4, 5, 6, 8];
            case Level::Contestant:
                return [3, 4, 5, 6, 7, 9];
        }
    }

}
