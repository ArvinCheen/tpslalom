<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class ResultService
{
    public function getPlayers($scheduleSn)
    {
        $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('scheduleSn', $scheduleSn)->first();

        return EnrollModel::where('game_id', config('app.game_id'))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('game_id', config('app.game_id'))
            ->where('level', $gameInfo->level)
            ->where('group', $gameInfo->group)
            ->where('item', $gameInfo->item)
            ->where('gender', $gameInfo->gender)
            ->get();
    }

    public function processRank($level, $gender, $group, $item, $city = null)
    {
        $enrollModel = new EnrollModel();
        $sns         = $enrollModel->getResultOrderSns($level, $gender, $group, $item, $city);

        foreach ($sns as $key => $val) {
            EnrollModel::where('enrollSn', $val->enrollSn)->update(['rank' => $key + 1]);
        }
    }

    public function processIntegral($level, $gender, $group, $item)
    {
        $players = EnrollModel::select('enroll.enrollSn', 'finalResult')
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->whereNotNull('rank')
            ->limit(6)
            ->orderBy(\DB::raw('finalResult * 1'))
            ->get();

        $integrals = $this->getIntegrals($level, $item);

        foreach ($players as $key => $val) {
            if ($val->finalResult == '無成績') {
                continue;
            }

            EnrollModel::where('enrollSn', $val->enrollSn)->update(['integral' => array_shift($integrals)]);
        }
    }

    private function getIntegrals($level, $item)
    {
        switch ($level . $item) {
            case '初級組前進雙足S型':
                return [7, 5, 4, 3, 2, 1];
            case '新人組前進雙足S型':
                return [8, 6, 5, 4, 3, 2];
            case '新人組前進單足S型':
                return [9, 7, 6, 5, 4, 3];
            case '新人組前進交叉型':
                return [8, 6, 5, 4, 3, 2];
            case '選手組前進雙足S型':
                return [9, 7, 6, 5, 4, 3];
            case '選手組前進單足S型':
                return [10, 8, 7, 6, 5, 4];
            case '選手組前進交叉型':
                return [9, 7, 6, 5, 4, 3];
        }
    }

    public function updateResult($enrollSn, $roundOneSecond, $roundOneMissConr, $roundTwoSecond, $roundTwoMissConr)
    {
        if (! empty($roundOneSecond) || ! empty($roundOneMissConr) || ! empty($roundTwoSecond) || ! empty($roundTwoMissConr)) {

            $resultRoundOne = null;
            $resultRoundTwo = null;

            if ($roundOneMissConr > 4) {
                $roundOneMissConr = 99;
            } else {
                if (! is_null($roundOneSecond)) {
                    $resultRoundOne = $roundOneSecond + ($roundOneMissConr * 0.2);
                }
            }

            if ($roundTwoMissConr > 4) {
                $roundTwoMissConr = 99;
            } else {
                if (! is_null($roundTwoSecond)) {
                    $resultRoundTwo = $roundTwoSecond + ($roundTwoMissConr * 0.2);
                }
            }

            if (! is_null($resultRoundOne) && ! is_null($resultRoundTwo)) {
                $resultRoundFinal = $resultRoundOne < $resultRoundTwo ? $resultRoundOne : $resultRoundTwo;

                if (is_null($roundOneMissConr)) {
                    $roundOneMissConr = 0;
                }
                if (is_null($roundTwoMissConr)) {
                    $roundTwoMissConr = 0;
                }
            } elseif (is_null($resultRoundOne) && is_null($resultRoundTwo)) {
                $resultRoundFinal = '無成績';
            } else {
                if (! is_null($resultRoundOne)) {
                    $resultRoundFinal = $resultRoundOne;
                    if (! is_null($roundOneSecond) && is_null($roundOneMissConr)) {
                        $roundOneMissConr = 0;
                    }
                }
                if (! is_null($resultRoundTwo)) {
                    $resultRoundFinal = $resultRoundTwo;
                    if (! is_null($roundTwoSecond) && is_null($roundTwoMissConr)) {
                        $roundTwoMissConr = 0;
                    }
                }
            }

            EnrollModel::where('enrollSn', $enrollSn)->update([
                'roundOneSecond'   => $roundOneSecond,
                'roundOneMissConr' => $roundOneMissConr,
                'roundTwoSecond'   => $roundTwoSecond,
                'roundTwoMissConr' => $roundTwoMissConr,
                'finalResult'      => $resultRoundFinal,
                'integral'         => null,
                'rank'             => null,
            ]);
        }
    }

    /**
     * @return String
     */
    public function isGameOver($scheduleSn)
    {
        $enrollModel = new EnrollModel();
        $gameInfo    = ScheduleModel::where('game_id', config('app.game_id'))->where('scheduleSn', $scheduleSn)->first();

        $level  = $gameInfo->level;
        $gender = $gameInfo->gender;
        $group  = $gameInfo->group;
        $item   = $gameInfo->item;

        return $enrollModel->isGameOver($level, $gender, $group, $item);
    }

    public function processOverGame($scheduleSn)
    {
        $gameInfo = ScheduleModel::find($scheduleSn);

        $level  = $gameInfo->level;
        $gender = $gameInfo->gender;
        $group  = $gameInfo->group;
        $item   = $gameInfo->item;

        app(EnrollModel::class)->cleanRankAndIntegral($level, $gender, $group, $item);

        if ($level == '新人組') {
            $this->processRank($level, $gender, $group, $item, $city = '臺北市');
            $this->processRank($level, $gender, $group, $item, $city = '外縣市');
        }

        if ($level == '選手組') {
            $this->processRank($level, $gender, $group, $item);
        }

//        $this->processIntegral($level, $gender, $group, $item); //這次比賽不算積分
    }
}
