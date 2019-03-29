<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\CheckInService;
use App\Services\ScheduleService;

class CheckInController extends Controller
{
    public function index($scheduleSn = null)
    {
        $checkInService  = new CheckInService();

        $players   = $checkInService->index($scheduleSn);
        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleSn)) {
            $scheduleSn = app(ScheduleModel::class)->getFirstScheduleId();
        }

        return view('admin/checkIn/index')->with(compact('players', 'schedules', 'scheduleSn'));
    }

    public function update(Request $request)
    {
        $playerId    = $request->playerSn;
        $scheduleSn  = $request->scheduleSn;
        $checkStatus = $request->checkStatus;

        $checkInService = new CheckInService();

        if (!$checkInService->update($playerId, $scheduleSn, $checkStatus)) {
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
