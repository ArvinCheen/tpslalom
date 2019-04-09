<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\CheckInService;
use App\Services\ScheduleService;

class CheckInController extends Controller
{
    public function index($scheduleId = null)
    {
        $enrolls   = $this->getEnrolls($scheduleId);
        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleId)) {
            $scheduleId = app(ScheduleModel::class)->getFirstScheduleId();
        }

        return view('admin/checkIn')->with(compact('enrolls', 'schedules', 'scheduleId'));
    }

    public function update(Request $request)
    {
        $enrollIds  = $request->enrollIds;
        $checkInIds = $request->checkInIds;

        EnrollModel::whereIn('id', $enrollIds)->update([
            'check'         => 0,
            'check_in_time' => null,
        ]);

        EnrollModel::whereIn('id', $checkInIds)->update([
            'check'         => 1,
            'check_in_time' => date('Y/m/d H:i:s', time()),
        ]);

        app('request')->session()->flash('success', '檢錄成功');

        return back();
    }

    public function getEnrolls($scheduleId)
    {
        if (is_null($scheduleId)) {
            $schedule = ScheduleModel::where('game_id', config('app.game_id'))->first();
        } else {
            $schedule = ScheduleModel::where('id', $scheduleId)->first();
        }

        if (is_null($schedule)) {
            return [];
        } else {
            return EnrollModel::wherehas('player', function ($query) use ($schedule) {
                $query->where('gender', $schedule->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('level', $schedule->level)
                ->where('group', $schedule->group)
                ->where('item', $schedule->item)
                ->get();
        }
    }
}
