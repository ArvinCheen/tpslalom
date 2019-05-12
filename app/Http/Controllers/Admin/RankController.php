<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Level;
use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
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

        app(EnrollModel::class)->cleanRankAndIntegral($scheduleId);

        if ($level == '選手組') {
            $this->processRank($level, $gender, $group, $item);
        } else {
            $this->processRank($level, $gender, $group, $item, $city = '臺北市');
            $this->processRank($level, $gender, $group, $item, $city = '外縣市');
        }

        $this->processIntegral($level, $gender, $group, $item);
    }


    public function processRank($level, $gender, $group, $item, $city = null)
    {
        $enrollIds = app(EnrollModel::class)->getResultOrderSns($level, $gender, $group, $item, $city);

        foreach ($enrollIds as $key => $enrollId) {
            EnrollModel::where('id', $enrollId->id)->update(['rank' => $key + 1]);
        }
    }

    public function processIntegral($level, $gender, $group, $item)
    {
        $enrolls = EnrollModel::select('enroll.id', 'final_result')
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->whereNotNull('rank')
            ->limit(6)
            ->orderBy(\DB::raw('final_result * 1'))
            ->get();

        $integrals = $this->getIntegrals($level);

        $count = count($enrolls);

        foreach ($enrolls as $key => $enroll) {
            $count--;

            //同成績處理 start
            if ($key <> 0) {
                if ($enrolls[$key - 1]->final_result == $enrolls[$key]->final_result) {
                    $count++;
                }
            }
            //同成績處理 end

            $integral = $integrals[$count];

            if ($enroll->final_result == '無成績') {
                $count++; // todo 這裡寫法可優化
                continue;
            }

            if ($item == '前進單足S型') {
                $integral++;
            }

            EnrollModel::where('id', $enroll->id)->update(['integral' => $integral]);
        }

    }

    private function getIntegrals($level)
    {
        switch ($level) {
            case Level::Primary:
                return [1, 2, 3, 4, 5, 7];
            case Level::Novice:
                return [2, 3, 4, 5, 6, 8];
            case Level::Contestant:
                return [3, 4, 5, 6, 7, 9];
        }
    }

}
