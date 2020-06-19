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
    public $group = '國小低年級';
    public $item = '初級指定套路(女)';

    public function all()
    {
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','連梓云')
            ->update([
                "skill_1"=>45,
                "art_1"=>20,
                "score_1"=>65,
                "skill_2"=>45,
                "art_2"=>19,
                "score_2"=>64,
                "skill_3"=>45,
                "art_3"=>20,
                "score_3"=>65,
                "rank"=>9,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','邱昱涵')
            ->update([
                "skill_1"=>48,
                "art_1"=>27,
                "score_1"=>75,
                "skill_2"=>48,
                "art_2"=>25,
                "score_2"=>73,
                "skill_3"=>48,
                "art_3"=>26,
                "score_3"=>74,
                "rank"=>7,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','鄭可勤')
            ->update([
                "skill_1"=>26,
                "art_1"=>16,
                "score_1"=>42,
                "skill_2"=>26,
                "art_2"=>11,
                "score_2"=>37,
                "skill_3"=>26,
                "art_3"=>11,
                "score_3"=>37,
                "rank"=>16,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','蘇容靚')
            ->update([
                "skill_1"=>52,
                "art_1"=>20,
                "score_1"=>72,
                "skill_2"=>52,
                "art_2"=>15,
                "score_2"=>67,
                "skill_3"=>52,
                "art_3"=>16,
                "score_3"=>68,
                "rank"=>8,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','賴禹彤')
            ->update([
                "skill_1"=>44,
                "art_1"=>17,
                "score_1"=>61,
                "skill_2"=>44,
                "art_2"=>14,
                "score_2"=>58,
                "skill_3"=>44,
                "art_3"=>24,
                "score_3"=>68,
                "rank"=>11,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','詹雅瑄')
            ->update([
                "skill_1"=>45,
                "art_1"=>11,
                "score_1"=>56,
                "skill_2"=>45,
                "art_2"=>10,
                "score_2"=>55,
                "skill_3"=>45,
                "art_3"=>12,
                "score_3"=>57,
                "rank"=>13,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','李昕澄')
            ->update([
                "skill_1"=>54,
                "art_1"=>24,
                "score_1"=>78,
                "skill_2"=>54,
                "art_2"=>23,
                "score_2"=>77,
                "skill_3"=>54,
                "art_3"=>30,
                "score_3"=>84,
                "rank"=>4,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','陳星妤')
            ->update([
                "skill_1"=>32,
                "art_1"=>8,
                "score_1"=>40,
                "skill_2"=>32,
                "art_2"=>8,
                "score_2"=>40,
                "skill_3"=>32,
                "art_3"=>10,
                "score_3"=>42,
                "rank"=>15,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','江昀霖')
            ->update([
                "skill_1"=>33,
                "art_1"=>15,
                "score_1"=>48,
                "skill_2"=>33,
                "art_2"=>11,
                "score_2"=>44,
                "skill_3"=>33,
                "art_3"=>12,
                "score_3"=>45,
                "rank"=>14,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','黃翊涵')
            ->update([
                "skill_1"=>56,
                "art_1"=>21,
                "score_1"=>77,
                "skill_2"=>56,
                "art_2"=>16,
                "score_2"=>72,
                "skill_3"=>56,
                "art_3"=>28,
                "score_3"=>84,
                "rank"=>5,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','簡珮涓')
            ->update([
                "skill_1"=>44,
                "art_1"=>18,
                "score_1"=>62,
                "skill_2"=>44,
                "art_2"=>15,
                "score_2"=>59,
                "skill_3"=>44,
                "art_3"=>23,
                "score_3"=>67,
                "rank"=>10,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','曾懿柔')
            ->update([
                "skill_1"=>48,
                "art_1"=>7,
                "score_1"=>55,
                "skill_2"=>48,
                "art_2"=>11,
                "score_2"=>59,
                "skill_3"=>48,
                "art_3"=>14,
                "score_3"=>62,
                "rank"=>12,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','莊舒宇')
            ->update([
                "skill_1"=>56,
                "art_1"=>25,
                "score_1"=>81,
                "skill_2"=>56,
                "art_2"=>27,
                "score_2"=>83,
                "skill_3"=>56,
                "art_3"=>32,
                "score_3"=>88,
                "rank"=>3,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','周育如')
            ->update([
                "skill_1"=>57,
                "art_1"=>25,
                "score_1"=>82,
                "skill_2"=>57,
                "art_2"=>30,
                "score_2"=>87,
                "skill_3"=>57,
                "art_3"=>33,
                "score_3"=>90,
                "rank"=>2,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','梅千允')
            ->update([
                "skill_1"=>55,
                "art_1"=>18,
                "score_1"=>73,
                "skill_2"=>55,
                "art_2"=>18,
                "score_2"=>73,
                "skill_3"=>55,
                "art_3"=>25,
                "score_3"=>80,
                "rank"=>6,
            ]);
        EnrollModel::leftjoin('player','player.id','enroll.player_id')->where('game_id',config('app.game_id'))
            ->where('group',$this->group)
            ->where('item',$this->item)
            ->where('name','陳妤婕')
            ->update([
                "skill_1"=>58,
                "art_1"=>26,
                "score_1"=>84,
                "skill_2"=>58,
                "art_2"=>31,
                "score_2"=>89,
                "skill_3"=>58,
                "art_3"=>29,
                "score_3"=>87,
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
