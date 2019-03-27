<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Model\ScheduleModel;
use App\Model\EnrollModel;
use App\Model\RegistryFeeModel;
use DB;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function schedule($gameId)
    {
        $scheduleQuery = new ScheduleModel();
        $schedule = $scheduleQuery->getAllSchedule($gameId);

        return view('schedule')
            ->with('schedule', $schedule)
            ->with('active', '賽程表');
    }

    public function playerRegister($gameId = 2)
    {

        $scheduleQuery = new ScheduleModel();
        $schedule = $scheduleQuery->getAllSchedule($gameId);

        foreach ($schedule as $val) {
            $level = $val->level;
            $group = $val->group;
            $gender = $val->gender;
            $item = $val->item;

            $val->players = DB::table('enroll')
                ->leftJoin('player', 'player.sn', 'enroll.playerSn')
                ->where('game_id', $gameId)
                ->where('level', $level)
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }

        return view('playerRegister')
            ->with('schedule', $schedule)
            ->with('active', '分組名冊');
    }

    public function teamRegister($gameId = 2)
    {
        $enrollQuery = new EnrollModel();
        $participateTeam = $enrollQuery->getParticipateTeam($gameId);

        foreach ($participateTeam as $val) {
            $val->players = DB::table('enroll')
                ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                ->where('game_id', $gameId)
                ->where('enroll.accountId', $val->accountId)
                ->groupBy('enroll.playerSn')
                ->get();
        }

        return view('teamRegister')
            ->with('participateTeam', $participateTeam)
            ->with('active', '團隊名冊');
    }

    public function searchIntegral()
    {
        $integralData = DB::select('
            SELECT team_name, enroll.accountId, sum(integral) as integralTotal 
            FROM `enroll` 
            left JOIN account on account.accountId = enroll.accountId
            where `game_id` = 2 and integral > 0 
            group by enroll.accountId
            order by integralTotal desc
        ');

        foreach ($integralData as $val) {
            $accountId = $val->accountId;

            $val->playerData = DB::table('enroll')->leftJoin('player', 'player.sn', 'enroll.playerSn')
                ->where('game_id', 2)
                ->where('enroll.accountId', $accountId)
                ->where('integral', '>', 0)
                ->orderByDesc('integral')
                ->get();
        }

        return view('searchIntegral')
            ->with('integralData', $integralData)
            ->with('active', '積分查詢');
    }
}
