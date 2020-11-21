<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
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
        $gameInfo           = null;
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
                ->where('item', $gameInfo->item)
                ->where('level', $gameInfo->level);

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
        $schedules1Day = app(ScheduleModel::class)->where('game_id', config('app.game_id'))->where('game_day', 1)->get();
        $schedules2Day = app(ScheduleModel::class)->where('game_id', config('app.game_id'))->where('game_day', 2)->get();
        $schedules3Day = app(ScheduleModel::class)->where('game_id', config('app.game_id'))->where('game_day', 3)->get();

        return view('gameInfo/schedules')->with(compact('schedules1Day', 'schedules2Day', 'schedules3Day'));
    }

    public function groups()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->get();

        foreach ($schedules as $schedule) {
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;
            $level   = $schedule->level;

            $query             = EnrollModel::query();
            $query->where('game_id', config('app.game_id'));

            if (strpos($item, '套路') !== false) {
                $query->where('group2', $group);
            } else {
                $query->where('group', $group);
            }

            $schedule->players = $query->where('gender', $gender)
                ->where('item', $item)
                ->where('level', $level)
                ->orderBy('appearance')
                ->orderBy('player_number')
                ->orderBy('player_id')
                ->get();
        }

        return view('gameInfo/groups')->with(['groups' => $schedules]);
    }

    public function agencies()
    {
        $agencies = PlayerModel::groupBy('agency')->get();

        foreach ($agencies as $agency) {
            $coach   = '';
            $leader  = '';
            $manager = '';

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('coach')->groupBy('coach')->get() as $coachData) {
                if ($coachData->coach <> '') {
                    $coach .= $coachData->coach . '、';
                }
            }

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('leader')->groupBy('leader')->get() as $leaderData) {
                if ($leaderData->leader <> '') {
                    $leader .= $leaderData->leader . '、';
                }
            }

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('manager')->groupBy('manager')->get() as $managerData) {
                if ($managerData->manager <> '') {
                    $manager .= $managerData->manager . '、';
                }
            }

            if ($coach <> '') {
                $coach = mb_substr($coach, 0, -1);
            }

            if ($leader <> '') {
                $leader = mb_substr($leader, 0, -1);
            }

            if ($manager <> '') {
                $manager = mb_substr($manager, 0, -1);
            }

            if (strpos($agency->agency, $agency->city) !== false) {
                $agencyName = $agency->agency;
            } else {
                $agencyName = $agency->city . $agency->agency;
            }

            $agency->players  = PlayerModel::where('agency', $agency->agency)->get();
            $agency->agency   = $agencyName;
            $agency->teamMans = "教練： $coach / 領隊： $leader / 經理： $manager";
        }

        return view('gameInfo/agencies')->with(compact('agencies'));
    }

    public function teams()
    {
        $teams = EnrollModel::where('game_id', config('app.game_id'))
            ->groupBy('account_id')
            ->get();

        foreach ($teams as $team) {
            $team->players = EnrollModel::where('game_id', config('app.game_id'))
                ->where('account_id', $team->account_id)
                ->groupBy('player_id')
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

    public function program()
    {
        return view('gameInfo/program');
    }
}
