<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\ResultService;
use App\Services\CheckInService;

class ResultController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index($scheduleSn = null)
    {
        $checkInService = new CheckInService();
        $resultService  = new ResultService();

        $schedules = $checkInService->getSchedules();

        if (is_null($scheduleSn)) {
            $scheduleSn = $checkInService->getScheduleSn();
        }

        $players = $resultService->getPlayers($scheduleSn);

        return view('admin/result/index')->with(compact('schedules', 'scheduleSn', 'players'));
    }

    public function updateResult(Request $request)
    {
        $enrollSn         = $request->enrollSn;
        $roundOneSecond   = $request->roundOneSecond;
        $roundOneMissConr = $request->roundOneMissConr;
        $roundTwoSecond   = $request->roundTwoSecond;
        $roundTwoMissConr = $request->roundTwoMissConr;
        $scheduleSn       = $request->scheduleSn;
        $isGameOver       = $request->isGameOver;

        if (!$this->validateInt($request)) {
            app('request')->session()->flash('error', '秒數請輸入數字');
            return back()->withInput();
        }

        if ($isGameOver) {
            app()->make(ResultService::class)->processOverGame($scheduleSn);

            app('request')->session()->flash('info', '排名成功');
        } else {
            foreach ($enrollSn as $key => $value) {
                app(ResultService::class)->updatePlayerResult($enrollSn[$key], $roundOneSecond[$key], $roundOneMissConr[$key], $roundTwoSecond[$key], $roundTwoMissConr[$key]);
            }

            app('request')->session()->flash('success', '更新選手成績成功');
        }

        return back();
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
