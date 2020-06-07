<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\RegistryFeeModel;
use App\Models\ScheduleModel;
use DB;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\DocService;

class DocController extends Controller
{
    public function all()
    {
        $all = EnrollModel::select(\DB::raw('
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

        foreach ($all as $doc) {
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

        return view('admin/doc/all')->with(compact('all'));
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
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }

        return view('admin/doc/groups')->with(['groups' => $schedules]);
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

        return view('admin/doc/teams')->with(compact('teams'));
    }

    public function checkBill()
    {
        $bills = RegistryFeeModel::select(DB::raw('
            account.id,
            account.account,
            team_name,
            email,
            phone,
            address,
            coach,
            leader,
            management,
            sum(fee) AS totalFee
    '))
        ->leftJoin('account', 'account.id', 'registry_fee.account_id')
        ->where('game_id', config('app.game_id'))
        ->groupBy('account.id')
        ->get();


        $total = $bills->sum('totalFee');

        return view('admin/doc/checkBill')->with(compact('bills', 'total'));
    }

    public function medals()
    {
        $enrollModel = new EnrollModel();

        $medalData = $enrollModel->getMedalQuantity();

        $goldTotal   = 0;
        $silverTotal = 0;
        $copperTotal = 0;

        foreach ($medalData as $val) {
            if ($val->level == '選手組') {
                $val->city = '不分縣';
            } else {
                $val->city = $val->city == '臺北市' ? '臺北市' : '外縣市';
            }
            $val->gold   = 1;
            $val->silver = $val->quantity >= 2 ? 1 : 0;
            $val->copper = $val->quantity >= 3 ? 1 : 0;

            $goldTotal   += $val->gold;
            $silverTotal += $val->silver;
            $copperTotal += $val->copper;
        }

        return view('admin/doc/medals')
            ->with('medalData', $medalData)
            ->with('goldTotal', $goldTotal)
            ->with('silverTotal', $silverTotal)
            ->with('copperTotal', $copperTotal);
    }

    public function players()
    {
        $players = (object)[
            'doubleS' => app(EnrollModel::class)->getEnrollPlayers($item = '前進雙足S型'),
            'singleS' => app(EnrollModel::class)->getEnrollPlayers($item = '前進單足S型'),
            'cross'   => app(EnrollModel::class)->getEnrollPlayers($item = '前進交叉型'),
        ];

        return view('admin/doc/players')->with(compact('players'));
    }

    public function schedules()
    {

        $schedules = app(ScheduleModel::class)->getSchedules();

        return view('admin/doc/schedules')->with(compact('schedules'));
    }

    public function certificate()
    {
//        $schedules = ScheduleModel::where('game_id',config('app.game_id'))->get();
//
//        foreach ($schedules as $schedule) {
//            $schedule->result = EnrollModel::leftjoin('player','player.id','enroll.player_id')
//                ->where('game_id', config('app.game_id'))
//                ->whereNotNull('rank')
//                ->where('level',$schedule->level)
//                ->where('group',$schedule->group)
//                ->where('item',$schedule->item)
//                ->where('gender',$schedule->gender)
//                ->orderBy('rank')
//                ->get();
//        }

        $teams = app(EnrollModel::class)->getParticipateTeam();

        foreach ($teams as $team) {
            $team->certificate = DB::select("
                select team_name,
                       player.name,
                       enroll.rank,
                       schedule.order,
                       schedule.gender,
                       schedule.level,
                       schedule.group,
                       schedule.item
                from account
                         left join player on player.account_id = account.id
                         left join enroll on enroll.player_id = player.id
                         left join schedule on schedule.level = enroll.level and schedule.`group` = enroll.`group` and
                                               schedule.item = enroll.item and schedule.gender = player.gender
                where schedule.game_id = ".config('app.game_id')."
                  and enroll.game_id = ".config('app.game_id')."
                  and enroll.rank is not null
                  and account.id = $team->account_id
                order by player.name,enroll.`rank`
                ");

        }

//        foreach ($teams as $team) {
//            foreach ($team->certificate as $certificate) {
//                dd($certificate);
//            }
//        }
//dd($teams[0]->certificate[0]->team_name);
        return view('admin/doc/certificate')->with(compact('teams'));
    }
}
