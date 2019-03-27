<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use App\Models\RegistryFeeModel;

class DocService
{
    public function getAllDoc()
    {
        $enrollModel = new EnrollModel();
        $allDoc      = $enrollModel->getAllDoc();

        foreach ($allDoc as $val) {
            if (preg_match("/\前進雙足S型/i", $val->itemAll)) {
                $val->doubleS = '前進雙足S型';
            }
            if (preg_match("/\前進單足S型/i", $val->itemAll)) {
                $val->singleS = '前進單足S型';
            }
            if (preg_match("/\前進交叉型/i", $val->itemAll)) {
                $val->cross = '前進交叉型';
            }
        }

        return $allDoc;
    }

    public function getGroupsInfo()
    {
        $scheduleModel = new ScheduleModel();
        $schedule      = $scheduleModel->getSchedules();

        foreach ($schedule as $val) {
            $level  = $val->level;
            $group  = $val->group;
            $gender = $val->gender;
            $item   = $val->item;

            $val->players = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                ->where('game_id', config('app.game_id'))
                ->where('level', $level)
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }

        return $schedule;
    }

    public function getTeamsInfo()
    {
        $enrollModel     = new EnrollModel();
        $participateTeam = $enrollModel->getParticipateTeam();

        foreach ($participateTeam as $val) {
            $val->players = \DB::table('enroll')
                ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                ->where('game_id', config('app.game_id'))
                ->where('enroll.accountId', $val->accountId)
                ->groupBy('enroll.playerSn')
                ->get();
        }

        return $participateTeam;
    }

    public function getBills()
    {
        $registryFeeModel = new RegistryFeeModel();

        return $registryFeeModel->getBills();
    }

    public function getEnrollPlayers()
    {
        $enrollModel = new EnrollModel();

        return (object)[
            'doubleS' => $enrollModel->getEnrollPlayers($item = '前進雙足S型'),
            'singleS' => $enrollModel->getEnrollPlayers($item = '前進單足S型'),
            'cross'   => $enrollModel->getEnrollPlayers($item = '前進交叉型'),
        ];
    }
}
