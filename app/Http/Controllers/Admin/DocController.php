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
    public $group = '高中';
    public $item = '個人花式繞樁(男)';

    public function all()
    {

        //輸入總統盃成績用的暫時區

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '呂秉宥')
            ->update([
                "skill_1" => 23,
                "art_1"   => 31,
                "score_1" => 54,
                "skill_2" => 23,
                "art_2"   => 32,
                "score_2" => 55,
                "skill_3" => 25,
                "art_3"   => 34,
                "score_3" => 59,
                "skill_4" => 24,
                "art_4"   => 34,
                "score_4" => 58,
                "skill_5" => 23,
                "art_5"   => 33,
                "score_5" => 56,
                "punish"  => 10,
                "rank"    => 4,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '陳建廷')
            ->update([
                "skill_1" => 15,
                "art_1"   => 34,
                "score_1" => 49,
                "skill_2" => 14,
                "art_2"   => 33,
                "score_2" => 47,
                "skill_3" => 15,
                "art_3"   => 36,
                "score_3" => 51,
                "skill_4" => 8,
                "art_4"   => 27,
                "score_4" => 35,
                "skill_5" => 14,
                "art_5"   => 35,
                "score_5" => 49,
                "punish"  => 21,
                "rank"    => 5,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '周柏崴')
            ->update([
                "skill_1" => 41,
                "art_1"   => 48,
                "score_1" => 89,
                "skill_2" => 34,
                "art_2"   => 35,
                "score_2" => 69,
                "skill_3" => 34,
                "art_3"   => 40,
                "score_3" => 74,
                "skill_4" => 38,
                "art_4"   => 41,
                "score_4" => 79,
                "skill_5" => 39,
                "art_5"   => 43,
                "score_5" => 82,
                "punish"  => 4,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '侯鈞諺')
            ->update([
                "skill_1" => 28,
                "art_1"   => 33,
                "score_1" => 61,
                "skill_2" => 27,
                "art_2"   => 33,
                "score_2" => 60,
                "skill_3" => 30,
                "art_3"   => 35,
                "score_3" => 65,
                "skill_4" => 30,
                "art_4"   => 37,
                "score_4" => 67,
                "skill_5" => 36,
                "art_5"   => 42,
                "score_5" => 78,
                "punish"  => 6,
                "rank"    => 3,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '張唯仁')
            ->update([
                "skill_1" => 33,
                "art_1"   => 46,
                "score_1" => 79,
                "skill_2" => 24,
                "art_2"   => 37,
                "score_2" => 61,
                "skill_3" => 35,
                "art_3"   => 46,
                "score_3" => 81,
                "skill_4" => 32,
                "art_4"   => 43,
                "score_4" => 75,
                "skill_5" => 34,
                "art_5"   => 44,
                "score_5" => 78,
                "punish"  => 10,
                "rank"    => 2,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '賴徐捷')
            ->update([
                "skill_1" => 45,
                "art_1"   => 49,
                "score_1" => 94,
                "skill_2" => 32,
                "art_2"   => 38,
                "score_2" => 70,
                "skill_3" => 35,
                "art_3"   => 37,
                "score_3" => 72,
                "skill_4" => 38,
                "art_4"   => 40,
                "score_4" => 78,
                "skill_5" => 38,
                "art_5"   => 40,
                "score_5" => 78,
                "punish"  => 2,
                "rank"    => 1,
            ]);


//        return view('admin/doc/all')->with(compact('all'));
    }

    public function groups()
    {
        $schedules = app(ScheduleModel::class)->getSchedules();

        foreach ($schedules as $schedule) {
            $group  = $schedule->group;
            $gender = $schedule->gender;
            $item   = $schedule->item;

            $schedule->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', 'like', "%$item%")
                ->orderBy('appearance')
                ->orderBy('player_number')
                ->orderBy('player_id')
                ->get();
        }

        return view('admin/doc/groups')->with(['groups' => $schedules]);
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
        $schedules = ScheduleModel::select('item')->where('game_id', config('app.game_id'))->groupBy('item')->get();

        foreach ($schedules as $schedule) {
            $players[$schedule->item] = app(EnrollModel::class)->getEnrollPlayers($schedule->item);
        }

        return view('admin/doc/players')->with(compact('players'));
    }

    public function schedules()
    {

        $schedules = app(ScheduleModel::class)->getSchedules();

        return view('admin/doc/schedules')->with(compact('schedules'));
    }

}
