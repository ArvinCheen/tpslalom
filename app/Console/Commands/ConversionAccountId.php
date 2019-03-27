<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use Illuminate\Console\Command;

class ConversionAccountId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '將 account_id 轉為真正的 account_id';

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
        $accounts = AccountModel::get();

        try {
            \DB::beginTransaction();
            foreach ($accounts as $account) {
                $this->info($account->account);
//                EnrollModel::where('account_id', $account->account)->update(['account_id' => $account->id]);
//                PlayerModel::where('account_id', $account->account)->update(['account_id' => $account->id]);
//                RegistryFeeModel::where('account_id', $account->account)->update(['account_id' => $account->id]);
            }
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollBack();
            dd($exception->getMessage());
        }
        dd('done');


//select * from enroll
//select * from player
//select * from schedule
    }
}
