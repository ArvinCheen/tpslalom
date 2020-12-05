<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class tmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $enrolls = EnrollModel::where('game_id', 9)->whereNull('player_number')->groupBy('player_id')->get();
//
//        foreach ($enrolls as $enroll) {
//            echo '.';
//            $maxNumber = EnrollModel::where('game_id', 9)->max('player_number') + 1;
//            EnrollModel::where('player_id', $enroll->player_id)->where('game_id', 9)->update(['player_number' => $maxNumber]);
//        }
//
//        dd('done');

    }
}
