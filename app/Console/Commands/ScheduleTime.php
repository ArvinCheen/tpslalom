<?php

namespace App\Console\Commands;

use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class ScheduleTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ScheduleTime';

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

    public $initTime = '09:00';

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
            if ($schedule->order == '場次51') continue;
            if ($schedule->game_day <> $day) {
                $day++;
                $this->initTime = '09:00';
                $this->info("\n第 $day 天");
            }
            $this->printTime($schedule->game_type, $schedule->item, $schedule->group, $schedule->gender, $schedule->over_second, $schedule->go_player_number);
        }
        // 一個人跑二次
        // 一場二個人跑
//        $this->info("\n第一天");
//        $this->initTime = '2020/6/18 09:00';
//        $this->printTime('決賽', '個人花式繞樁', '國小', '男', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '國小', '女', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '國中', '男', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '國中', '女', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '高中', '男', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '高中', '女', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '大專', '男', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '大專', '女', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '社會', '男', '300', '1');
//        $this->printTime('決賽', '個人花式繞樁', '社會', '女', '300', '1');
//        $this->printTime('決賽', '雙人花式繞樁', '成年', '男', '300', '2');
//        $this->printTime('決賽', '花式煞停', '青男', '男', '900', '2');
//        $this->printTime('決賽', '花式煞停', '青年', '女', '900', '2');
//        $this->printTime('決賽', '花式煞停', '成年', '男', '900', '2');
//        $this->printTime('決賽', '花式煞停', '成年', '女', '900', '2');


//        $this->printTime($gameType, $item, $group, $gender, $initTime, $estimate, $每次上場人數)
//        $everyPlayerTime = $this->argument('s');
//        $startTime       = '2019-5-12 09:00:00';
//        $currentTime     = date("H:i:s", strtotime($startTime));
//
//        $schedules = ScheduleModel::where('game_id', 5)->orderBy('id')->get();
//
//        foreach ($schedules as $schedule) {
//            $currentTime = date("H:i:s", strtotime($currentTime) + (($everyPlayerTime * $schedule->number_of_player)));
//            $this->info($schedule->order . ' | 比賽人數:' . $schedule->number_of_player . ' | 結束時間' . $currentTime);
//        }
    }

    public function printTime($gameType, $item, $group, $gender, $estimate, $每次上場人數)
    {

        if ($item == '雙人花式繞樁') {

            $schedule = ScheduleModel::where('game_id', config('app.game_id'))
                ->where('game_type', $gameType)
                ->where('item', 'like', "%$item%")
                ->where('group', $group)
                ->first();
        } else {

            $schedule = ScheduleModel::where('game_id', config('app.game_id'))
                ->where('game_type', $gameType)
                ->where('item', 'like', "%$item%")
                ->where('group', $group)
                ->where('gender', $gender)
                ->first();
            //        $this->printTime('預賽', '速度過樁菁英組-前溜單足S形', '高中', '女', '60', '2');
//            dd($schedule);
        }
//        $this->printTime('預賽', '速度過樁菁英組-前溜單足S形', '高中', '女', '60', '2');
        if (! is_null($schedule)) {
            if ($schedule->game_type . $schedule->group . $schedule->item == '決賽國中速度過樁菁英組-前溜單足S形(男)' || $schedule->game_type . $schedule->group . $schedule->item == '決賽國中速度過樁菁英組-前溜單足S形(女)' || $schedule->game_type . $schedule->group . $schedule->item == '決賽高中速度過樁菁英組-前溜單足S形(男)') {
                $比賽人數 = 8;

                $this->initTime = date("Y/m/d H:i:s", strtotime(date("Y/m/d H:i:s", strtotime($this->initTime))) + (($estimate * $比賽人數) / $每次上場人數));
            } else {
                $比賽人數           = $schedule->number_of_player;
                $this->initTime = date("Y/m/d H:i:s", strtotime(date("Y/m/d H:i:s", strtotime($this->initTime))) + (($estimate * $比賽人數) / $每次上場人數));
            }


            $this->info("$schedule->order $schedule->item $schedule->group" .
                ' | 比賽人數：' . $比賽人數 .
                ' | 每場預估秒數：' . $estimate .
                ' | 每次上場人數：' . $每次上場人數 .
                ' | 結束時間：' . $this->initTime);
        }
    }
}
