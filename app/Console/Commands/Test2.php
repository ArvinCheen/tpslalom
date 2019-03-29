<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
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
        $accounts = AccountModel::get();


        DB::beginTransaction();
        foreach ($accounts as $key => $account) {
            $this->info($key);
            DB::table('enroll')->where('accountId', $account->accountId)->update(['accountId' => $account->accountSn]);
            DB::table('player')->where('accountId', $account->accountId)->update(['accountId' => $account->accountSn]);
            DB::table('registryfee')->where('accountId', $account->accountId)->update(['accountId' => $account->accountSn]);
        }
        DB::commit();
        $this->info('dope');
    }
}
