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

            $val->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
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
            $val->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->where('enroll.account_id', $val->accountId)->groupBy('enroll.player_id')->get();
        }

        return $participateTeam;
    }

    public function getRefereeTeam()
    {
        return view('gameInfo/refereeTeam');
    }

}
