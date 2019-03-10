<?php
namespace App\Services;

use App\Models\PlayerModel;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use App\Helpers\ResultsHelper;

class SearchService
{
    public function getPlayers($playerName)
    {
        $players = PlayerModel::select([
            'playerSn', 'name', 'teamName'
        ])
            ->leftJoin('account', 'account.accountId', 'player.accountId')
            ->where('name', $playerName)
            ->get();

        foreach ($players as $player) {
            $player->results = EnrollModel::select([
                'level', 'group', 'item', 'finalResult', 'rank', 'abridgeName'
            ])
                ->leftJoin('game', 'game.gameSn', 'enroll.gameSn')
                ->where('playerSn', $player->playerSn)
                ->whereNotNull('rank')
                ->orderByDesc('enroll.gameSn')
                ->get();

            foreach ($player->results as $result) {
                $result->finalResult = ResultsHelper::convertResult($result->finalResult);
            }
        }

        return $players;
    }

    public function getResult($scheduleSn, $city)
    {
        $gameInfo = ScheduleModel::where('gameSn', session('gameSn'))->where('scheduleSn', $scheduleSn)->first();

        $query = EnrollModel::where('gameSn', session('gameSn'))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', session('gameSn'))
            ->where('level', $gameInfo->level)
            ->where('group', $gameInfo->group)
            ->where('item', $gameInfo->item)
            ->where('gender', $gameInfo->gender)
            ->where('finalResult', '<>','無成績')
            ->whereNotNull('finalResult');

        if ($city == 'taipei') {
            $query->where('city', '臺北市');
        } else {
            $query->where('city', '<>','臺北市');
        }

        $data = $query->orderBy(\DB::raw('finalResult * 1'))->get();

        return $this->translationResult($data);
    }

    /**
     * 將最後成績轉換成分秒
     *
     * @param $data
     * @return mixed
     */
    private function translationResult($data)
    {
        foreach ($data as $val) {
            if (!is_null($val->finalResult)) {
                $explodeSecond = explode(".", $val->finalResult);
                if ($explodeSecond[0] <> '無成績') {

                    if ($explodeSecond[0] >= 60) {
                        $result = gmdate("i分s秒", $explodeSecond[0]);
                    } else {
                        $result = gmdate("s秒", $explodeSecond[0]);
                    }

                    if (count($explodeSecond) == 2) {
                        $result .= $explodeSecond[1];
                    }

                    $val->finalResult = $result;
                }
            }
        }

        return $data;
    }

    public function getIntegral()
    {
        $integralData = EnrollModel::selectRaw('teamName, enroll.accountId, sum(integral) as integralTotal')
            ->leftJoin('account', 'account.accountId', 'enroll.accountId')
            ->where('gameSn', session('gameSn'))
            ->whereNotNull('integral')
            ->groupBy('enroll.accountId')
            ->orderByDesc('integralTotal')
            ->get();

        foreach ($integralData as $val) {
            $accountId = $val->accountId;

            $val->playerData = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                ->where('gameSn', session('gameSn'))
                ->where('enroll.accountId', $accountId)
                ->where('integral', '>', 0)
                ->orderByDesc('integral')
                ->get();
        }

        return $integralData;
    }
}
