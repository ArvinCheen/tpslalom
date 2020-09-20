<?php

namespace App\Console\Commands;

use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class CalculationScheduleTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CalculationScheduleTime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $initTime = '08:00';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schedules = ScheduleModel::orderBy('id')->get();

        $day = 1;
        $this->info('第 1 天');
        foreach ($schedules as $schedule) {
            if ($schedule->game_day <> $day) {
                $day++;
                $this->initTime = '08:00';
                $this->info("\n第 $day 天");
            }
            $this->printTime($schedule,$schedule->item, $schedule->estimate, $schedule->number_of_player);
        }
    }

    public function printTime($schedule,$item, $estimate, $比賽人數)
    {

        switch ($item) {
            case '中級指定套路':
                $每次上場人數 = 1;
                break;
            default:
                $每次上場人數 = 2;
                break;

        }
//        if ($item == '雙人花式繞樁') {
//            $schedule = ScheduleModel::where('game_id', config('app.game_id'))
//                ->where('game_type', $gameType)
//                ->where('item', 'like', "%$item%")
//                ->where('group', $group)
//                ->first();
//        } else {
//
//            $schedule = ScheduleModel::where('game_id', config('app.game_id'))
//                ->where('game_type', $gameType)
//                ->where('item', 'like', "%$item%")
//                ->where('group', $group)
//                ->where('gender', $gender)
//                ->first();
//        }

//        if (! is_null($schedule)) {
        if ($比賽人數 == 0) {
            $比賽人數 = 8;
            $estimate = 120;
        }

        $this->initTime = date("Y/m/d H:i:s", strtotime(date("Y/m/d H:i:s", strtotime($this->initTime))) + (($estimate * $比賽人數) / $每次上場人數));


        $this->info("$schedule->order $schedule->item $schedule->group" .
            ' | 比賽人數：' . $比賽人數 .
            ' | 每人預估秒數：' . $estimate .
            ' | 每次上場人數：' . $每次上場人數 .
            ' | 結束時間：' . $this->initTime);
//        }
    }
}
