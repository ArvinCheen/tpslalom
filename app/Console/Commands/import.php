<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class import extends Command
{
    protected $signature = 'import';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
//        dd('已抽完籤，無法匯入');
//            $this->importPlayer();
           $this->importSchedule();
    }

    private function importPlayer()
    {
        $datas = json_decode('');
        foreach ($datas as $key => $data) {
            echo '.';
//            AccountModel::updateOrCreate(['id' => $data->account_id], [
//                'coach'   => $data->coach,
//                'account' => $data->account,
//            ]);
dd($data);
            foreach ($data->players as $player) {


                foreach ($player->item as $item) {
                    $group = str_replace('男子組', '', $item->group);
                    $group = str_replace('女子組', '', $group);

                    $item = str_replace('(男)', '', $item->item);
                    $item = str_replace('(女)', '', $item);
                }
            }
        }

        $this->info('done');
    }

    private function importSchedule()
    {
        ScheduleModel::where('game_id', env('GAME'))->delete();

        $this->setGrouping('初級組','國小六年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小六年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小五年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小五年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小四年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小四年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小三年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小三年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小二年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小二年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小一年級','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','國小一年級','女','前進雙足S型','','','1','');
        $this->setGrouping('初級組','幼童','男','前進雙足S型','','','1','');
        $this->setGrouping('初級組','幼童','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','社會','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','社會','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','大專','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','大專','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','高中','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國中','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國中','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','幼童','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','幼童','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小一年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小一年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小二年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小二年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小三年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小三年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小四年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小四年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小五年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小五年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小六年級','男','前進雙足S型','','','1','');
        $this->setGrouping('新人組','國小六年級','女','前進雙足S型','','','1','');
        $this->setGrouping('新人組','幼童','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','幼童','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小一年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小一年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小二年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小二年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小三年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小三年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小四年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小四年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小五年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小五年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小六年級','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','國小六年級','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','國中','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','大專','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','大專','女','前進交叉型','','','1','');
        $this->setGrouping('新人組','社會','男','前進交叉型','','','1','');
        $this->setGrouping('新人組','幼童','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','幼童','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小一年級','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小二年級','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小二年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','幼童','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','幼童','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小一年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小一年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小二年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小二年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小三年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小三年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小四年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小四年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小五年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小五年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小六年級','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國小六年級','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國中','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','國中','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','大專','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','大專','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','社會','男','前進雙足S型','','','1','');
        $this->setGrouping('選手組','社會','女','前進雙足S型','','','1','');
        $this->setGrouping('選手組','幼童','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小一年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小一年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小二年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小二年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小三年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小三年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小四年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小四年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小五年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小五年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小六年級','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國小六年級','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','國中','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','國中','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','大專','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','大專','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','社會','男','前進交叉型','','','1','');
        $this->setGrouping('選手組','社會','女','前進交叉型','','','1','');
        $this->setGrouping('選手組','幼童','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','幼童','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小一年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小一年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小二年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小二年級','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小三年級','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小四年級','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小四年級','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小五年級','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小五年級','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小六年級','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','國小六年級','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','國中','女','前進單足S型','','','1','');
        $this->setGrouping('新人組','大專','男','前進單足S型','','','1','');
        $this->setGrouping('新人組','大專','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小三年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小三年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小四年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小四年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小五年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小五年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小六年級','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國小六年級','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','國中','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','國中','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','大專','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','大專','女','前進單足S型','','','1','');
        $this->setGrouping('選手組','社會','男','前進單足S型','','','1','');
        $this->setGrouping('選手組','社會','女','前進單足S型','','','1','');

        $this->info('done');
    }

    private function setGrouping($level,$group, $gender, $item, $gameType, $remark, $gameDay, $estimate)
    {
        $numberOfPlayer = app(EnrollModel::class)->countGameItemNumberOfPlayer($level, $group, $gender, $item);
dd($numberOfPlayer);
        if ($numberOfPlayer) {
            ScheduleModel::create([
                'game_id'          => env('GAME'),
                'order'            => '場次' . (ScheduleModel::where('game_id', env('GAME'))->count() + 1),
                'level'            => $level,
                'group'            => $group,
                'gender'           => $gender,
                'item'             => $item,
                'game_type'        => $gameType,
                'remark'           => $remark,
                'number_of_player' => $numberOfPlayer,
                'game_day'         => $gameDay,
                'estimate'         => $estimate,
            ]);
        }
    }
}
