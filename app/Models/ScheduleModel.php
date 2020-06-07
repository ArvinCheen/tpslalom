<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * App\Models\ScheduleModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ScheduleModel query()
 * @mixin \Eloquent
 */
class ScheduleModel extends Model
{
    protected $table = 'schedule';

    protected $fillable = ['game_id', 'order', 'level', 'group', 'gender', 'item', 'game_type', 'remark', 'number_of_player','game_day'];

    public function getSchedules()
    {
        return $this->where('game_id', config('app.game_id'))->where('order','場次30')->get();
    }

    public function getSchedule($order)
    {
        return $this->where('game_id', config('app.game_id'))->where('order', $order)->first();
    }

    public function getFirstScheduleId()
    {
        return $this->where('game_id', config('app.game_id'))->value('id');
    }
}
