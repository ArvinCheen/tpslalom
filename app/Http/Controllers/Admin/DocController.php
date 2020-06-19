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
    public $item = '初級指定套路(女)';

    public function all()
    {


        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','謝依潔')
            ->update([
                "skill_1"=>47,
                "art_1"=>17,
                "score_1"=>64,
                "skill_2"=>47,
                "art_2"=>16,
                "score_2"=>63,
                "skill_3"=>47,
                "art_3"=>20,
                "score_3"=>67,
                "rank"=>12,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','邱宇涵')
            ->update([
                "skill_1"=>56,
                "art_1"=>32,
                "score_1"=>88,
                "skill_2"=>56,
                "art_2"=>31,
                "score_2"=>87,
                "skill_3"=>56,
                "art_3"=>30,
                "score_3"=>86,
                "rank"=>1,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','龎式晴')
            ->update([
                "skill_1"=>54,
                "art_1"=>27,
                "score_1"=>81,
                "skill_2"=>54,
                "art_2"=>25,
                "score_2"=>79,
                "skill_3"=>54,
                "art_3"=>28,
                "score_3"=>82,
                "rank"=>4,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','韓千賀')
            ->update([
                "skill_1"=>39,
                "art_1"=>20,
                "score_1"=>59,
                "skill_2"=>39,
                "art_2"=>18,
                "score_2"=>57,
                "skill_3"=>39,
                "art_3"=>15,
                "score_3"=>54,
                "rank"=>14,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','蔡昀珈')
            ->update([
                "skill_1"=>54,
                "art_1"=>31,
                "score_1"=>85,
                "skill_2"=>54,
                "art_2"=>26,
                "score_2"=>80,
                "skill_3"=>54,
                "art_3"=>25,
                "score_3"=>79,
                "rank"=>3,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','賴亭孜')
            ->update([
                "skill_1"=>54,
                "art_1"=>14,
                "score_1"=>68,
                "skill_2"=>54,
                "art_2"=>19,
                "score_2"=>73,
                "skill_3"=>54,
                "art_3"=>24,
                "score_3"=>78,
                "rank"=>7,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','趙丰瑜')
            ->update(["skill_1"=>54,
                      "art_1"=>13,
                      "score_1"=>67,
                      "skill_2"=>54,
                      "art_2"=>15,
                      "score_2"=>69,
                      "skill_3"=>54,
                      "art_3"=>22,
                      "score_3"=>76,
                      "rank"=>11,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','黃羿瑄')
            ->update([
                "skill_1"=>47,
                "art_1"=>14,
                "score_1"=>61,
                "skill_2"=>47,
                "art_2"=>12,
                "score_2"=>59,
                "skill_3"=>47,
                "art_3"=>19,
                "score_3"=>66,
                "rank"=>13,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','黃子容')
            ->update([
                "skill_1"=>52,
                "art_1"=>18,
                "score_1"=>70,
                "skill_2"=>52,
                "art_2"=>19,
                "score_2"=>71,
                "skill_3"=>52,
                "art_3"=>23,
                "score_3"=>75,
                "rank"=>9,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','高可昕')
            ->update([
                "skill_1"=>57,
                "art_1"=>22,
                "score_1"=>79,
                "skill_2"=>57,
                "art_2"=>24,
                "score_2"=>81,
                "skill_3"=>57,
                "art_3"=>27,
                "score_3"=>84,
                "rank"=>2,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','吳宥萱')
            ->update([
                "skill_1"=>52,
                "art_1"=>18,
                "score_1"=>70,
                "skill_2"=>52,
                "art_2"=>20,
                "score_2"=>72,
                "skill_3"=>52,
                "art_3"=>26,
                "score_3"=>78,
                "rank"=>8,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','廖子寧')
            ->update([
                "skill_1"=>53,
                "art_1"=>20,
                "score_1"=>73,
                "skill_2"=>53,
                "art_2"=>17,
                "score_2"=>70,
                "skill_3"=>53,
                "art_3"=>18,
                "score_3"=>71,
                "rank"=>10,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','林沄萱')
            ->update([
                "skill_1"=>40,
                "art_1"=>11,
                "score_1"=>51,
                "skill_2"=>40,
                "art_2"=>11,
                "score_2"=>51,
                "skill_3"=>40,
                "art_3"=>16,
                "score_3"=>56,
                "rank"=>15,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','謝子芸')
            ->update([
                "skill_1"=>56,
                "art_1"=>25,
                "score_1"=>81,
                "skill_2"=>56,
                "art_2"=>17,
                "score_2"=>73,
                "skill_3"=>56,
                "art_3"=>26,
                "score_3"=>82,
                "rank"=>5,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','周育安')
            ->update([
                "skill_1"=>53,
                "art_1"=>26,
                "score_1"=>79,
                "skill_2"=>53,
                "art_2"=>24,
                "score_2"=>77,
                "skill_3"=>53,
                "art_3"=>29,
                "score_3"=>82,
                "rank"=>6,
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
