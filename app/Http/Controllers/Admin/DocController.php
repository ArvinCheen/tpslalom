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
    public $item = '個人花式繞樁(男)';
    public function all()
    {

        //輸入總統盃成績用的暫時區

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '黃奕硯')
            ->update(["skill_1" => 33,
                      "art_1"   => 37,
                      "score_1" => 70,
                      "skill_2" => 29,
                      "art_2"   => 32,
                      "score_2" => 61,
                      "skill_3" => 30,
                      "art_3"   => 25,
                      "score_3" => 55,
                      "skill_4" => 30,
                      "art_4"   => 33,
                      "score_4" => 63,
                      "skill_5" => 33,
                      "art_5"   => 37,
                      "score_5" => 70,
                      "punish"  => 4,
                      "rank"    => 3,
            ]);

        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '劉哲呈')
            ->update([
                "skill_1" => 33,
                "art_1"   => 30,
                "score_1" => 63,
                "skill_2" => 33,
                "art_2"   => 30,
                "score_2" => 63,
                "skill_3" => 36,
                "art_3"   => 38,
                "score_3" => 74,
                "skill_4" => 38,
                "art_4"   => 38,
                "score_4" => 76,
                "skill_5" => 35,
                "art_5"   => 35,
                "score_5" => 70,
                "punish"  => 0,
                "rank"    => 1,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '黃淇宣')
            ->update([
                "skill_1" => 27,
                "art_1"   => 34,
                "score_1" => 61,
                "skill_2" => 24,
                "art_2"   => 27,
                "score_2" => 51,
                "skill_3" => 26,
                "art_3"   => 34,
                "score_3" => 60,
                "skill_4" => 26,
                "art_4"   => 32,
                "score_4" => 58,
                "skill_5" => 22,
                "art_5"   => 32,
                "score_5" => 54,
                "punish"  => 7,
                "rank"    => 5,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '洪奕齋')
            ->update([
                "skill_1" => 19,
                "art_1"   => 28,
                "score_1" => 47,
                "skill_2" => 21,
                "art_2"   => 30,
                "score_2" => 51,
                "skill_3" => 19,
                "art_3"   => 31,
                "score_3" => 50,
                "skill_4" => 17,
                "art_4"   => 26,
                "score_4" => 43,
                "skill_5" => 14,
                "art_5"   => 25,
                "score_5" => 39,
                "punish"  => 11,
                "rank"    => 9,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '蔡孟澔')
            ->update([
                "skill_1" => 22,
                "art_1"   => 30,
                "score_1" => 52,
                "skill_2" => 19,
                "art_2"   => 28,
                "score_2" => 47,
                "skill_3" => 17,
                "art_3"   => 28,
                "score_3" => 45,
                "skill_4" => 21,
                "art_4"   => 27,
                "score_4" => 48,
                "skill_5" => 18,
                "art_5"   => 30,
                "score_5" => 48,
                "punish"  => 8,
                "rank"    => 7,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '鐘晨恩')
            ->update([
                "skill_1" => 34,
                "art_1"   => 40,
                "score_1" => 74,
                "skill_2" => 28,
                "art_2"   => 33,
                "score_2" => 61,
                "skill_3" => 34,
                "art_3"   => 39,
                "score_3" => 73,
                "skill_4" => 34,
                "art_4"   => 40,
                "score_4" => 74,
                "skill_5" => 33,
                "art_5"   => 38,
                "score_5" => 71,
                "punish"  => 5,
                "rank"    => 2,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '滑彥凱')
            ->update([
                "skill_1" => 35,
                "art_1"   => 28,
                "score_1" => 63,
                "skill_2" => 28,
                "art_2"   => 26,
                "score_2" => 54,
                "skill_3" => 32,
                "art_3"   => 36,
                "score_3" => 68,
                "skill_4" => 34,
                "art_4"   => 37,
                "score_4" => 71,
                "skill_5" => 33,
                "art_5"   => 36,
                "score_5" => 69,
                "punish"  => 3,
                "rank"    => 4,
            ]);
        EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))
            ->where('group', $this->group)
            ->where('item', $this->item)
            ->where('name', '倪詣超')
            ->update([
                "skill_1" => 20,
                "art_1"   => 32,
                "score_1" => 52,
                "skill_2" => 22,
                "art_2"   => 32,
                "score_2" => 54,
                "skill_3" => 16,
                "art_3"   => 26,
                "score_3" => 42,
                "skill_4" => 20,
                "art_4"   => 29,
                "score_4" => 49,
                "skill_5" => 10,
                "art_5"   => 24,
                "score_5" => 34,
                "punish"  => 10,
                "rank"    => 8,
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
