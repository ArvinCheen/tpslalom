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

    public function handle()
    {
        $d = EnrollModel::get();
        foreach ($d as $k=>$a) {
//            dd($a);
            echo $k;
            EnrollModel::where('id',$a->id)->update(['gender'=>$a->player->gender]);

        }
    }
}
