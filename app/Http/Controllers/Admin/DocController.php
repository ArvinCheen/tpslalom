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
    public $group = '成年';
    public $item = '雙人花式繞樁';

    public function all()
    {
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','謝牧倫')
            ->update([
                "skill_1"=>31,
                "art_1"=>85,
                "score_1"=>116,
                "skill_2"=>36,
                "art_2"=>105,
                "score_2"=>141,
                "skill_3"=>44,
                "art_3"=>113,
                "score_3"=>157,
                "skill_4"=>44,
                "art_4"=>92,
                "score_4"=>136,
                "skill_5"=>34,
                "art_5"=>82,
                "score_5"=>116,
                "punish"=>4,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','周柏崴')
            ->update([
                "skill_1"=>31,
                "art_1"=>85,
                "score_1"=>116,
                "skill_2"=>36,
                "art_2"=>105,
                "score_2"=>141,
                "skill_3"=>44,
                "art_3"=>113,
                "score_3"=>157,
                "skill_4"=>44,
                "art_4"=>92,
                "score_4"=>136,
                "skill_5"=>34,
                "art_5"=>82,
                "score_5"=>116,
                "punish"=>4,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','黃淇宣')
            ->update([
                "skill_1"=>27,
                "art_1"=>61,
                "score_1"=>88,
                "skill_2"=>24,
                "art_2"=>60,
                "score_2"=>84,
                "skill_3"=>25,
                "art_3"=>70,
                "score_3"=>95,
                "skill_4"=>20,
                "art_4"=>53,
                "score_4"=>73,
                "skill_5"=>23,
                "art_5"=>60,
                "score_5"=>83,
                "punish"=>5,
                "rank"=>4,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','范予僖')
            ->update([
                "skill_1"=>27,
                "art_1"=>61,
                "score_1"=>88,
                "skill_2"=>24,
                "art_2"=>60,
                "score_2"=>84,
                "skill_3"=>25,
                "art_3"=>70,
                "score_3"=>95,
                "skill_4"=>20,
                "art_4"=>53,
                "score_4"=>73,
                "skill_5"=>23,
                "art_5"=>60,
                "score_5"=>83,
                "punish"=>5,
                "rank"=>4,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','邱映瑄')
            ->update([
                "skill_1"=>20,
                "art_1"=>66,
                "score_1"=>86,
                "skill_2"=>15,
                "art_2"=>56,
                "score_2"=>71,
                "skill_3"=>25,
                "art_3"=>75,
                "score_3"=>100,
                "skill_4"=>20,
                "art_4"=>63,
                "score_4"=>83,
                "skill_5"=>22,
                "art_5"=>70,
                "score_5"=>92,
                "punish"=>10,
                "rank"=>3,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','邱宇廷')
            ->update([
                "skill_1"=>20,
                "art_1"=>66,
                "score_1"=>86,
                "skill_2"=>15,
                "art_2"=>56,
                "score_2"=>71,
                "skill_3"=>25,
                "art_3"=>75,
                "score_3"=>100,
                "skill_4"=>20,
                "art_4"=>63,
                "score_4"=>83,
                "skill_5"=>22,
                "art_5"=>70,
                "score_5"=>92,
                "punish"=>10,
                "rank"=>3,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','范子聿')
            ->update([
                "skill_1"=>33,
                "art_1"=>67,
                "score_1"=>100,
                "skill_2"=>31,
                "art_2"=>70,
                "score_2"=>101,
                "skill_3"=>37,
                "art_3"=>82,
                "score_3"=>119,
                "skill_4"=>32,
                "art_4"=>65,
                "score_4"=>97,
                "skill_5"=>29,
                "art_5"=>64,
                "score_5"=>93,
                "punish"=>1,
                "rank"=>2,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','游瑋筑')
            ->update([
                "skill_1"=>33,
                "art_1"=>67,
                "score_1"=>100,
                "skill_2"=>31,
                "art_2"=>70,
                "score_2"=>101,
                "skill_3"=>37,
                "art_3"=>82,
                "score_3"=>119,
                "skill_4"=>32,
                "art_4"=>65,
                "score_4"=>97,
                "skill_5"=>29,
                "art_5"=>64,
                "score_5"=>93,
                "punish"=>1,
                "rank"=>2,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','侯鈞諺')
            ->update([
                "skill_1"=>25,
                "art_1"=>73,
                "score_1"=>98,
                "skill_2"=>24,
                "art_2"=>84,
                "score_2"=>108,
                "skill_3"=>29,
                "art_3"=>90,
                "score_3"=>119,
                "skill_4"=>26,
                "art_4"=>77,
                "score_4"=>103,
                "skill_5"=>23,
                "art_5"=>74,
                "score_5"=>97,
                "punish"=>11,
                "rank"=>1,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','陳建廷')
            ->update([
                "skill_1"=>25,
                "art_1"=>73,
                "score_1"=>98,
                "skill_2"=>24,
                "art_2"=>84,
                "score_2"=>108,
                "skill_3"=>29,
                "art_3"=>90,
                "score_3"=>119,
                "skill_4"=>26,
                "art_4"=>77,
                "score_4"=>103,
                "skill_5"=>23,
                "art_5"=>74,
                "score_5"=>97,
                "punish"=>11,
                "rank"=>1,
            ]);


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
