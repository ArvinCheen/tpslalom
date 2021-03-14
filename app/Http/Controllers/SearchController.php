<?php

namespace App\Http\Controllers;

use App\Helpers\SlackNotify;
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
        $taipeiCityResult = null;
        $otherCityResult  = null;
        $result           = null;

        $searchService = new SearchService();

        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleId)) {
            if (is_null($scheduleId = app(ScheduleModel::class)->getFirstScheduleId())) {
                return redirect('paymentInfo');
            }
        }

        $scheduleInfo = ScheduleModel::find($scheduleId);

        $model = $this->getModel($scheduleInfo->item);

        if ($model == 'speed') {

            if ($scheduleInfo->level == '選手組') {
                $result = $searchService->getResult($scheduleId);
            } else {
                $taipeiCityResult = $searchService->getTaipeiCityResult($scheduleId);
                $otherCityResult  = $searchService->getOtherCityResult($scheduleId);
            }
        }

        if ($model == 'freeStyle') {
            $result = $searchService->getResult($scheduleId);
        }

        $numberOfPlayer = ScheduleModel::find($scheduleId)->number_of_player;
        $remark         = ScheduleModel::find($scheduleId)->remark;

        if ($numberOfPlayer == 1) {
            $rankLimit = 1;
        } else {
            $rankLimit = floor($numberOfPlayer / 2);

            if ($rankLimit > 6) {
                $rankLimit = 6;
            }
        }


        return view('search/result', compact('scheduleId', 'model', 'schedules', 'scheduleInfo', 'rankLimit', 'remark', 'taipeiCityResult', 'otherCityResult', 'result'));
    }

    private function getModel($item)
    {
        $model = 'speed';

        if ($item == '中級指定套路' || $item == '初級指定套路') {
            $model = 'freeStyle';
        }

        return $model;
    }

    public function integral()
    {
        $integrals = EnrollModel::selectRaw('team_name, enroll.account_id, sum(integral) as integralTotal')
            ->leftJoin('account', 'account.id', 'enroll.account_id')
            ->where('game_id', config('app.game_id'))
            ->whereNotNull('integral')
            ->groupBy('enroll.account_id')
            ->orderByDesc('integralTotal')
            ->get();

        foreach ($integrals as $integral) {
            $integral->players = EnrollModel::leftJoin('player', 'player.id', 'enroll.player_id')
                ->where('game_id', config('app.game_id'))
                ->where('enroll.account_id', $integral->account_id)
                ->where('integral', '>', 0)
                ->orderByDesc('integral')
                ->get();
        }

        if ($integrals->count() == 0) {
            return back()->with('error', '目前無積分資料');
            // todo 無資料不應該回上一項，直接到成績頁面顯示無資料比較好
        }

        return view('search/integral')->with(compact('integrals'));
    }
}
