<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class DrawLotsController extends Controller
{
    public function drawLots()
    {
//        return back()->with(['success' => '已抽過籤，無法再抽']);  // 抽籤結束後，會顯示「抽籤完畢」的提醒

        $schedules = app(ScheduleModel::class)->getSchedules();  // 取所有場次的資料

        foreach ($schedules as $schedule) {  // 開始處理每個場次的選手出場序
            if ($schedule->item == '雙人花式繞樁') {  // 由於雙人花式繞樁是屬於兩人一組，所以獨立邏輯處理
                $this->setDoubleFreeStyle();  // 執行雙人花式繞樁的處理程序
            } else {
                $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $schedule->id)->first(); // 取得該場次的比賽資料

                $query             = EnrollModel::query();
                $query->where('game_id', config('app.game_id'));

                if (strpos($gameInfo->item, '套路') !== false) {
                    $query->where('group2', $gameInfo->group);
                } else {
                    $query->where('group', $gameInfo->group);
                }

                $enrolls = $query->where('gender', $gameInfo->gender)
                    ->where('item', $gameInfo->item)
                    ->where('level', $gameInfo->level)
                    ->orderBy('appearance')
                    ->orderBy('player_number')
                    ->orderBy('player_id')
                    ->get();

                foreach ($enrolls as $key => $enroll) {  // 將該場次已亂數排序的所有選手逐一加入出場編號
                    $enroll->appearance = $key + 1;  // 從第一位選手開始鍵入出場序編號，直到最後一位選手鍵入完成為止
                    $enroll->save(); // 儲存
                }
            }
        }

        return back()->with(['success' => '抽籤完畢']);  // 抽籤結束後，會顯示「抽籤完畢」的提醒
//        return back()->with(['success' => '已抽過籤，無法再抽']);  // 抽籤結束後，會顯示「抽籤完畢」的提醒
    }

    public function setDoubleFreeStyle()
    {
        $playerNumber = [
            ['317', '655'],
            ['635', '683'],
            ['638', '653'],
        ];

        shuffle($playerNumber);

        foreach ($playerNumber as $key => $val) {
            EnrollModel::select('enroll.id')->where('game_id', config('app.game_id'))->where('item', '雙人花式繞樁')->whereIn('player_number', $val)->update(['appearance' => $key + 1]);
        }
    }

    public function clear()
    {
        EnrollModel::where('game_id', config('app.game_id'))->update(['appearance' => null]);

        return back()->with(['success' => '已清空出場序資料']);
    }
}
