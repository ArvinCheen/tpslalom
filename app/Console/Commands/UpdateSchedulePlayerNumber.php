<?php

namespace App\Console\Commands;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class UpdateSchedulePlayerNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateSchedulePlayerNumber';

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

    public $initTime = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schedules = ScheduleModel::get();

        foreach ($schedules as $schedule) {
            $item = $schedule->item;
            $gender = $schedule->gender;
            $group = $schedule->group;

            $playerNumber = EnrollModel::leftjoin('player','player.id','enroll.player_id')
                ->where('gender', $gender)
                ->where('item',$item)
                ->where('group',$group)
                ->count();

            ScheduleModel::where('id', $schedule->id)->update(['number_of_player'=>$playerNumber]);

            echo '.';
        }
        $this->info('done');
    }
}
