<?php

namespace App\Services;

use App\Models\ScheduleModel;

class ScheduleService
{
    public function getSchedules()
    {
        return ScheduleModel::where('game_id', config('app.game_id'))->get();
    }

    public function getScheduleSn()
    {
        return ScheduleModel::where('game_id', config('app.game_id'))->value('scheduleSn');
    }
}
