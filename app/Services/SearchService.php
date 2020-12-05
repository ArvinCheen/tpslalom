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
            ->leftJoin('account', 'account.id', 'player.accountId')
            ->where('name', $playerName)
            ->get();

        foreach ($players as $player) {
            $player->results = EnrollModel::select([
                'level', 'group', 'item', 'final_result', 'rank', 'abridgeName'
            ])
                ->leftJoin('game', 'game.game_id', 'enroll.game_id')
                ->where('player_id', $player->id)
                ->whereNotNull('rank')
                ->orderByDesc('enroll.game_id')
                ->get();

            foreach ($player->results as $result) {
                $result->finalResult = ResultsHelper::convertResult($result->finalResult);
            }
        }

        return $players;
    }

    public function getResult($scheduleId)
    {
        $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $scheduleId)->first();

        $data = EnrollModel::where('game_id', config('app.game_id'))
            ->where('game_id', config('app.game_id'))
            ->where('group', $gameInfo->group)
            ->where('item', $gameInfo->item)
            ->where('gender', $gameInfo->gender)
            ->where('level', $gameInfo->level)
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->get();

        $data無成績 = EnrollModel::where('game_id', config('app.game_id'))
            ->where('game_id', config('app.game_id'))
            ->where('group', $gameInfo->group)
            ->where('item', $gameInfo->item)
            ->where('gender', $gameInfo->gender)
            ->where('level', $gameInfo->level)
            ->whereNull('rank')
            ->where('final_result', '無成績')
            ->get();
//

        $data = $data->merge($data無成績);

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
            if (! is_null($val->finalResult)) {
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
}
