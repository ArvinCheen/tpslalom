<?php

namespace App\Services;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class ResultService
{
    public function isGameOver($scheduleId)
    {
        $enrollModel = new EnrollModel();
        $gameInfo    = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $scheduleId)->first();

        $gender = $gameInfo->gender;
        $group  = $gameInfo->group;
        $item   = $gameInfo->item;

        return $enrollModel->isGameOver($level, $gender, $group, $item);
    }

}
