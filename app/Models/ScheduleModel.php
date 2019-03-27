<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    protected $fillable = ['game_id', 'order', 'level', 'group', 'gender', 'item', 'number_of_player',];

    public function getSchedules()
    {
        return $this->where('game_id', config('app.game_id'))->get();
    }

    public function getSchedule($order)
    {
        return $this->where('game_id', config('app.game_id'))->where('order', $order)->first();
    }
}
