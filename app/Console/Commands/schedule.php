<?php

namespace App\Console\Commands;

use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule {s}';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 一個人跑二次
        // 一場二個人跑

        $everyPlayerTime = $this->argument('s');
        $startTime       = '2019-5-12 08:00:00';
        $currentTime     = date("H:i:s", strtotime($startTime));

        $schedules = ScheduleModel::where('game_id', 5)->orderBy('id')->get();

        foreach ($schedules as $schedule) {
            $currentTime = date("H:i:s", strtotime($currentTime) + (($everyPlayerTime * $schedule->number_of_player)));
            $this->info($schedule->order . ' | 比賽人數:'.$schedule->number_of_player.' | 結束時間' . $currentTime);
        }
    }
}
