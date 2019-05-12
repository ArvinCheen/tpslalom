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

        if (is_null($gameInfo = ScheduleModel::find($scheduleId))) {
            $enrolls = [];
        } else {
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo)
            {
                $query->where('gender', $gameInfo->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('level', $gameInfo->level)
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item)
                ->orderBy('player_number')
                ->get();
        }

        return view('admin/result')->with(compact('schedules', 'scheduleId', 'enrolls'));
    }

    public function update(Request $request)
    {
        $enrollIds        = $request->enrollIds;
        $roundOneSecond   = $request->roundOneSecond;
        $roundOneMissConr = $request->roundOneMissConr;
        $roundTwoSecond   = $request->roundTwoSecond;
        $roundTwoMissConr = $request->roundTwoMissConr;

        if (! $this->validateInt($request)) {
            app('request')->session()->flash('error', '秒數請輸入數字');
            return back()->withInput();
        }

        foreach ($enrollIds as $key => $enrollId) {
            $this->calculationResult($enrollIds[$key], $roundOneSecond[$key], $roundOneMissConr[$key], $roundTwoSecond[$key], $roundTwoMissConr[$key]);
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
