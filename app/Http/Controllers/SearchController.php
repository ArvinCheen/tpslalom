<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\ResultService;
use App\Services\SearchService;
use App\Services\ScheduleService;

class SearchController extends Controller
{
    public function players(Request $request)
    {
        $searchService = new SearchService();

        $players = $searchService->getPlayers($request->playerName);

        return view('search/players')->with(compact('players'));
    }

    public function result($scheduleSn = null)
    {
        $resultService   = new ResultService();
        $searchService   = new SearchService();
        $scheduleService = new ScheduleService();

        $schedules = $scheduleService->getSchedules();

        if (is_null($scheduleSn)) {
            $scheduleSn = $scheduleService->getScheduleSn();

            if (is_null($scheduleSn)) {
                return back()->with('error', '目前無成績資料');
            }
        }
        $isGameOver      = $resultService->isGameOver($scheduleSn);

        $taipeiResult    = $searchService->getResult($scheduleSn, 'taipei');
        $otherCityResult = $searchService->getResult($scheduleSn, 'otherCity');

        return view('search/result')->with(compact(
            'scheduleSn',
            'schedules',
            'isGameOver',
            'taipeiResult',
            'otherCityResult'
        ));
    }

    public function integral()
    {
        $searchService = new SearchService();
        $integralData  = $searchService->getIntegral();

        if ($integralData->count() == 0) {
            return back()->with('error', '目前無積分資料');
        }

        return view('search/integral')->with(compact('integralData'));
    }
}
