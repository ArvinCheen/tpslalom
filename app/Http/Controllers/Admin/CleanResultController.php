<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\ResultService;
use App\Services\CheckInService;
use Illuminate\Support\Facades\DB;

class CleanResultController extends Controller
{
    public function cleanResult()
    {
        EnrollModel::where('game_id', config('app.game_id'))
            ->update(['round_one_miss_conr' => null,
                      'round_one_second'    => null,
                      'round_two_miss_conr' => null,
                      'round_two_second'    => null,
                      'rank'                => null,
                      'integral'            => null,
                      'check'               => null,
                      'final_result'        => null,
                      'check_in_time'       => null
            ]);

        return back()->with(['info' => '清除成功！']);
    }
}
