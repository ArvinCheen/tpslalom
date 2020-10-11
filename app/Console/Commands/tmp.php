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
        $enroll = EnrollModel::get();

        foreach ($enroll as $v) {
            try {

                EnrollModel::where('id',$v->id)->update(['gender'=> $v->player->gender]);
                echo ".";
            } catch (\Exception $e) {
//                dd($v->player);
            }
        }
        $this->info('done');
    }
}
