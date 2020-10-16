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
        $x = EnrollModel::get();

        foreach ($x as $v) {
            $gender = PlayerModel::where('id',$v->player_id)->first();
            EnrollModel::where('id',$v->id)->update(['gender'=>$gender->gender]);
            echo '.';
        }

        echo 'done';
    }
}
