<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\GameInfoService;

class GameInfoController extends Controller
{
    public function schedule()
    {
        $gameInfoService = new GameInfoService();
        $schedules = $gameInfoService->getSchedules();

        return view('gameInfo/schedule')->with(compact('schedules'));
    }

    public function groupList()
    {
        $gameInfoService = new GameInfoService();
        $groupLists = $gameInfoService->getGroupList();

        return view('gameInfo/groupList')->with(compact('groupLists'));
    }

    public function teamList()
    {
        $gameInfoService = new GameInfoService();
        $teamLists = $gameInfoService->getTeamList();

        return view('gameInfo/teamList')->with(compact('teamLists'));
    }

    public function refereeTeam()
    {
        return view('gameInfo/refereeTeam');
    }
}