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
    public $item = '個人花式繞樁(女)';
    public function all()
    {

        //輸入總統盃成績用的暫時區

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '侯安伃')
            ->update([
                "skill_1" => 28,
                "art_1" => 32,
                "score_1" => 60,
                "skill_2" => 27,
                "art_2" => 33,
                "score_2" => 60,
                "skill_3" => 32,
                "art_3" => 40,
                "score_3" => 72,
                "skill_4" => 30,
                "art_4" => 37,
                "score_4" => 67,
                "skill_5" => 30,
                "art_5" => 36,
                "score_5" => 66,
                "punish" => 6,
                "rank" => 1,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '劉以琳')
            ->update([
                "skill_1" => 32,
                "art_1" => 36,
                "score_1" => 68,
                "skill_2" => 32,
                "art_2" => 35,
                "score_2" => 67,
                "skill_3" => 32,
                "art_3" => 37,
                "score_3" => 69,
                "skill_4" => 30,
                "art_4" => 32,
                "score_4" => 62,
                "skill_5" => 31,
                "art_5" => 34,
                "score_5" => 65,
                "punish" => 3,
                "rank" => 2,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '藍立芯')
            ->update([
                "skill_1" => 16,
                "art_1" => 28,
                "score_1" => 44,
                "skill_2" => 20,
                "art_2" => 30,
                "score_2" => 50,
                "skill_3" => 18,
                "art_3" => 31,
                "score_3" => 49,
                "skill_4" => 15,
                "art_4" => 23,
                "score_4" => 38,
                "skill_5" => 16,
                "art_5" => 28,
                "score_5" => 44,
                "punish" => 10,
                "rank" => 5,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '范子聿')
            ->update([
                "skill_1" => 30,
                "art_1" => 34,
                "score_1" => 64,
                "skill_2" => 29,
                "art_2" => 30,
                "score_2" => 59,
                "skill_3" => 31,
                "art_3" => 36,
                "score_3" => 67,
                "skill_4" => 30,
                "art_4" => 34,
                "score_4" => 64,
                "skill_5" => 27,
                "art_5" => 33,
                "score_5" => 60,
                "punish" => 4,
                "rank" => 3,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '張可蓁')
            ->update([
                "skill_1" => 15,
                "art_1" => 22,
                "score_1" => 37,
                "skill_2" => 20,
                "art_2" => 27,
                "score_2" => 47,
                "skill_3" => 21,
                "art_3" => 27,
                "score_3" => 48,
                "skill_4" => 16,
                "art_4" => 21,
                "score_4" => 37,
                "skill_5" => 17,
                "art_5" => 24,
                "score_5" => 41,
                "punish" => 7,
                "rank" => 6,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '楊宇涵')
            ->update([
                "skill_1" => 25,
                "art_1" => 30,
                "score_1" => 55,
                "skill_2" => 30,
                "art_2" => 32,
                "score_2" => 62,
                "skill_3" => 31,
                "art_3" => 35,
                "score_3" => 66,
                "skill_4" => 27,
                "art_4" => 30,
                "score_4" => 57,
                "skill_5" => 31,
                "art_5" => 33,
                "score_5" => 64,
                "punish" => 3,
                "rank" => 4,
            ]);

























        //輸入總統盃成績用的暫時區
         echo 'done';
//        $all = EnrollModel::select(\DB::raw('
//            enroll.player_number,
//            name,
//            `level`,
//            `group`,
//            gender,
//            team_name,
//            agency,
//            city,
//            coach,
//            leader,
//            management,
//            GROUP_CONCAT(item) AS itemAll
//        '))
//            ->leftJoin('player', 'player.id', 'enroll.player_id')
//            ->leftJoin('account', 'account.id', 'player.account_id')
//            ->where('enroll.game_id', config('app.game_id'))
//            ->groupBy('enroll.player_number')
//            ->get();

//        foreach ($all as $doc) {
//            echo $doc->itemAll."<br>";
//            if (preg_match("/\前進雙足S型/i", $doc->itemAll)) {
//                $doc->doubleS = '前進雙足S型';
//            }
//            if (preg_match("/\前進單足S型/i", $doc->itemAll)) {
//                $doc->singleS = '前進單足S型';
//            }
//            if (preg_match("/\前進交叉型/i", $doc->itemAll)) {
//                $doc->cross = '前進交叉型';
//            }
//        }

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
