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

        $schedule = ScheduleModel::find($scheduleId);

        if (is_null($gameInfo = ScheduleModel::find($scheduleId))) {
            $enrolls = [];
        } else {
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo) {
//                $query->where('gender', $gameInfo->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('level', $gameInfo->level)
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item)
                ->orderBy('appearance')
                ->get();
        }

        $model = 'speed';

        if ($schedule->item == '中級指定套路(女)' ||
            $schedule->item == '中級指定套路(男)' ||
            $schedule->item == '個人花式繞樁(女)' ||
            $schedule->item == '個人花式繞樁(男)' ||
            $schedule->item == '初級指定套路(女)' ||
            $schedule->item == '初級指定套路(男)' ||
            $schedule->item == '花式煞停(女)' ||
            $schedule->item == '花式煞停(男)' ||
            $schedule->item == '雙人花式繞樁') {
            $model = 'freeStyle';
        }
        if ($schedule->order == '場次32' || $schedule->order == '場次33' || $schedule->order == '場次34') {
            $model = 'pk';
        }

        return view('admin/result')->with(compact('schedules', 'scheduleId', 'enrolls', 'model'));
    }

    public function update(Request $request)
    {
        $enrollIds        = $request->enrollIds;
        $roundOneSecond   = $request->roundOneSecond;
        $roundOneMissConr = $request->roundOneMissConr;
        $roundTwoSecond   = $request->roundTwoSecond;
        $roundTwoMissConr = $request->roundTwoMissConr;
        $scheduleId       = $request->scheduleId;
        $skill_1          = $request->skill_1;
        $art_1            = $request->art_1;
        $score_1          = $request->score_1;
        $skill_2          = $request->skill_2;
        $art_2            = $request->art_2;
        $score_2          = $request->score_2;
        $skill_3          = $request->skill_3;
        $art_3            = $request->art_3;
        $score_3          = $request->score_3;
        $skill_4          = $request->skill_4;
        $art_4            = $request->art_4;
        $score_4          = $request->score_4;
        $skill_5          = $request->skill_5;
        $art_5            = $request->art_5;
        $score_5          = $request->score_5;
        $punish           = $request->punish;
        $rank             = $request->rank;
        $model            = $request->model;


        switch ($model) {
            case('speed');
                foreach ($enrollIds as $key => $enrollId) {
                    $this->calculationResult($enrollIds[$key], $roundOneSecond[$key], $roundOneMissConr[$key], $roundTwoSecond[$key], $roundTwoMissConr[$key]);
                }
                break;
            case('freeStyle');
                foreach ($enrollIds as $key => $enrollId) {
                    EnrollModel::where('id', $enrollId)->update([
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
                        'punish'  => $punish[$key],
                        'rank'    => $rank[$key],
                    ]);
                }

                break;
            case('pk');
                break;
        }
        return back()->with(['success' => '更新選手成績成功']);
    }


    public function calculationResult($enrollId, $roundOneSecond, $roundOneMissConr, $roundTwoSecond, $roundTwoMissConr)
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

            EnrollModel::where('id', $enrollId)->update([
                'round_one_second'    => $roundOneSecond,
                'round_one_miss_conr' => $roundOneMissConr,
                'round_two_second'    => $roundTwoSecond,
                'round_two_miss_conr' => $roundTwoMissConr,
                'final_result'        => $resultRoundFinal,
                'integral'            => null,
                'rank'                => null,
            ]);
        }
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
