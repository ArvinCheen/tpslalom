<?php

namespace App\Console\Commands;

use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class ScheduleTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ClearResult';

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

    public $initTime = '09:00';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        EnrollModel::where('id','<>',1)->update(['round_one_second'    => null,
                             'round_one_miss_conr' => null,
                             'round_two_second'    => null,
                             'round_two_miss_conr' => null,
                             'type'                => null,
                             'skill_1'             => null,
                             'art_1'               => null,
                             'score_1'             => null,
                             'skill_2'             => null,
                             'art_2'               => null,
                             'score_2'             => null,
                             'skill_3'             => null,
                             'art_3'               => null,
                             'score_3'             => null,
                             'skill_4'             => null,
                             'art_4'               => null,
                             'score_4'             => null,
                             'skill_5'             => null,
                             'art_5'               => null,
                             'score_5'             => null,
                             'punish'              => null,
                             'final_result'        => null,
                             'rank'                => null,
                             'integral'            => null,
        ]);

        $this->info('done');
    }

}
