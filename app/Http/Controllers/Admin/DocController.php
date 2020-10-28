<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use App\Models\ScheduleModel;
use DB;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\DocService;

class DocController extends Controller
{
    public $group = '國中';
    public $item = '初級指定套路(女)';

    public function all()
    {
        $all = EnrollModel::select(\DB::raw('*,
            GROUP_CONCAT(item) AS itemAll
        '))
            ->where('enroll.game_id', config('app.game_id'))
            ->groupBy('enroll.player_id')
            ->get();

        foreach ($all as $key => $val) {
            $all[$key]['itemAll'] = explode(',', $val->itemAll);
        }

        return view('admin.doc.all')->with(['all' => $all]);
    }

    public function groups()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;
//            if ($item == '雙人花式繞樁') {
//                $schedule->players = EnrollModel::where('game_id', config('app.game_id'))
//                    ->where('group', $group)
//                    ->where('item', 'like', "%$item%")
//                    ->orderBy('appearance')
//                    ->orderBy('player_number')
//                    ->orderBy('player_id')
//                    ->get();
//            } else {

            $schedule->players = EnrollModel::where('game_id', config('app.game_id'))
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', 'like', "%$item%")
                ->orderBy('appearance')
                ->orderBy('player_number')
                ->orderBy('player_id')
                ->get();
        }
//        }

        return view('admin.doc.groups')->with(['groups' => $schedules]);
    }

    public function teams()
    {

//        $agencys = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->groupBy('agency')->get();
//
//        foreach ($agencys as $agency) {
//            echo ('<br><br>'.$agency->agency.',<br>');
//            $players = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->where('agency',$agency->agency)->orderBy('player_number')->groupBy('player_number')->get();
//            foreach ($players as $player) {
//                echo ($player->name.'('.$player->player_number.'),<br>');
//            }
//        }
//        dd();
//        $agencys = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->orderBy('agency')->get();

        $teams = EnrollModel::leftjoin('player','player.id','enroll.player_id')
//        wherehas('player', function ($query) {
//            $query->groupBy('agency');
//        })
            ->where('game_id',config('app.game_id'))
            ->groupBy('agency')
            ->get();

        foreach ($teams as $team) {
            $team->players = PlayerModel::where('agency', $team->player->agency)->get();
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
        $medalData = ScheduleModel::where('game_id', config('app.game_id'))->orderBy('id')->get();

        $goldTotal   = ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 1)->count();
        $silverTotal = ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 2)->count();
        $copperTotal = ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 3)->count();

        return view('admin/doc/medals')
            ->with('medalData', $medalData)
            ->with('goldTotal', $goldTotal)
            ->with('silverTotal', $silverTotal)
            ->with('copperTotal', $copperTotal);
    }

    public function players()
    {
        $schedules = ScheduleModel::select('item')->where('game_id', config('app.game_id'))->groupBy('item')->get();

        foreach ($schedules as $schedule) {
            $players[$schedule->item] = app(EnrollModel::class)->getEnrollPlayers($schedule->item);
        }

        return view('admin/doc/players')->with(compact('players'));
    }

    public function schedules()
    {

        $schedules = app(ScheduleModel::class)->getSchedules();
//        dd(ScheduleModel::where('game_id',10)->get());
//        dd($schedules);

//        $this->initTime = date("Y/m/d H:i:s", strtotime(date("Y/m/d H:i:s", strtotime($this->initTime))) + (($estimate * $比賽人數) / $每次上場人數));

//        for ($i = 0; $i < count($schedules); $i++) {
//            $schedules[$i]->game_day
//        }

//        $day = 1;
//        $this->info('第 1 天');
//        foreach ($schedules as $schedule) {
//            if ($schedule->game_day <> $day) {
//                $day++;
//                $this->initTime = '08:00';
//                $this->info("\n第 $day 天");
//            }
//            $this->printTime($schedule,$schedule->item, $schedule->estimate, $schedule->number_of_player);
//        }

        return view('admin/doc/schedules')->with(compact('schedules'));
    }

}
