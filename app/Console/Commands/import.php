<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


//        foreach ($fk as $val) {
////            dd($val);
//            foreach ($val->Teams as $team) {
//                foreach ($team->Members as $member) {
//                    if ($member->UnitShort == '幼兒園') {
//                        $agency = $team->DetailTeamName == '' ? '幼兒園' : $team->DetailTeamName;
//                        PlayerModel::where('id', $member->TempNo)->where('name', $member->MemberName)->update(['agency' => $agency]);
//                    } else {
//                        PlayerModel::where('id', $member->TempNo)->where('name', $member->MemberName)->update(['agency' => $member->UnitShort]);
//                    }
//                }
//            }
//            dd($val->Teams[0]->Members[0]->UnitShort);

//        }
//        dd('處理幼兒園結束');


//        這三個選手的年級是null ，需要另外處理
//        INSERT INTO nksdscom_twslalom.enroll (player_id) VALUES (248);
//INSERT INTO nksdscom_twslalom.enroll (player_id) VALUES (423);
//INSERT INTO nksdscom_twslalom.enroll (player_id) VALUES (425);

        //這兩個選手要另外處理，因為資料來源是null，年級249(國小六年級) 426(國小五年級)
//        EnrollModel::where('game_id',2)->where('player_id',249)->update(['group'=>'國小六年級']);
//        EnrollModel::where('game_id',2)->where('player_id',426)->update(['group'=>'國小五年級']);

        // 因為不出國了，所以公開賽全取消
//        EnrollModel::where('game_id', 2)->where('item','like','%公開%')->delete();
//        EnrollModel::where('game_id', 2)->whereIn('player_id',[861,5,6,28,29,40,41,42,43,44,45,47,48,49,50,51,76,77,81,82,83,84,99,100,102,110,109,121,122,123,124,0,138,145,146,147,148,149,150,151,162,167,168,185,186,187,188,189,191,190,194,223,225,226,227,230,233,232,247,257,269,296,311,317,320,357,359,367,377,378,379,380,381,382,383,384,386,387,388,385,389,390,393,394,404,420,421,422,424,425,435,475,486,517,521,523,536,541,553,556,560,565,592,593,602,653,687,694,693,695,696,698,699,700,701,702,703,704,705,706,707,708,709,710,711,718,724,725,726,729,739,750,751,752,753,755,754,756,760,761,763,764,768,769,770,771,803,805,821,828,830,831,832,841,844,845,846,847,848,849,850,851,852,853,854,855,856,857,858,859,860,862,863,864,865,866,867,868,869,870,])->delete();

//"126小四甲組雙足S。 李亮磊。已申請速樁退費
//158小四甲組前交叉。李亮磊。已申請速樁退費"
        // 經查詢，該選手編號為 236
        EnrollModel::where('game_id',2)->where('player_id',236)->delete();
    }
}
