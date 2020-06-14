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
        $searchService = new SearchService();

        $schedules = app(ScheduleModel::class)->getSchedules();

        if (is_null($scheduleId)) {
            if (is_null($scheduleId = app(ScheduleModel::class)->getFirstScheduleId())) {
                return back()->with('error', '目前未開放查詢');
            }
        }

        $scheduleInfo = ScheduleModel::find($scheduleId);
        $result = $searchService->getResult($scheduleId);

        $numberOfPlayer = ScheduleModel::find($scheduleId)->number_of_player;
        $remark = ScheduleModel::find($scheduleId)->remark;

        if ($numberOfPlayer == 1) {
            $rankLimit = 1;
        } else {
            $rankLimit = floor($numberOfPlayer / 2);

            if ($rankLimit > 6) {
                $rankLimit = 6;
            }
        }

        $model = 'speed';

        if ($scheduleInfo->item == '中級指定套路(女)' ||
            $scheduleInfo->item == '中級指定套路(男)' ||
            $scheduleInfo->item == '個人花式繞樁(女)' ||
            $scheduleInfo->item == '個人花式繞樁(男)' ||
            $scheduleInfo->item == '初級指定套路(女)' ||
            $scheduleInfo->item == '初級指定套路(男)' ||
            $scheduleInfo->item == '花式煞停(女)' ||
            $scheduleInfo->item == '花式煞停(男)' ||
            $scheduleInfo->item == '雙人花式繞樁') {
            $model = 'freeStyle';
        }
        if ($scheduleInfo->order == '場次32' || $scheduleInfo->order == '場次33' || $scheduleInfo->order == '場次34') {
            $model = 'pk';
        }


        app(SlackNotify::class)->setMsg('有人正在觀看 `' . $scheduleInfo->order . '` 的成績公告 - ' . now())->notify();
        return view('search/result')->with(compact(
            'scheduleId',
            'model',
            'schedules',
            'scheduleInfo',
            'result',
            'rankLimit',
            'remark'
        ));
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
