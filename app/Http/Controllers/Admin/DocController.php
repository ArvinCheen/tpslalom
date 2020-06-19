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
    public $group = '國小高年級';
    public $item = '初級指定套路(男)';

    public function all()
    {


        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','曾懿謙')
            ->update([
                "skill_1"=>46,
                "art_1"=>15,
                "score_1"=>61,
                "skill_2"=>46,
                "art_2"=>16,
                "score_2"=>62,
                "skill_3"=>46,
                "art_3"=>11,
                "score_3"=>57,
                "rank"=>11,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','方俞淵')
            ->update([
                "skill_1"=>54,
                "art_1"=>22,
                "score_1"=>76,
                "skill_2"=>54,
                "art_2"=>18,
                "score_2"=>72,
                "skill_3"=>54,
                "art_3"=>17,
                "score_3"=>71,
                "rank"=>6,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','廖德祐')
            ->update([
                "skill_1"=>53,
                "art_1"=>25,
                "score_1"=>78,
                "skill_2"=>53,
                "art_2"=>22,
                "score_2"=>75,
                "skill_3"=>53,
                "art_3"=>21,
                "score_3"=>74,
                "rank"=>2,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','林濬程')
            ->update([
                "skill_1"=>52,
                "art_1"=>19,
                "score_1"=>71,
                "skill_2"=>52,
                "art_2"=>17,
                "score_2"=>69,
                "skill_3"=>52,
                "art_3"=>12,
                "score_3"=>64,
                "rank"=>8,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','許祐瑋')
            ->update([
                "skill_1"=>55,
                "art_1"=>23,
                "score_1"=>78,
                "skill_2"=>55,
                "art_2"=>20,
                "score_2"=>75,
                "skill_3"=>55,
                "art_3"=>26,
                "score_3"=>81,
                "rank"=>1,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','莊劭軒')
            ->update([
                "skill_1"=>56,
                "art_1"=>16,
                "score_1"=>72,
                "skill_2"=>56,
                "art_2"=>18,
                "score_2"=>74,
                "skill_3"=>56,
                "art_3"=>22,
                "score_3"=>78,
                "rank"=>3,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','李燿辰')
            ->update([
                "skill_1"=>57,
                "art_1"=>18,
                "score_1"=>75,
                "skill_2"=>57,
                "art_2"=>14,
                "score_2"=>71,
                "skill_3"=>57,
                "art_3"=>20.5,
                "score_3"=>77.5,
                "rank"=>5,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','朱軒廷')
            ->update([
                "skill_1"=>53,
                "art_1"=>21,
                "score_1"=>74,
                "skill_2"=>53,
                "art_2"=>21,
                "score_2"=>74,
                "skill_3"=>53,
                "art_3"=>23,
                "score_3"=>76,
                "rank"=>4,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','林胤斈')
            ->update([
                "skill_1"=>53,
                "art_1"=>12,
                "score_1"=>65,
                "skill_2"=>53,
                "art_2"=>13,
                "score_2"=>66,
                "skill_3"=>53,
                "art_3"=>18,
                "score_3"=>71,
                "rank"=>9,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','楊鈞亞')
            ->update([
                "skill_1"=>56,
                "art_1"=>14,
                "score_1"=>70,
                "skill_2"=>56,
                "art_2"=>14,
                "score_2"=>70,
                "skill_3"=>56,
                "art_3"=>22,
                "score_3"=>78,
                "rank"=>7,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','江承祐')
            ->update([
                "skill_1"=>54,
                "art_1"=>16,
                "score_1"=>70,
                "skill_2"=>54,
                "art_2"=>11,
                "score_2"=>65,
                "skill_3"=>54,
                "art_3"=>15,
                "score_3"=>69,
                "rank"=>10,
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
