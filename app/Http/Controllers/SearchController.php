<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\ResultService;
use App\Services\SearchService;
use App\Services\ScheduleService;

class SearchController extends Controller
{
//    public function players(Request $request)
//    {
//        $searchService = new SearchService();
//
//        $players = $searchService->getPlayers($request->playerName);
//
//        return view('search/players')->with(compact('players'));
//    }

    public function result($scheduleId = null)
    {
        $resultService   = new ResultService();
        $searchService   = new SearchService();

        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleId)) {
            if (is_null($scheduleId = app(ScheduleModel::class)->getFirstScheduleId())) {
                return back()->with('error', '目前無成績資料');
                // todo 無資料不應該回上一項，直接到成績頁面顯示無資料比較好
            }
        }

        $isGameOver      = $resultService->isGameOver($scheduleId);
        $taipeiResult    = $searchService->getResult($scheduleId, 'taipei');
        $otherCityResult = $searchService->getResult($scheduleId, 'otherCity');

        return view('search/result')->with(compact(
            'scheduleId',
            'schedules',
            'isGameOver',
            'taipeiResult',
            'otherCityResult'
        ));


    }

    public function integral()
    {
        $integrals = EnrollModel::selectRaw('team_name, enroll.account_id, sum(integral) as integral_total')
            ->leftJoin('account', 'account.id', 'enroll.account_id')
            ->where('game_id', config('app.game_id'))
            ->whereNotNull('integral')
            ->groupBy('enroll.account_id')
            ->orderByDesc('integral_total')
            ->get();

        foreach ($integrals as $integral) {
            $accountId = $integral->accountId;

            $integral->playerData = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('enroll.account_id', $accountId)
                ->where('integral', '>', 0)
                ->orderByDesc('integral')
                ->get();
        }

        if ($integrals->count() == 0) {
            return back()->with('error', '目前無積分資料');
            // todo 無資料不應該回上一項，直接到成績頁面顯示無資料比較好
        }

        return view('search/integral')->with(compact('integralData'));
    }
}
