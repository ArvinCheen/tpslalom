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
    public $group = '國小中年級';
    public $item = '初級指定套路(男)';

    public function all()
    {

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','楊恩頊')
            ->update([
                "skill_1"=>55,
                "art_1"=>20,
                "score_1"=>75,
                "skill_2"=>55,
                "art_2"=>22,
                "score_2"=>77,
                "skill_3"=>55,
                "art_3"=>25,
                "score_3"=>80,
                "rank"=>11,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','王宥森')
            ->update([
                "skill_1"=>55,
                "art_1"=>28,
                "score_1"=>83,
                "skill_2"=>55,
                "art_2"=>25,
                "score_2"=>80,
                "skill_3"=>55,
                "art_3"=>28,
                "score_3"=>83,
                "rank"=>8,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','廖嘉哲')
            ->update([
                "skill_1"=>54,
                "art_1"=>25,
                "score_1"=>79,
                "skill_2"=>54,
                "art_2"=>19,
                "score_2"=>73,
                "skill_3"=>54,
                "art_3"=>20,
                "score_3"=>74,
                "rank"=>14,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','林曉擎')
            ->update([
                "skill_1"=>51,
                "art_1"=>23,
                "score_1"=>74,
                "skill_2"=>51,
                "art_2"=>17,
                "score_2"=>68,
                "skill_3"=>51,
                "art_3"=>26,
                "score_3"=>77,
                "rank"=>15,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','傅可瑞')
            ->update([
                "skill_1"=>57,
                "art_1"=>31,
                "score_1"=>88,
                "skill_2"=>57,
                "art_2"=>30,
                "score_2"=>87,
                "skill_3"=>57,
                "art_3"=>31,
                "score_3"=>88,
                "rank"=>1,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','許祐誠')
            ->update([
                "skill_1"=>57,
                "art_1"=>28,
                "score_1"=>85,
                "skill_2"=>57,
                "art_2"=>28,
                "score_2"=>85,
                "skill_3"=>57,
                "art_3"=>27,
                "score_3"=>84,
                "rank"=>7,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','詹曜駿')
            ->update([
                "skill_1"=>52,
                "art_1"=>14,
                "score_1"=>66,
                "skill_2"=>52,
                "art_2"=>13,
                "score_2"=>65,
                "skill_3"=>52,
                "art_3"=>18,
                "score_3"=>70,
                "rank"=>17,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','黃年祥')
            ->update([
                "skill_1"=>48,
                "art_1"=>18,
                "score_1"=>66,
                "skill_2"=>48,
                "art_2"=>10,
                "score_2"=>58,
                "skill_3"=>48,
                "art_3"=>21,
                "score_3"=>69,
                "rank"=>20,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','李忻翰')
            ->update([
                "skill_1"=>54,
                "art_1"=>25,
                "score_1"=>79,
                "skill_2"=>54,
                "art_2"=>18,
                "score_2"=>72,
                "skill_3"=>54,
                "art_3"=>26,
                "score_3"=>80,
                "rank"=>13,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','康鈞愷')
            ->update([
                "skill_1"=>57,
                "art_1"=>29,
                "score_1"=>86,
                "skill_2"=>57,
                "art_2"=>32,
                "score_2"=>89,
                "skill_3"=>57,
                "art_3"=>29,
                "score_3"=>86,
                "rank"=>2,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','葉承炘')
            ->update([
                "skill_1"=>52,
                "art_1"=>32,
                "score_1"=>84,
                "skill_2"=>52,
                "art_2"=>35,
                "score_2"=>87,
                "skill_3"=>52,
                "art_3"=>32,
                "score_3"=>84,
                "rank"=>6,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','梅拓允')
            ->update([
                "skill_1"=>58,
                "art_1"=>27,
                "score_1"=>85,
                "skill_2"=>58,
                "art_2"=>27,
                "score_2"=>85,
                "skill_3"=>58,
                "art_3"=>29,
                "score_3"=>87,
                "rank"=>3,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','許晟睿')
            ->update([
                "skill_1"=>46,
                "art_1"=>17,
                "score_1"=>63,
                "skill_2"=>46,
                "art_2"=>14,
                "score_2"=>60,
                "skill_3"=>46,
                "art_3"=>19,
                "score_3"=>65,
                "rank"=>21,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','廖郁丞')
            ->update([
                "skill_1"=>55,
                "art_1"=>25,
                "score_1"=>80,
                "skill_2"=>55,
                "art_2"=>22,
                "score_2"=>77,
                "skill_3"=>55,
                "art_3"=>21,
                "score_3"=>76,
                "rank"=>12,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','鐘友謙')
            ->update([
                "skill_1"=>56,
                "art_1"=>23,
                "score_1"=>79,
                "skill_2"=>56,
                "art_2"=>31,
                "score_2"=>87,
                "skill_3"=>56,
                "art_3"=>29,
                "score_3"=>85,
                "rank"=>5,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','林品佑')
            ->update([
                "skill_1"=>38,
                "art_1"=>11,
                "score_1"=>49,
                "skill_2"=>38,
                "art_2"=>13,
                "score_2"=>51,
                "skill_3"=>38,
                "art_3"=>19,
                "score_3"=>57,
                "rank"=>22,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','胡曾博')
            ->update([
                "skill_1"=>49,
                "art_1"=>20,
                "score_1"=>69,
                "skill_2"=>49,
                "art_2"=>13,
                "score_2"=>62,
                "skill_3"=>49,
                "art_3"=>18,
                "score_3"=>67,
                "rank"=>18,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','高瑛翔')
            ->update([
                "skill_1"=>46,
                "art_1"=>21,
                "score_1"=>67,
                "skill_2"=>46,
                "art_2"=>17,
                "score_2"=>63,
                "skill_3"=>46,
                "art_3"=>19,
                "score_3"=>65,
                "rank"=>19,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','蕭紹凱')
            ->update([
                "skill_1"=>53,
                "art_1"=>20,
                "score_1"=>73,
                "skill_2"=>53,
                "art_2"=>15,
                "score_2"=>68,
                "skill_3"=>53,
                "art_3"=>19.5,
                "score_3"=>72.5,
                "rank"=>16,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','廖徳越')
            ->update([
                "skill_1"=>55,
                "art_1"=>24,
                "score_1"=>79,
                "skill_2"=>55,
                "art_2"=>26,
                "score_2"=>81,
                "skill_3"=>55,
                "art_3"=>23,
                "score_3"=>78,
                "rank"=>9,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','江旺霖')
            ->update([
                "skill_1"=>52,
                "art_1"=>29,
                "score_1"=>81,
                "skill_2"=>52,
                "art_2"=>24,
                "score_2"=>76,
                "skill_3"=>52,
                "art_3"=>26,
                "score_3"=>78,
                "rank"=>10,
            ]);

        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','施羽仲')
            ->update([
                "skill_1"=>58,
                "art_1"=>20,
                "score_1"=>78,
                "skill_2"=>58,
                "art_2"=>33,
                "score_2"=>91,
                "skill_3"=>58,
                "art_3"=>27,
                "score_3"=>85,
                "rank"=>4,
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
