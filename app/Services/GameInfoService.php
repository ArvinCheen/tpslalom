<?php

namespace App\Services;

use App\Models\GameModel;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class GameInfoService
{
    public function getSchedules()
    {
        $scheduleModel = new ScheduleModel();

        return $scheduleModel->getSchedules();
    }

    public function getGroupList()
    {
        $scheduleModel = new ScheduleModel();
        $schedules     = $scheduleModel->getSchedules();

        foreach ($schedules as $val) {
            $level  = $val->level;
            $group  = $val->group;
            $gender = $val->gender;
            $item   = $val->item;

            $val->playerList = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                ->where('gameSn', config('app.gameSn'))
                ->where('level', $level)
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }

        return $schedules;
    }

    public function getTeamList()
    {
        $enrollModel     = new EnrollModel();
        $participateTeam = $enrollModel->getParticipateTeam();

        foreach ($participateTeam as $val) {
            $val->playerList = \DB::table('enroll')->leftJoin('player', 'player.playerSn', 'enroll.playerSn')->where('gameSn', config('app.gameSn'))->where('enroll.accountId', $val->accountId)->groupBy('enroll.playerSn')->get();
        }

        return $participateTeam;
    }

    public function getRefereeTeam()
    {
        return view('gameInfo/refereeTeam');
    }

}
