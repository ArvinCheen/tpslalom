<?php

namespace App\Services;

use App\Models\ScheduleModel;

class ScheduleService
{
    public function getSchedules()
    {
        return ScheduleModel::where('gameSn', config('app.gameSn'))->get();
    }

    public function getScheduleSn()
    {
        return ScheduleModel::where('gameSn', config('app.gameSn'))->value('scheduleSn');
    }
}
