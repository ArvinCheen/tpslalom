<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\GameInfoService;

class GameInfoController extends Controller
{
    public function schedules()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        return view('gameInfo/schedules')->with(compact('schedules'));
    }

    public function groups()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            $level  = $schedule->level;
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;

            $schedule->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('level', $level)
                ->where('group', 'like', "%$group%")
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }


        return view('gameInfo/groups')->with(['groups' => $schedules]);
    }

    public function teams()
    {
        $teams = app(EnrollModel::class)->getParticipateTeam();

        foreach ($teams as $team) {
            $team->players = EnrollModel::with('player')
                ->where('game_id', config('app.game_id'))
                ->where('enroll.account_id', $team->account_id)
                ->groupBy('enroll.player_id')
                ->get();

        }

        return view('gameInfo/teams')->with(compact('teams'));
    }

    public function refereeTeam()
    {
        return view('gameInfo/refereeTeam');
    }
}
