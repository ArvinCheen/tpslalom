<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class estimateGameTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'estimateGameTime';

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


//        '決賽','個人花式繞樁','國小','男','300'
    }

    public function printTime($gameType, $item, $group, $gender,$estimate)
    {

        $schedule = ScheduleModel::where('game_id', config('app.game_id'))
            ->where('game_type', $gameType)
            ->where('item', 'like', $item)
            ->where('group', $group)
            ->where('gender', $gender)
            ->first();

        if (! isNull($schedule)) {
            $numberOfPlayer = $schedule->number_of_player;

//            另外處理的項目
            // 單人花
            // 中級套

        }
    }

}





