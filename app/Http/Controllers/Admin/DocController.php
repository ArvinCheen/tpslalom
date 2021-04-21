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
            $level  = $schedule->level;

            $query = EnrollModel::query();
            $query->where('game_id', config('app.game_id'));

            if (env('GAME') == 13) {
                $schedule->players = $query->where('gender', $gender)
                    ->where('item', $item)
                    ->orderBy('appearance')
                    ->orderBy('player_number')
                    ->orderBy('player_id')
                    ->get();
            } else {
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
        }

        return view('admin.doc.groups')->with(['groups' => $schedules]);
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
                ->orderBy('appearance')
                ->orderBy('player_number')
                ->orderBy('player_id')
                ->get();
        }

        return view('admin/doc/teams')->with(compact('teams'));
    }

    public function agencies()
    {
        $agencies = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->groupBy('agency')
            ->get();

        foreach ($agencies as $agency) {
            $agency->players = PlayerModel::where('agency', $agency->player->agency)->get();
        }

        return view('admin/doc/agencies')->with(compact('agencies'));
    }

    public function checkBill()
    {
        $bills = RegistryFeeModel::select(DB::raw('
            *,
            sum(fee) AS totalFee
    '))
            ->where('game_id', config('app.game_id'))
            ->groupBy('account_id')
            ->get();


        $total = $bills->sum('totalFee');

        return view('admin/doc/checkBill')->with(compact('bills', 'total'));
    }

    public function medals()
    {
        $medalData = ScheduleModel::where('game_id', config('app.game_id'))->orderBy('id')->get();

        $medalTotal = (object)[
            'rank1' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 1)->count(),
            'rank2' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 2)->count(),
            'rank3' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 3)->count(),
            'rank4' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 4)->count(),
            'rank5' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 5)->count(),
            'rank6' => ScheduleModel::where('game_id', config('app.game_id'))->where('number_of_player', '>=', 5)->count(),
        ];

        return view('admin/doc/medals')
            ->with('medalData', $medalData)
            ->with('medalTotal', $medalTotal);
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
