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

        $this->setGrouping('競速組', '國中組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國中組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '高中組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '高中組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小三年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小三年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小四年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小四年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小五年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小五年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小六年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小六年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小一年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小一年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國小二年級組', '男', '300公尺計時賽');
        $this->setGrouping('競速組', '國小二年級組', '女', '300公尺計時賽');
        $this->setGrouping('競速組', '國中組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國中組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '高中組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '高中組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小三年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小三年級組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小四年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小四年級組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小五年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小五年級組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小六年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小六年級組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小一年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小一年級組', '女', '450公尺計時賽');
        $this->setGrouping('競速組', '國小二年級組', '男', '450公尺計時賽');
        $this->setGrouping('競速組', '國小二年級組', '女', '450公尺計時賽');
        $this->setGrouping('休閒組', '大班幼童組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '大班幼童組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '中班幼童組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '中班幼童組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '小班幼童組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '小班幼童組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小一年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小一年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小二年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小二年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小三年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小三年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小四年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小四年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小五年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小五年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小六年級組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國小六年級組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '國中組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '國中組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '高中組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '高中組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '社會組', '男', '150公尺計時賽');
        $this->setGrouping('休閒組', '社會組', '女', '150公尺計時賽');
        $this->setGrouping('休閒組', '大班幼童組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '大班幼童組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '中班幼童組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '中班幼童組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '小班幼童組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '小班幼童組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小一年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小一年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小二年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小二年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小三年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小三年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小四年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小四年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小五年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小五年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小六年級組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國小六年級組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '國中組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '國中組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '高中組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '高中組', '女', '300公尺計時賽');
        $this->setGrouping('休閒組', '社會組', '男', '300公尺計時賽');
        $this->setGrouping('休閒組', '社會組', '女', '300公尺計時賽');
        $this->setGrouping('選手組', '幼童組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '幼童組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '低年級組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '低年級組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '中年級組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '中年級組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '高年級組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '高年級組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '國中組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '國中組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '高中組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '高中組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '社會組', '男', '前進雙足S型');
        $this->setGrouping('選手組', '社會組', '女', '前進雙足S型');
        $this->setGrouping('初級組', '幼童組', '男', '前進雙足S型');
        $this->setGrouping('初級組', '幼童組', '女', '前進雙足S型');
        $this->setGrouping('初級組', '低年級組', '男', '前進雙足S型');
        $this->setGrouping('初級組', '低年級組', '女', '前進雙足S型');
        $this->setGrouping('初級組', '中年級組', '男', '前進雙足S型');
        $this->setGrouping('初級組', '中年級組', '女', '前進雙足S型');
        $this->setGrouping('初級組', '高年級組', '男', '前進雙足S型');
        $this->setGrouping('初級組', '高年級組', '女', '前進雙足S型');
        $this->setGrouping('選手組', '幼童組', '男', '前進單足S型');
        $this->setGrouping('選手組', '幼童組', '女', '前進單足S型');
        $this->setGrouping('選手組', '低年級組', '男', '前進單足S型');
        $this->setGrouping('選手組', '低年級組', '女', '前進單足S型');
        $this->setGrouping('選手組', '中年級組', '男', '前進單足S型');
        $this->setGrouping('選手組', '中年級組', '女', '前進單足S型');
        $this->setGrouping('選手組', '高年級組', '男', '前進單足S型');
        $this->setGrouping('選手組', '高年級組', '女', '前進單足S型');
        $this->setGrouping('選手組', '國中組', '男', '前進單足S型');
        $this->setGrouping('選手組', '國中組', '女', '前進單足S型');
        $this->setGrouping('選手組', '高中組', '男', '前進單足S型');
        $this->setGrouping('選手組', '高中組', '女', '前進單足S型');
        $this->setGrouping('選手組', '社會組', '男', '前進單足S型');
        $this->setGrouping('選手組', '社會組', '女', '前進單足S型');

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
