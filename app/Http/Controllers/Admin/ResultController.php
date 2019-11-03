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
use Illuminate\Support\Facades\DB;

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
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo) {
                $query->where('gender', $gameInfo->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('level', $gameInfo->level)
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item)
                ->orderBy('player_number')
                ->get();
        }

        $level = $gameInfo->level;

        return view('admin/result')->with(compact('schedules', 'scheduleId', 'enrolls','level'));
    }

    public function update(Request $request)
    {
        $enrollIds        = $request->enrollIds;
        $roundOneSecond   = $request->roundOneSecond;
        $roundOneMissConr = $request->roundOneMissConr;
        $roundTwoSecond   = $request->roundTwoSecond;
        $roundTwoMissConr = $request->roundTwoMissConr;
        $gameType = $request->gameType;

        if (! $this->validateInt($request)) {
            app('request')->session()->flash('error', '秒數請輸入數字');
            return back()->withInput();
        }

        switch ($gameType) {
            case 'Free':
                foreach ($enrollIds as $key => $enrollId) {
                    $this->calculationResult($enrollIds[$key], $roundOneSecond[$key], $roundOneMissConr[$key], $roundTwoSecond[$key], $roundTwoMissConr[$key]);
                }
                break;
            case 'Speed':
                foreach ($enrollIds as $key => $enrollId) {

                    try {
                        EnrollModel::where('id', $enrollId)->update([
                            'final_result'        => $request->finalResult[$key],
                            'rank'                => null,
                        ]);
                    } catch (\Exception $e) {
                        app()->make(SlackNotify::class)->setMsg('[ReultController@update] Error ' . $e->getMessage())->notify();
                    }
                }
                break;
        }

        return back()->with(['success' => '更新選手成績成功']);
    }


    public function calculationResult($enrollId, $roundOneSecond = 0, $roundOneMissConr = 0, $roundTwoSecond = 0, $roundTwoMissConr = 0)
    {
        try {
            if (! empty($roundOneSecond) || ! empty($roundOneMissConr) || ! empty($roundTwoSecond) || ! empty($roundTwoMissConr)) {

                $resultRoundOne = 999;
                $resultRoundTwo = 999;

                if ($roundOneMissConr > 4) {
                    $roundOneMissConr = 9;
                } else {
                    if ($roundOneSecond == 0) {
                        $resultRoundOne = 999;
                    } else {
                        $resultRoundOne = $roundOneSecond + ($roundOneMissConr * 0.2);
                    }
                }

                if ($roundTwoMissConr > 4) {
                    $roundTwoMissConr = 9;
                } else {

                    if ($roundTwoSecond == 0) {
                        $resultRoundTwo = 999;
                    } else {
                        $resultRoundTwo = $roundTwoSecond + ($roundTwoMissConr * 0.2);
                    }
                }

                if ($roundOneMissConr > 5 && $roundTwoMissConr > 5) {
                    $resultRoundFinal = '無成績';
                } else {
                    $resultRoundFinal = $resultRoundOne < $resultRoundTwo ? $resultRoundOne : $resultRoundTwo;
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

        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[ReultController@calculationResult] Error ' . $e->getMessage())->notify();
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
