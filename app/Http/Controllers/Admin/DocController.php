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
}
