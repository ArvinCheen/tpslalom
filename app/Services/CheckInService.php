<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class CheckInService
{
    public function index($scheduleSn)
    {
        if (is_null($scheduleSn)) {
            $schedule = ScheduleModel::where('gameSn', session('gameSn'))->first();
        } else {
            $schedule = ScheduleModel::where('scheduleSn', $scheduleSn)->first();
        }

        if (is_null($schedule)) {
            return [];
        }

        return \DB::table('enroll')->where('gameSn', session('gameSn'))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gender', $schedule->gender)
            ->where('level', $schedule->level)
            ->where('group', $schedule->group)
            ->where('item', $schedule->item)
            ->get();
    }

    public function update($playerSn, $scheduleSn, $checkStatus)
    {
        $enrollInfo = ScheduleModel::where('gameSn', session('gameSn'))->where('scheduleSn', $scheduleSn)->first();
        $query      = EnrollModel::where('gameSn', session('gameSn'))
            ->where('level', $enrollInfo->level)
            ->where('group', $enrollInfo->group)
            ->where('item', $enrollInfo->item)
            ->where('playerSn', $playerSn)
            ->update([
                'check'       => $checkStatus,
                'checkInTime' => $checkStatus == '出賽' ? date('Y/m/d H:i:s', time()) : null,
            ]);

        return $query;
    }

    public function getSchedules()
    {
        return ScheduleModel::where('gameSn', session('gameSn'))->get();
    }

    public function getScheduleSn()
    {
        return ScheduleModel::where('gameSn', session('gameSn'))->value('scheduleSn');
    }
}
