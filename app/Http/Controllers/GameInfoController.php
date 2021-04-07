<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
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
        $schedules1Day = app(ScheduleModel::class)->where('game_day', 1)->get();
        $schedules2Day = app(ScheduleModel::class)->where('game_day', 2)->get();
        $schedules3Day = app(ScheduleModel::class)->where('game_day', 3)->get();
        $schedules4Day = app(ScheduleModel::class)->where('game_day', 4)->get();

        return view('gameInfo/schedules')->with(compact('schedules1Day', 'schedules2Day', 'schedules3Day', 'schedules4Day'));
    }

    public function groups()
    {
        $enrolls = EnrollModel::get();

        // foreach ($enrolls as $enroll) {
        //     echo "
        //     選手：{$enroll->player->name} 
        //     隊伍：{$enroll->player->agency}  
        //     教練：{$enroll->player->coach} 
        //     領隊：{$enroll->player->leader} 
        //     經理：{$enroll->player->manager} 
        //     報名項目：{$enroll->group} {$enroll->gender} {$enroll->item}<br>";
        // }

        // dd();
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))->get();

        foreach ($schedules as $schedule) {
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;

            if ($item == '雙人花式繞樁') {
                // 雙人花不分性別
                $schedule->players = EnrollModel::where('game_id', config('app.game_id'))
                    // ->where('group', $group) //全國賽不分
                    ->where('item', $item)
                    ->orderBy('appearance')
                    ->orderBy('player_id')
                    ->get();
            } else {
                $schedule->players = EnrollModel::where('game_id', config('app.game_id'))
                    ->where('group', $group)
                    ->where('gender', $gender)
                    ->where('item', $item)
                    ->orderBy('appearance')
                    ->orderBy('player_id')
                    ->get();
            }
        }
dd($schedule);
        return view('gameInfo/groups')->with(['groups' => $schedules]);
    }

    public function teams()
    {
        $agencys = PlayerModel::groupBy('agency')->get();

        foreach ($agencys as $agency) {
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

        return view('gameInfo/teams')->with(compact('agencys'));
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
