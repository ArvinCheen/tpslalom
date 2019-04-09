<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use App\Models\RegistryFeeModel;

class DocService
{
    public function getAllDoc()
    {
        $allDoc = EnrollModel::select(\DB::raw('
            enroll.player_number, 
            name, 
            `level`, 
            `group`, 
            gender, 
            team_name, 
            agency,
            city, 
            coach, 
            leader, 
            management,
            fee,
            GROUP_CONCAT(item) AS itemAll
        '))
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->leftJoin('account', 'account.id', 'player.account_id')
            ->leftJoin('registry_fee', 'registry_fee.player_id', 'enroll.player_id')
            ->where('enroll.game_id', config('app.game_id'))
            ->where('registry_fee.game_id', config('app.game_id'))
            ->groupBy('enroll.player_number')
            ->get();

        foreach ($allDoc as $doc) {
            if (preg_match("/\前進雙足S型/i", $doc->itemAll)) {
                $doc->doubleS = '前進雙足S型';
            }
            if (preg_match("/\前進單足S型/i", $doc->itemAll)) {
                $doc->singleS = '前進單足S型';
            }
            if (preg_match("/\前進交叉型/i", $doc->itemAll)) {
                $doc->cross = '前進交叉型';
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

            $val->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
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
                ->leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('enroll.account_id', $val->accountId)
                ->groupBy('enroll.player_id')
                ->get();
        }

        return $participateTeam;
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
