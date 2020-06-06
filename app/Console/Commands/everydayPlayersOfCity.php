<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everydayPlayersOfCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everydayPlayersOfCity';

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
//        dd(7+7+9+7+6+2+4+4+1+10+15+7+5+2);
        $schedules1DayGroup = ScheduleModel::where('game_id', 2)->where('game_day', 1)->groupBy('group')->get()->map(function ($v) {
            return $v->group;
        });
        $schedules1DayItem  = ScheduleModel::where('game_id', 2)->where('game_day', 1)->groupBy('group')->get()->map(function ($v) {
            return $v->item;
        });
//dd($schedules1DayItem);
        $day1 = EnrollModel::selectRaw('player.city,count(city) as co')->leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', 2)
            ->whereIn('group', $schedules1DayGroup)
            ->whereIn('item', $schedules1DayItem)
            ->groupBy('player.city')
            ->get()
            ->toArray();

        $x = 0;
        $this->info('第一天');
        foreach ($day1 as $val1) {
            $this->info($val1['city'] . ' ' . $val1['co'] . " 人");
            $x += $val1['co'];
        }
        dd($x);
        $this->info("\n");
    }
}


