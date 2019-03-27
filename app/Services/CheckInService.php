<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class CheckInService
{
    public function index($scheduleSn)
    {
        if (is_null($scheduleSn)) {
            $schedule = ScheduleModel::where('game_id', config('app.game_id'))->first();
        } else {
            $schedule = ScheduleModel::where('scheduleSn', $scheduleSn)->first();
        }

        if (is_null($schedule)) {
            return [];
        }

        return \DB::table('enroll')->where('game_id', config('app.game_id'))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gender', $schedule->gender)
            ->where('level', $schedule->level)
            ->where('group', $schedule->group)
            ->where('item', $schedule->item)
            ->get();
    }

    public function update($playerSn, $scheduleSn, $checkStatus)
    {
        $enrollInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('scheduleSn', $scheduleSn)->first();
        $query      = EnrollModel::where('game_id', config('app.game_id'))
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
        return ScheduleModel::where('game_id', config('app.game_id'))->get();
    }

    public function getScheduleSn()
    {
        return ScheduleModel::where('game_id', config('app.game_id'))->value('scheduleSn');
    }
}
