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

    public $group = '國中';
    public $item = '個人花式繞樁(男)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $accounts = AccountModel::get();

        foreach ($accounts as $account) {
            if ($account->account == 'admin') continue;
            $players = PlayerModel::where('account_id', $account->id)->get();

            $name = null;
            foreach ($players as $player) {
                $name .= '(' . $player->id . ')' . $player->name . '、';
            }
            $this->info($account->team_name.' '.$account->coach . ' ' . $account->leader . ' ' . $account->management);
            $this->info($name."\n");
        }


    }
}
