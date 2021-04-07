<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use DB;
use Illuminate\Console\Command;

class SetAppearanceNull extends Command
{
    protected $signature = 'setAppearanceNull';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        EnrollModel::where('game_id', env('GAME'))->update(['appearance' => null]);

        $this->info('done');
    }
}
