<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\ResultService;
use App\Services\CheckInService;

class ResultController extends Controller
{
    public function index($scheduleId = null)
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleId)) {
            $scheduleId = app(ScheduleModel::class)->getFirstScheduleId();
        }

        $schedule       = ScheduleModel::find($scheduleId);
        $numberOfPlayer = $schedule->number_of_player;
        $當前項目           = $schedule->item;
        $評分表            = [];
        $得勝分表           = [];

        if (is_null($gameInfo = ScheduleModel::find($scheduleId))) {
            $enrolls = [];
        } else {
            $enrolls = EnrollModel::where('gender', $gameInfo->gender)
                ->where('game_id', config('app.game_id'))
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item)
                ->orderBy('appearance')
                ->get();
        }

        $model = 'speed';

        if ($schedule->item == '中級指定套路' ||
            $schedule->item == '中級指定套路' ||
            $schedule->item == '個人花式繞樁' ||
            $schedule->item == '個人花式繞樁' ||
            $schedule->item == '初級指定套路' ||
            $schedule->item == '初級指定套路' ||
            $schedule->item == '花式煞停' ||
            $schedule->item == '花式煞停' ||
            $schedule->item == '雙人花式繞樁') {
            $model = 'freeStyle';

            // 建立評分表架構 開始

            $gender = $schedule->gender;
            $group  = $schedule->group;
            $item   = $schedule->item;

            if ($schedule->item == '雙人花式繞樁') {
                $評分表資料源 = EnrollModel::where('item', $item)->orderBy('appearance')->get();
            } else {
                $評分表資料源 = EnrollModel::where('gender', $gender)->where('group', $group)->where('item', $item)->orderBy('appearance')->get();
            }

            $judge_1 = [];
            $judge_2 = [];
            $judge_3 = [];
            $judge_4 = [];
            $judge_5 = [];

            foreach ($評分表資料源 as $val) {
                $評分表[$val->player_id][]   = $val->player_id . ' ' . $val->name;
                $judge_1[$val->player_id] = $val->score_1;
                $judge_2[$val->player_id] = $val->score_2;
                $judge_3[$val->player_id] = $val->score_3;

                if ($schedule->item == '個人花式繞樁') {
                    $judge_4[$val->player_id] = $val->score_4;
                    $judge_5[$val->player_id] = $val->score_5;
                }
            }
            // 建立評分表架構 結束

            arsort($judge_1);
            arsort($judge_2);
            arsort($judge_3);
            if ($schedule->item == '個人花式繞樁') {
                arsort($judge_4);
                arsort($judge_5);
            }
            $rank = 1;
            foreach ($judge_1 as $key => $val) {
                $評分表[$key][] = $rank;
                $rank++;
            }
            $rank = 1;
            foreach ($judge_2 as $key => $val) {
                $評分表[$key][] = $rank;
                $rank++;
            }
            $rank = 1;
            foreach ($judge_3 as $key => $val) {
                $評分表[$key][] = $rank;
                $rank++;
            }
            if ($schedule->item == '個人花式繞樁') {
                $rank = 1;
                foreach ($judge_4 as $key => $val) {
                    $評分表[$key][] = $rank;
                    $rank++;
                }
                $rank = 1;
                foreach ($judge_5 as $key => $val) {
                    $評分表[$key][] = $rank;
                    $rank++;
                }
            }
            $得勝分表 = [];
            foreach ($評分表 as $主要選手號碼 => $主要選手評分表) {

                $評分表暫存     = $評分表;
                $score     = 0;
                $主要選手裁判一名次 = $評分表[$主要選手號碼][1];
                $主要選手裁判二名次 = $評分表[$主要選手號碼][2];
                $主要選手裁判三名次 = $評分表[$主要選手號碼][3];
                if ($schedule->item == '個人花式繞樁') {
                    $主要選手裁判四名次 = $評分表[$主要選手號碼][4];
                    $主要選手裁判五名次 = $評分表[$主要選手號碼][5];
                }

                foreach ($評分表暫存 as $比較選手號碼 => $比較選手評分表) {
                    if ($主要選手號碼 == $比較選手號碼) {
                        $得勝分表[$主要選手號碼][] = 'N/A';
                        continue;
                    }
                    $比較選手裁判一名次 = $評分表暫存[$比較選手號碼][1];
                    $比較選手裁判二名次 = $評分表暫存[$比較選手號碼][2];
                    $比較選手裁判三名次 = $評分表暫存[$比較選手號碼][3];
                    if ($schedule->item == '個人花式繞樁') {
                        $比較選手裁判四名次 = $評分表暫存[$比較選手號碼][4];
                        $比較選手裁判五名次 = $評分表暫存[$比較選手號碼][5];
                    }

                    if ($主要選手裁判一名次 < $比較選手裁判一名次) $score++;
                    if ($主要選手裁判二名次 < $比較選手裁判二名次) $score++;
                    if ($主要選手裁判三名次 < $比較選手裁判三名次) $score++;
                    if ($schedule->item == '個人花式繞樁') {
                        if ($主要選手裁判四名次 < $比較選手裁判四名次) $score++;
                        if ($主要選手裁判五名次 < $比較選手裁判五名次) $score++;
                    }

                    $得勝分表[$主要選手號碼][] = $score;
                    $score           = 0;
                }
            }

            $多數得勝分 = 0;
            foreach ($得勝分表 as $key => $val) {

                foreach ($val as $席位分數) {
                    if ($schedule->item == '個人花式繞樁') {
                        if ($席位分數 > 2.5) {
                            $多數得勝分++;
                        }
                    } else {
                        if ($席位分數 > 1.5) {
                            $多數得勝分++;
                        }
                    }
                }

                $記算技術分 = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')->where('player_id', $key)->where('group', $group)->where('item', $item)->first();

                $得勝分表[$key][] = $多數得勝分;
                $得勝分表[$key][] = '';
                $得勝分表[$key][] = $記算技術分->skill_1 + $記算技術分->skill_2 + $記算技術分->skill_3 + $記算技術分->skill_4 + $記算技術分->skill_5;
                $總分           = $記算技術分->score_1 + $記算技術分->score_2 + $記算技術分->score_3 + $記算技術分->score_4 + $記算技術分->score_5;

                $總計得勝分 = 0;

                for ($i = 0; $i < count($得勝分表); $i++) {
                    if ($得勝分表[$key][$i] == 'N/A') continue;
                    $總計得勝分 += $得勝分表[$key][$i];
                }
                $得勝分表[$key][] = $總計得勝分;
                $得勝分表[$key][] = $總分;
                $得勝分表[$key][] = '';
                $多數得勝分        = 0;
            }
        }

        $第一層 = $numberOfPlayer;
        $第二層 = $第一層 + 1;
        $第三層 = $第二層 + 1;
//        if ($schedule->item == '個人花式繞樁') {
        $第四層 = $第三層 + 1;
        $第五層 = $第四層 + 1;
        $名次層 = $第五層 + 1;
//        } else {
//            $名次層 = $第三層 + 1;
//        }


        // 算第一層同樣名次
        $tmpRank   = [];
        $tmpRankv2 = [];
        foreach ($得勝分表 as $選手) {
            $tmpRank[$選手[$第一層]] = null;

            if (isset($tmpRankv2[$選手[$第一層]])) {
                $tmpRankv2[$選手[$第一層]] = $tmpRankv2[$選手[$第一層]] + 1;
            } else {
                $tmpRankv2[$選手[$第一層]] = 1;
            }

            $rank++;
        }
        $rank = 1;
        krsort($tmpRank);
        foreach ($tmpRank as $key => $val) {
            $tmpRank[$key] = $rank;
            $rank++;
        }

        foreach ($得勝分表 as $key => $選手) {
            $得勝分表[$key][$名次層] = $tmpRank[$選手[$第一層]];
        }


//        $rank = 1;
//        foreach ($得勝分表 as $key => $選手) {
//            if ($rank == 1) {
//                $tmpRank = $得勝分表[$key][$名次層];
//                $rank++;
//                continue;
//            }
//
//            if ($得勝分表[$key][$名次層] == $tmpRank) {
//                $rank++;
//            }
//            $得勝分表[$key][$名次層] = $tmpRank[$選手[$第一層]];
//        }


        if (
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '青年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '青年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '成年女速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '成年男速度過樁選手菁英組積分賽-前溜單足S形決賽' ||
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '國中男速度過樁選手菁英-前溜單足S形決賽' ||
            $schedule->group . $schedule->gender . $schedule->item . $schedule->game_type == '國中女速度過樁選手菁英-前溜單足S形決賽') {
            $model = 'pk';
        }


        return view('admin/result')->with(compact('schedules', '當前項目', 'scheduleId', 'enrolls', 'model', '評分表', '得勝分表'));
    }

    public function update(Request $request)
    {
        $enrollIds        = $request->enrollIds;
        $roundOneSecond   = $request->roundOneSecond;
        $roundOneMissConr = $request->roundOneMissConr;
        $roundTwoSecond   = $request->roundTwoSecond;
        $roundTwoMissConr = $request->roundTwoMissConr;
        $punish           = $request->punish;
        $skill_1          = $request->skill_1;
        $score_1          = $request->score_1;
        $art_1            = $request->art_1;
        $skill_2          = $request->skill_2;
        $score_2          = $request->score_2;
        $art_2            = $request->art_2;
        $skill_3          = $request->skill_3;
        $score_3          = $request->score_3;
        $art_3            = $request->art_3;
        $skill_4          = $request->skill_4;
        $score_4          = $request->score_4;
        $art_4            = $request->art_4;
        $skill_5          = $request->skill_5;
        $score_5          = $request->score_5;
        $art_5            = $request->art_5;
        $rank             = $request->rank;
        $model            = $request->model;
        $scheduleId       = $request->scheduleId;


        switch ($model) {
            case('speed');
                foreach ($enrollIds as $key => $enrollId) {
                    $this->calculationResult($enrollIds[$key], $roundOneSecond[$key], $roundOneMissConr[$key], $roundTwoSecond[$key], $roundTwoMissConr[$key]);
                }
                break;
            case('freeStyle');


                foreach ($enrollIds as $key => $enrollId) {

                    if (ScheduleModel::find($scheduleId)->item == '初級指定套路' || ScheduleModel::find($scheduleId)->item == '中級指定套路') {
                        $update = [
                            'punish'       => $punish[$key],
                            'skill_1'      => $skill_1[$key],
                            'art_1'        => $art_1[$key],
                            'score_1'      => $skill_1[$key] + $art_1[$key] - $punish[$key],
                            'skill_2'      => $skill_1[$key],
                            'art_2'        => $art_2[$key],
                            'score_2'      => $skill_1[$key] + $art_2[$key] - $punish[$key],
                            'skill_3'      => $skill_1[$key],
                            'art_3'        => $art_3[$key],
                            'score_3'      => $skill_1[$key] + $art_3[$key] - $punish[$key],
                            'skill_4'      => null,
                            'art_4'        => null,
                            'score_4'      => null,
                            'skill_5'      => null,
                            'art_5'        => null,
                            'score_5'      => null,
                            'rank'         => $rank[$key],
                            'final_result' => empty($rank[$key]) ? '無成績' : $rank[$key]
                        ];
                    } else if (ScheduleModel::find($scheduleId)->item == '雙人花式繞樁') {
                        $update = [
                            'punish'  => $punish[$key],
                            'skill_1' => $skill_1[$key],
                            'art_1'   => $art_1[$key],
                            'score_1' => $score_1[$key],
                            'skill_2' => $skill_2[$key],
                            'art_2'   => $art_2[$key],
                            'score_2' => $score_2[$key],
                            'skill_3' => $skill_3[$key],
                            'art_3'   => $art_3[$key],
                            'score_3' => $score_3[$key],
                            'skill_4' => $skill_4[$key],
                            'art_4'   => $art_4[$key],
                            'score_4' => $score_4[$key],
                            'skill_5' => $skill_5[$key],
                            'art_5'   => $art_5[$key],
                            'score_5' => $score_5[$key],
                            'rank'         => $rank[$key],
                            'final_result' => empty($rank[$key]) ? '無成績' : $rank[$key]
                        ];
                    } else {

                        $update = [
                            'punish'  => $punish[$key],
                            'skill_1' => $skill_1[$key],
                            'art_1'   => $art_1[$key],
                            'score_1' => $skill_1[$key] + $art_1[$key] - $punish[$key],
                            'skill_2' => $skill_2[$key],
                            'art_2'   => $art_2[$key],
                            'score_2' => $skill_2[$key] + $art_2[$key] - $punish[$key],
                            'skill_3' => $skill_3[$key],
                            'art_3'   => $art_3[$key],
                            'score_3' => $skill_3[$key] + $art_3[$key] - $punish[$key],
                            'skill_4' => $skill_4[$key],
                            'art_4'   => $art_4[$key],
                            'score_4' => $skill_4[$key] + $art_4[$key] - $punish[$key],
                            'skill_5' => $skill_5[$key],
                            'art_5'   => $art_5[$key],
                            'score_5' => $skill_5[$key] + $art_5[$key] - $punish[$key],
                            'rank'         => $rank[$key],
                            'final_result' => empty($rank[$key]) ? '無成績' : $rank[$key]
                        ];
                    }

                    EnrollModel::where('id', $enrollId)->update($update);
                }
                break;
            case('pk');
                break;
        }
        return back()->with(['success' => '更新選手成績成功']);
    }


    public function calculationResult($enrollId, $roundOneSecond, $roundOneMissConr, $roundTwoSecond, $roundTwoMissConr)
    {
//        if (! empty($roundOneSecond) || ! empty($roundOneMissConr) || ! empty($roundTwoSecond) || ! empty($roundTwoMissConr)) {

        $resultRoundOne   = null;
        $resultRoundTwo   = null;
        $resultRoundFinal = null;

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
//                    $roundOneMissConr = 0;
            }
            if (is_null($roundTwoMissConr)) {
//                    $roundTwoMissConr = 0;
            }
        } elseif (is_null($resultRoundOne) && is_null($resultRoundTwo)) {
//                $resultRoundFinal = '無成績';
        } else {
            if (! is_null($resultRoundOne)) {
                $resultRoundFinal = $resultRoundOne;
                if (! is_null($roundOneSecond) && is_null($roundOneMissConr)) {
//                        $roundOneMissConr = 0;
                }
            }
            if (! is_null($resultRoundTwo)) {
                $resultRoundFinal = $resultRoundTwo;
                if (! is_null($roundTwoSecond) && is_null($roundTwoMissConr)) {
//                        $roundTwoMissConr = 0;
                }
            }
        }

        EnrollModel::where('id', $enrollId)->update([
            'round_one_second'    => $roundOneSecond,
            'round_one_miss_conr' => $roundOneMissConr,
            'round_two_second'    => $roundTwoSecond,
            'round_two_miss_conr' => $roundTwoMissConr,
            'final_result'        => $resultRoundFinal,
            'integral'            => null,
            'rank'                => null,
        ]);
//        }
    }

    private function validateInt(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'roundOneSecond.*' => 'Numeric|nullable',
            'roundTwoSecond.*' => 'Numeric|nullable',
        ]);

        return $validation->passes();
    }
}
