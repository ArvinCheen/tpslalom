<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScheduleModel extends Model
{
    protected $table = 'schedule';

    protected $primaryKey = 'scheduleSn';

    protected $fillable = [
        'gameSn',
        'order',
        'level',
        'group',
        'gender',
        'item',
        'numberOfPlayer',
    ];

    public $timestamps = true;

    const CREATED_AT = 'createTime';

    const UPDATED_AT = 'updateTime';

    public function getSchedules()
    {
        return $this->where('gameSn', config('app.gameSn')
        )->get();
    }

    public function getSchedule($order)
    {
        return $this->where('gameSn', config('app.gameSn')
        )->where('order', $order)->first();
    }
}
