<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class ResultService
{

    /**
     * @return String
     */
    public function isGameOver($scheduleSn)
    {
        $enrollModel = new EnrollModel();
        $gameInfo    = ScheduleModel::where('game_id', config('app.game_id'))->where('scheduleSn', $scheduleSn)->first();

        $level  = $gameInfo->level;
        $gender = $gameInfo->gender;
        $group  = $gameInfo->group;
        $item   = $gameInfo->item;

        return $enrollModel->isGameOver($level, $gender, $group, $item);
    }

}
