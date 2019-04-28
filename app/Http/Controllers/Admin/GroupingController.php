<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\GroupingService;

class GroupingController extends Controller
{
    public function grouping()
    {
        ScheduleModel::where('game_id', config('app.game_id'))->delete();

        $this->setGrouping('初級組', '國小六年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小六年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '國小五年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小五年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '國小四年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小四年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '國小三年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小三年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '國小二年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小二年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '國小一年級', '男', '前進雙足S型');
        $this->setGrouping('初級組', '國小一年級', '女', '前進雙足S型');
        $this->setGrouping('初級組', '幼童', '男', '前進雙足S型');
        $this->setGrouping('初級組', '幼童', '女', '前進雙足S型');
        $this->setGrouping('新人組', '社會', '男', '前進雙足S型');
        $this->setGrouping('新人組', '社會', '女', '前進雙足S型');
        $this->setGrouping('新人組', '大專', '男', '前進雙足S型');
        $this->setGrouping('新人組', '大專', '女', '前進雙足S型');
        $this->setGrouping('新人組', '高中', '男', '前進雙足S型');
        $this->setGrouping('新人組', '高中', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國中', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國中', '女', '前進雙足S型');
        $this->setGrouping('新人組', '幼童', '男', '前進雙足S型');
        $this->setGrouping('新人組', '幼童', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小一年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小一年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小二年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小二年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小三年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小三年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小四年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小四年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小五年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小五年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '國小六年級', '男', '前進雙足S型');
        $this->setGrouping('新人組', '國小六年級', '女', '前進雙足S型');
        $this->setGrouping('新人組', '幼童', '男', '前進交叉型');
        $this->setGrouping('新人組', '幼童', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小一年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小一年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小二年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小二年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小三年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小三年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小四年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小四年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小五年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小五年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國小六年級', '男', '前進交叉型');
        $this->setGrouping('新人組', '國小六年級', '女', '前進交叉型');
        $this->setGrouping('新人組', '國中', '男', '前進交叉型');
        $this->setGrouping('新人組', '國中', '女', '前進交叉型');
        $this->setGrouping('新人組', '高中', '男', '前進交叉型');
        $this->setGrouping('新人組', '高中', '女', '前進交叉型');
        $this->setGrouping('新人組', '大專', '男', '前進交叉型');
        $this->setGrouping('新人組', '大專', '女', '前進交叉型');
        $this->setGrouping('新人組', '社會', '男', '前進交叉型');
        $this->setGrouping('新人組', '社會', '女', '前進交叉型');
        $this->setGrouping('新人組', '幼童', '男', '前進單足S型');
        $this->setGrouping('新人組', '幼童', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小一年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小一年級', '女', '前進單足S型');
        $this->setGrouping('新人組', '國小二年級', '男', '前進單足S型');
        $this->setGrouping('新人組', '國小二年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '幼童', '男', '前進雙足S型');
        $this->setGrouping('選手組', '幼童', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小一年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小一年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小二年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小二年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小三年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小三年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小四年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小四年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小五年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小五年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國小六年級', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國小六年級', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國中', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國中', '女', '前進雙足S型');
        $this->setGrouping('選手組', '高中', '男', '前進雙足S型');
        $this->setGrouping('選手組', '高中', '女', '前進雙足S型');
        $this->setGrouping('選手組', '大專', '男', '前進雙足S型');
        $this->setGrouping('選手組', '大專', '女', '前進雙足S型');
        $this->setGrouping('選手組', '社會', '男', '前進雙足S型');
        $this->setGrouping('選手組', '社會', '女', '前進雙足S型');
        $this->setGrouping('選手組', '幼童', '男', '前進交叉型');
        $this->setGrouping('選手組', '幼童', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小一年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小一年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小二年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小二年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小三年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小三年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小四年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小四年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小五年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小五年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國小六年級', '男', '前進交叉型');
        $this->setGrouping('選手組', '國小六年級', '女', '前進交叉型');
        $this->setGrouping('選手組', '國中', '男', '前進交叉型');
        $this->setGrouping('選手組', '國中', '女', '前進交叉型');
        $this->setGrouping('選手組', '高中', '男', '前進交叉型');
        $this->setGrouping('選手組', '高中', '女', '前進交叉型');
        $this->setGrouping('選手組', '大專', '男', '前進交叉型');
        $this->setGrouping('選手組', '大專', '女', '前進交叉型');
        $this->setGrouping('選手組', '社會', '男', '前進交叉型');
        $this->setGrouping('選手組', '社會', '女', '前進交叉型');
        $this->setGrouping('選手組', '幼童', '男', '前進單足S型');
        $this->setGrouping('選手組', '幼童', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小一年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小一年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小二年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小二年級', '女', '前進單足S型');
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
        $this->setGrouping('新人組', '高中', '男', '前進單足S型');
        $this->setGrouping('新人組', '高中', '女', '前進單足S型');
        $this->setGrouping('新人組', '大專', '男', '前進單足S型');
        $this->setGrouping('新人組', '大專', '女', '前進單足S型');
        $this->setGrouping('新人組', '社會', '男', '前進單足S型');
        $this->setGrouping('新人組', '社會', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小三年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小三年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小四年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小四年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小五年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小五年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國小六年級', '男', '前進單足S型');
        $this->setGrouping('選手組', '國小六年級', '女', '前進單足S型');
        $this->setGrouping('選手組', '國中', '男', '前進單足S型');
        $this->setGrouping('選手組', '國中', '女', '前進單足S型');
        $this->setGrouping('選手組', '高中', '男', '前進單足S型');
        $this->setGrouping('選手組', '高中', '女', '前進單足S型');
        $this->setGrouping('選手組', '大專', '男', '前進單足S型');
        $this->setGrouping('選手組', '大專', '女', '前進單足S型');
        $this->setGrouping('選手組', '社會', '男', '前進單足S型');
        $this->setGrouping('選手組', '社會', '女', '前進單足S型');

        return back()->with(['info' => '場次編組成功']);
    }

    private function setGrouping($level, $group, $gender, $item)
    {
        $numberOfPlayer = app(EnrollModel::class)->countGameItemNumberOfPlayer($level, $group, $gender, $item);

        $schedule = '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1);
        if ($numberOfPlayer) {
            ScheduleModel::create([
                'game_id'          => config('app.game_id'),
                'order'            => $schedule,
                'level'            => $level,
                'group'            => $group,
                'gender'           => $gender,
                'item'             => $item,
                'number_of_player' => $numberOfPlayer,
            ]);
        }
    }

    /**
     * 重新產生選手編號（使用後號碼會被洗牌，危險危險）
     */
    public function createPlayerNumber()
    {
        $playerIds = RegistryFeeModel::select('player_id')->where('game_id', config('app.game_id'))->get();

        foreach ($playerIds as $key => $playerId) {
            EnrollModel::where('game_id', config('app.game_id'))->where('playerSn', $playerId->id)->update(['player_number' => $key + 1]);
        }
    }
}
