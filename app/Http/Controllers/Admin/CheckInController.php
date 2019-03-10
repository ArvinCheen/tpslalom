<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\CheckInService;
use App\Services\ScheduleService;

class CheckInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($scheduleSn = null)
    {
        $checkInService  = new CheckInService();
        $scheduleService = new ScheduleService();

        $players   = $checkInService->index($scheduleSn);
        $schedules = $scheduleService->getSchedules();

        if (is_null($scheduleSn)) {
            $scheduleSn = $scheduleService->getScheduleSn();
        }

        return view('admin/checkIn/index')->with(compact('players', 'schedules', 'scheduleSn'));
    }

    public function update(Request $request)
    {
        $playerSn    = $request->playerSn;
        $scheduleSn  = $request->scheduleSn;
        $checkStatus = $request->checkStatus;

        $checkInService = new CheckInService();

        if (!$checkInService->update($playerSn, $scheduleSn, $checkStatus)) {
            app('request')->session()->flash('error', '檢錄失敗');
            return back();
        }

        if ($checkStatus) {
            app('request')->session()->flash('success', '檢錄成功');
        } else {
            app('request')->session()->flash('warning', '取消檢錄');
        }

        return back();
    }
}
