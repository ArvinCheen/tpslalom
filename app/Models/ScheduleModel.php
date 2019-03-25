<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    public function getSchedules()
    {
        return $this->where('gameSn', config('app.gameSn'))->get();
    }

    public function getSchedule($order)
    {
        return $this->where('gameSn', config('app.gameSn'))->where('order', $order)->first();
    }
}
