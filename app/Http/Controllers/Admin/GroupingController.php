<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use App\Services\GroupingService;

class GroupingController extends Controller
{
    public function grouping()
    {
        ScheduleModel::where('game_id', config('app.game_id'))->delete();

        if (config('app.game_id') == 11) {
            $this->北市賽程();
        }

        if (config('app.game_id') == 12) {
            $this->新竹賽程();
        }

        if (config('app.game_id') == 13) {
            $this->花蓮賽程();
        }


        return back()->with(['info' => '場次編組成功']);
    }

    private function 北市賽程()
    {
        ScheduleModel::where('game_id', env('GAME'))->delete();

        $this->setGrouping('初級組','國小六年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小六年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小五年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小五年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小四年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小四年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小三年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小三年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小二年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小二年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小一年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','國小一年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','幼童','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('初級組','幼童','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','高中','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','高中','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小三年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小三年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小三年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小三年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','幼童','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小一年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小二年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','男','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','女','前進雙足S形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','男','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','女','前進交叉形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','幼童','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小一年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小二年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小三年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小四年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小五年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國小六年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','國中','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','高中','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','高中','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','大專','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('新人組','社會','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小三年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小四年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小五年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國小六年級','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','國中','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','高中','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','大專','女','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','男','前進單足S形', '', '', '1', 300);
        $this->setGrouping('選手組','社會','女','前進單足S形', '', '', '1', 300);
    }

    private function 新竹賽程()
    {
        $this->setGrouping(null, "國中","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "高中","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "高中","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "社會","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "社會","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","男","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","女","競速組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "高中","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "高中","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "社會","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "社會","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","男","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","女","競速組 450 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "小班","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "小班","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "中班","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "中班","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "小班","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "小班","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "中班","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "中班","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "大班","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "大班","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "大班","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "大班","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","男","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","休閒組 150 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小一年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小二年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小三年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小四年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小五年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國小六年級","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","男","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","休閒組 300 公尺計時賽", '', '', '1', '300');
        $this->setGrouping(null, "幼童","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "幼童","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小低年級","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小低年級","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小中年級","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小中年級","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小高年級","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小高年級","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國中","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "高中","男","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "高中","女","雙足S形", '', '', '1', '300');
        $this->setGrouping(null, "幼童","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "幼童","女","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小低年級","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小低年級","女","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小中年級","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小中年級","女","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小高年級","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國小高年級","女","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國中","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "國中","女","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "高中","男","單足S形", '', '', '1', '300');
        $this->setGrouping(null, "高中","女","單足S形", '', '', '1', '300');
    }

    private function 花蓮賽程()
    {
        $this->setGrouping('初級組', '幼童', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '幼童', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小一年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小一年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小二年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小二年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小三年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小三年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小四年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小四年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小五年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小五年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小六年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('初級組', '國小六年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '幼童', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '幼童', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小一年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小一年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小二年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小二年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小三年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小三年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小四年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小四年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小五年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小五年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小六年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小六年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國中', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '國中', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '高中', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '高中', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '大專', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '大專', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '社會', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '社會', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('選手組', '幼童', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '幼童', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小一年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小一年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小二年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小二年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小三年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小三年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小四年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小四年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小五年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小五年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小六年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國小六年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國中', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '國中', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '高中', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '高中', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '大專', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '大專', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '社會', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('選手組', '社會', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '男', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '女', '前進雙足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '男', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '女', '前進交叉形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '幼童', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小一年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小二年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小三年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小四年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小五年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國小六年級', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '國中', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '高中', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '大專', '女', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '男', '前進單足S形', '', '', '1', '60');
        $this->setGrouping('菁英組', '社會', '女', '前進單足S形', '', '', '1', '60');

    }

    private function setGrouping($level, $group, $gender, $item, $gameType, $remark, $gameDay, $estimate)
    {
        if (env('GAME') == 12) {
            EnrollModel::where('group','國小一年級')->where('item','雙足S形')->update(['group' =>'國小低年級']);
            EnrollModel::where('group','國小二年級')->where('item','雙足S形')->update(['group' =>'國小低年級']);
            EnrollModel::where('group','國小一年級')->where('item','單足S形')->update(['group' =>'國小低年級']);
            EnrollModel::where('group','國小二年級')->where('item','單足S形')->update(['group' =>'國小低年級']);

            EnrollModel::where('group','國小三年級')->where('item','雙足S形')->update(['group' =>'國小中年級']);
            EnrollModel::where('group','國小四年級')->where('item','雙足S形')->update(['group' =>'國小中年級']);
            EnrollModel::where('group','國小三年級')->where('item','單足S形')->update(['group' =>'國小中年級']);
            EnrollModel::where('group','國小四年級')->where('item','單足S形')->update(['group' =>'國小中年級']);

            EnrollModel::where('group','國小五年級')->where('item','雙足S形')->update(['group' =>'國小高年級']);
            EnrollModel::where('group','國小六年級')->where('item','雙足S形')->update(['group' =>'國小高年級']);
            EnrollModel::where('group','國小五年級')->where('item','單足S形')->update(['group' =>'國小高年級']);
            EnrollModel::where('group','國小六年級')->where('item','單足S形')->update(['group' =>'國小高年級']);

            EnrollModel::where('group','小班')->where('item','單足S形')->update(['group' =>'幼童']);
            EnrollModel::where('group','中班')->where('item','單足S形')->update(['group' =>'幼童']);
            EnrollModel::where('group','大班')->where('item','單足S形')->update(['group' =>'幼童']);
            EnrollModel::where('group','小班')->where('item','雙足S形')->update(['group' =>'幼童']);
            EnrollModel::where('group','中班')->where('item','雙足S形')->update(['group' =>'幼童']);
            EnrollModel::where('group','大班')->where('item','雙足S形')->update(['group' =>'幼童']);
        }

        $numberOfPlayer = app(EnrollModel::class)->countGameItemNumberOfPlayer($level, $group, $gender, $item, $gameType);

        if ($numberOfPlayer) {

            $order = '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1);

            if (config('app.game_id') == 9 && $order == '場次15' || config('app.game_id') == 9 && $order == '場次91') {
                $estimateTime = date('Y-m-d') . ' 13:30:00';
            } else {
                $estimateTime = ScheduleModel::where('game_id', config('app.game_id'))->where('game_day', $gameDay)->orderByDesc('id')->value('estimate_time');
            }

            // if (is_null($estimateTime)) {
            //     $estimateTime = date('Y-m-d') . ' 09:00:00';
            // } else {

                // switch ($item) {
                //     case '初級指定套路':
                //     case '中級指定套路':
                //         $每次上場人數 = 1;
                //         break;
                //     default:
                        $每次上場人數 = 2;
                //         break;
                // }

                $estimateTime = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($estimateTime))) + (($estimate * $numberOfPlayer) / $每次上場人數));
            // }

            switch (env('GAME')) {
                case 11:
                    ScheduleModel::create([
                        'game_id'          => config('app.game_id'),
                        'order'            => '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1),
                        'level'            => $level,
                        'group'            => $group,
                        'gender'           => $gender,
                        'item'             => $item,
                        'game_type'        => $gameType,
                        'remark'           => $remark,
                        'number_of_player' => $numberOfPlayer,
                        'game_day'         => $gameDay,
                        'estimate'         => $estimate,
                        'estimate_time'    => $estimateTime,
                    ]);
                    break;
                
                case 12:
                    if ($item == '雙足S形' || $item == '單足S形') {
                        switch ($group) {
                            case '國小一年級':
                            case '國小二年級':
                                $group = '國小低年級';
                                break;
                            
                            case '國小三年級':
                            case '國小四年級':
                                $group = '國小中年級';
                                break;

                            case '國小五年級':
                            case '國小六年級':
                                $group = '國小高年級';
                                break;
                            
                            default:
                                break;
                        }
                    }

                    ScheduleModel::create([
                        'game_id'          => config('app.game_id'),
                        'order'            => '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1),
                        'level'            => $level,
                        'group'            => $group,
                        'gender'           => $gender,
                        'item'             => $item,
                        'game_type'        => $gameType,
                        'remark'           => $remark,
                        'number_of_player' => $numberOfPlayer,
                        'game_day'         => $gameDay,
                        'estimate'         => $estimate,
                        'estimate_time'    => $estimateTime,
                    ]);
                    break;
                
                case 13:
                    break;
                default:
                    dd('error');

            }

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
