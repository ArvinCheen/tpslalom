<?php

namespace App\Services;

use App\Models\RegistryFeeModel;
use App\Models\ScheduleModel;
use App\Models\EnrollModel;

class GroupingService
{
    public function grouping()
    {
        ScheduleModel::where('gameSn', session('gameSn'))->delete();

        $this->setGrouping('新人組', '幼童', '男', '前進單足S型');
        $this->setGrouping('新人組', '幼童', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小一年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小一年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小二年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小二年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '幼童', '男', '前進單足S型');
        $this->setGrouping('選手組', '幼童', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小一年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小一年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小二年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小二年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小三年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小三年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小三年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小三年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小四年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小四年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小五年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小五年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小六年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小六年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國中', '男', '前進單足S型');
        $this->setGrouping('新人組', '國中', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小四年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小四年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小五年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小五年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小六年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小六年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國中', '男', '前進單足S型');
        $this->setGrouping('選手組', '國中', '女', '前進單足S型');
        $this->setGrouping('新人組', '男女子', '男', '前進單足S型');
        $this->setGrouping('新人組', '男女子', '女', '前進單足S型');
        $this->setGrouping('選手組', '男女子', '男', '前進單足S型');
        $this->setGrouping('選手組', '男女子', '女', '前進單足S型');
    }

    private function setGrouping($level, $group, $gender, $item)
    {
        $enrollQuery    = new EnrollModel();
        $numberOfPlayer = $enrollQuery->countGameItemNumberOfPlayer($level, $group, $gender, $item);

        $schedule = '場次' . (ScheduleModel::where('gameSn', session('gameSn'))->count() + 1);
        if ($numberOfPlayer) {
            $insertData = [
                'gameSn'         => session('gameSn'),
                'order'          => $schedule,
                'level'          => $level,
                'group'          => $group,
                'gender'         => $gender,
                'item'           => $item,
                'numberOfPlayer' => $numberOfPlayer,
            ];
            ScheduleModel::create($insertData);
        }
    }

    public function createPlayerNumber()
    {
        $playerSns = RegistryFeeModel::select('playerSn')->where('gameSn', session('gameSn'))->get();

        foreach ($playerSns as $key => $val) {
            EnrollModel::where('gameSn', session('gameSn'))->where('playerSn', $val->playerSn)->update(['playerNumber' => $key + 1]);
        }
    }
}
