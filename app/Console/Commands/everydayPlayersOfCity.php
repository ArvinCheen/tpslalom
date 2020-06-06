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
//        dd(23+11+3+8+9+1+11+1+2+1+50);
//        dd(23+11+3+8+9+1+11+1+2+1+5+53+68+68+19+35+34+8+27+11+8+1+24+10+3+9+3+12+3+19+34+45+32+30+8+27+5+24+27+11+3+11+9+31+76+75+46+30+41+7+21+9+11+7+12+3+13);
//        dd(23+11+8+5+1+11+1+3+2+3+1+20+9+30+24+3+7+19+15+7+2+5+2+13+17+3+8+9+19+25+17+4+1+17+3+2+6+16+1+14+14+18+11+15+7+2+1+9+3+1+6+4+11+3+1);
        $this->計算(1);
        $this->計算(2);
        $this->計算(3);
        $this->計算(4);
    }

    public function 計算($day)
    {
        $schedulesDayGroup = ScheduleModel::where('game_id', 2)->where('game_day', $day)->groupBy('group')->get()->map(function ($v) {
            return $v->group;
        });

        $schedulesDayItem  = ScheduleModel::where('game_id', 2)->where('game_day', $day)->groupBy('item')->get()->map(function ($v) {
            return $v->item;
        });

//        dd($schedulesDayItem);

        $playerIds = EnrollModel::
//        selectRaw('player.city,count(city) as co')
            leftjoin('player', 'player.id', 'enroll.player_id')
            ->whereIn('group', $schedulesDayGroup)
            ->whereIn('item', $schedulesDayItem)
            ->groupBy('player.id')
//            ->groupBy('player.city')
            ->get()
            ->map(function($val) {
                return $val->player_id;
            });

        $day1 = PlayerModel::selectRaw('city,count(*) as co')->whereIn('id', $playerIds)->groupBy('city')->get()->toArray();
//        dd($day1);
//        ->count();

        $this->info('第 '.$day.' 天');
        foreach ($day1 as $val) {
            $this->info($val['city'] . ' ' . $val['co'] . " 人");
        }
        $this->info("\n");
    }
}





