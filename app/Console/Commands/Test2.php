<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\GroupModel;
use App\Models\ItemModel;
use App\Models\LevelModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use App\Models\SlalomModel;
use DB;
use Illuminate\Console\Command;

class Test2 extends Command
{
    protected $signature = 'test';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        DB::beginTransaction();



        DB::commit();
        $this->info('done');
    }
}
