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
        dd(5+4+1+4+1+1+5+2+3+5+1+1+8+5+1+2+11+6+6+6+5+8+12+15+15+3+5+2+19+14+8+4+1+2+1+7+5+14+2+14+7+19+10+2+17+6+1+14+23+29+17+2+15+16+2+16+8+19+11+2+17+8+1+14+23+32+17+2+17+22+10+6+4+13+5+5+13+1+9+11+9+13+10+10+9+2+10+6+4+14+6+5+13+2+9+11+9+13+10+10+9+2+14+4+7+8+12+11+7+5+2+5+32+5+13+11+10+14+9+4+1+3+10+26+3+6+9+16+13+8+4+4+10+44+4+13+12+13+18+12+10+1+6+17+22+4+8+8+16+14+7+5+2+8+43+5+13+12+14+18+11+6+1+4+11+12);
        ScheduleModel::where('game_id', config('app.game_id'))->delete();

        $this->setGrouping('國小', '男', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('國小', '女', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('國中', '男', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('國中', '女', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('高中', '男', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('高中', '女', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('大專', '男', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('大專', '女', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('社會', '男', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('社會', '女', '個人花式繞樁', '決賽', '無');
        $this->setGrouping('成年', '', '雙人花式繞樁', '決賽', '無');
        $this->setGrouping('青男', '男', '花式煞停', '決賽', '無');
        $this->setGrouping('青年', '女', '花式煞停', '決賽', '無');
        $this->setGrouping('成年', '男', '花式煞停', '決賽', '無');
        $this->setGrouping('成年', '女', '花式煞停', '決賽', '無');
        $this->setGrouping('國中', '男', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('國中', '女', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('高中', '男', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('高中', '女', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('大專', '男', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('大專', '女', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('社會', '男', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('社會', '女', '速度過樁菁英組-前溜單足S形', '預賽', '超過16人需編列預賽，取前八');
        $this->setGrouping('國小三年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小三年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小四年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小四年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小五年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小五年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小六年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小六年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國中', '男', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('國中', '女', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('高中', '男', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('高中', '女', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('大專', '男', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('大專', '女', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('社會', '男', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('社會', '女', '速度過樁菁英組-前溜單足S形', '決賽', '上述預賽後的名單須自動鍵入');
        $this->setGrouping('國小低年級', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小低年級', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小中年級', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小中年級', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小高年級', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小高年級', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('國中', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('國中', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('高中', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('高中', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('大專', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('大專', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('社會', '男', '中級指定套路', '決賽', '無');
        $this->setGrouping('社會', '女', '中級指定套路', '決賽', '無');
        $this->setGrouping('國小低年級', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('國小低年級', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('國小中年級', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('國小中年級', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('國小高年級', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('國小高年級', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('國中', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('國中', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('高中', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('高中', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('大專', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('大專', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('社會', '男', '初級指定套路', '決賽', '左道');
        $this->setGrouping('社會', '女', '初級指定套路', '決賽', '右道');
        $this->setGrouping('幼童', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('幼童', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小一年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小一年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小二年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小二年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小三年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小三年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小四年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小四年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小五年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小五年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小六年級', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國小六年級', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國中', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('國中', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('高中', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('高中', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('大專', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('大專', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('社會', '男', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('社會', '女', '速度過樁菁英組-前溜雙足S形', '決賽', '無');
        $this->setGrouping('幼童', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('幼童', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小一年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小一年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小二年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小二年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小三年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小三年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小四年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小四年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小五年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小五年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小六年級', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國小六年級', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國中', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('國中', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('高中', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('高中', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('大專', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('大專', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('社會', '男', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('社會', '女', '速度過樁菁英組-前溜交叉形', '決賽', '無');
        $this->setGrouping('幼童', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('幼童', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小一年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小一年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小二年級', '男', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('國小二年級', '女', '速度過樁菁英組-前溜單足S形', '決賽', '無');
        $this->setGrouping('幼童', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('幼童', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小一年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小一年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小二年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小二年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小三年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小三年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小四年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小四年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小五年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小五年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小六年級', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國小六年級', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國中', '男', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('國中', '女', '速度過樁甲組-前溜雙足S形', '決賽', 'A場');
        $this->setGrouping('幼童', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('幼童', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小一年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小一年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小二年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小二年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小三年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小三年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小四年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小四年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小五年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小五年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小六年級', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國小六年級', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國中', '男', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('國中', '女', '速度過樁甲組-前溜交叉形', '決賽', 'A場');
        $this->setGrouping('幼童', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('幼童', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小一年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小一年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小二年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小二年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小三年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小三年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小四年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小四年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小五年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小五年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小六年級', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國小六年級', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國中', '男', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('國中', '女', '速度過樁乙組-前溜雙足S形', '決賽', 'B場');
        $this->setGrouping('幼童', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('幼童', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小一年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小一年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小二年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小二年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小三年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小三年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小四年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小四年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小五年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小五年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小六年級', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國小六年級', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國中', '男', '速度過樁乙組-前溜交叉形', '決賽', 'B場');
        $this->setGrouping('國中', '女', '速度過樁乙組-前溜交叉形', '決賽', 'B場');

        return back()->with(['info' => '場次編組成功']);
    }

    private function setGrouping($group, $gender, $item, $gameType, $remark)
    {
        // 全國沒有初級、新手，全部都是選手級
        $numberOfPlayer = app(EnrollModel::class)->countGameItemNumberOfPlayer($group, $gender, $item, $gameType);

        // 雙場判斷
        if ($remark == 'B場') {
            $schedule = ScheduleModel::where('game_id', config('app.game_id'))->where('remark', 'A場')->first()->order;

            $scheduleb = ScheduleModel::where('game_id', config('app.game_id'))->where('remark', 'B場')->count();

            $schedule  = '場次' . (str_replace('場次','',$schedule) + $scheduleb);
        } else {
            $schedule = '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1);
        }
        if ($numberOfPlayer) {

            ScheduleModel::create([
                'game_id'          => config('app.game_id'),
                'order'            => $schedule,
                'group'            => $group,
                'gender'           => $gender,
                'item'             => $item,
                'gameType'         => $gameType,
                'remark'           => $remark,
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
