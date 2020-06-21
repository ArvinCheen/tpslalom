<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\GameInfoService;

class GameInfoController extends Controller
{
    public function getAppearance($scheduleId = null)
    {
        if (is_null($scheduleId)) {
            $scheduleId = app(ScheduleModel::class)->getFirstScheduleId();
        }
        $gameInfo = null;
        $enrolls            = [];
        $schedules          = app(ScheduleModel::class)->getSchedules();
        $numberOfAppearance = app(EnrollModel::class)->where('game_id', config('app.game_id'))->whereNull('appearance')->count();

        if ($numberOfAppearance > 0) {
            $isView = false;
        } else {
            $isView = true;

            $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $scheduleId)->first();

            $enrolls = EnrollModel::where('game_id', config('app.game_id'))
                ->leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('group', $gameInfo->group)
                ->where('item', $gameInfo->item);

            if ($gameInfo->item <> '雙人花式繞樁') {
                $enrolls->where('gender', $gameInfo->gender);
            }

            $enrolls = $enrolls->orderBy('appearance')->get();
        }

        return view('gameInfo/appearance')->with(compact(
            'schedules',
            'scheduleId',
            'enrolls',
            'gameInfo',
            'isView'
        ));
    }

    public function schedules()
    {
        $schedules1Day   = app(ScheduleModel::class)->where('game_day', 1)->get();
        $schedules2Day = app(ScheduleModel::class)->where('game_day', 2)->get();
        $schedules3Day = app(ScheduleModel::class)->where('game_day', 3)->get();
        $schedules4ADay = app(ScheduleModel::class)->where('game_day', 4)->where('remark','A場')->get();
        $schedules4BAADay = app(ScheduleModel::class)->where('game_day', 4)->whereIn('order',['場次158','場次160','場次162','場次164','場次166','場次168','場次170',])->get();
        $schedules4ADay = $schedules4ADay->merge($schedules4BAADay);
        $schedules4BDay = app(ScheduleModel::class)->where('game_day', 4)->where('remark','B場')->whereNotIn('order',['場次158','場次160','場次162','場次164','場次166','場次168','場次170',])->get();

        return view('gameInfo/schedules')->with(compact('schedules1Day', 'schedules2Day', 'schedules3Day', 'schedules4ADay', 'schedules4BDay'));
    }

    public function groups()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            $level  = $schedule->level;
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;

            if ($item == '雙人花式繞樁') {
                // 雙人花不分性別
                $schedule->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                    ->where('game_id', config('app.game_id'))
                    ->where('level', $level)
                    ->where('group', $group)
                    ->where('item',$item)
                    ->orderBy('appearance')
                    ->orderBy('player_number')
                    ->orderBy('player_id')
                    ->get();
            } else {
                $schedule->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                    ->where('game_id', config('app.game_id'))
                    ->where('level', $level)
                    ->where('group', $group)
                    ->where('gender', $gender)
                    ->where('item',$item)
                    ->orderBy('appearance')
                    ->orderBy('player_number')
                    ->orderBy('player_id')
                    ->get();
            }
        }


        return view('gameInfo/groups')->with(['groups' => $schedules]);
    }

    public function teams()
    {/**/
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
    public function errata()
    {
        return view('gameInfo/errata');
    }

    public function nationalRecord()
    {
        return view('gameInfo/nationalRecord');
    }
}
