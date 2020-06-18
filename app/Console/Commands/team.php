<?php

namespace App\Console\Commands;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'team';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '109總統盃版本的隊伍名冊';

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
        $agencys = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->groupBy('agency')->get();

        foreach ($agencys as $agency) {
            $this->info(''.$agency->agency.',');
            $players = EnrollModel::leftjoin('player', 'player.id', 'enroll.player_id')->where('game_id', config('app.game_id'))->where('agency',$agency->agency)->orderBy('player_number')->groupBy('player_number')->get();
            foreach ($players as $player) {
                $this->info($player->name.'('.$player->player_number.'),');
            }
        }
    }
}
