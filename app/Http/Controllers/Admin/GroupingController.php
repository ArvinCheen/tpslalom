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
        
        $this->setGrouping("雙人花式繞樁", "公開組", "不分", "", "", 1);
$this->setGrouping("個人花式繞樁", "國小", "女", "", "", 1);
$this->setGrouping("個人花式繞樁", "國小", "男", "", "", 1);
$this->setGrouping("個人花式繞樁", "國中", "女", "", "", 1);
$this->setGrouping("個人花式繞樁", "國中", "男", "", "", 1);
$this->setGrouping("個人花式繞樁", "高中", "女", "", "", 1);
$this->setGrouping("個人花式繞樁", "高中", "男", "", "", 1);
$this->setGrouping("個人花式繞樁", "大專社會", "女", "", "", 1);
$this->setGrouping("個人花式繞樁", "大專社會", "男", "", "", 1);
$this->setGrouping("初級指定套路", "國小低年級", "男", "", "", 2);
$this->setGrouping("初級指定套路", "國小低年級", "女", "", "", 2);
$this->setGrouping("初級指定套路", "國小中年級", "男", "", "", 2);
$this->setGrouping("初級指定套路", "國小中年級", "女", "", "", 2);
$this->setGrouping("初級指定套路", "國小高年級", "男", "", "", 2);
$this->setGrouping("初級指定套路", "國小高年級", "女", "", "", 2);
$this->setGrouping("初級指定套路", "國中", "男", "", "", 2);
$this->setGrouping("初級指定套路", "國中", "女", "", "", 2);
$this->setGrouping("初級指定套路", "大專社會", "男", "", "", 2);
$this->setGrouping("初級指定套路", "大專社會", "女", "", "", 2);
$this->setGrouping("中級指定套路", "國小低年級", "男", "", "", 2);
$this->setGrouping("中級指定套路", "國小低年級", "女", "", "", 2);
$this->setGrouping("中級指定套路", "國小中年級", "男", "", "", 2);
$this->setGrouping("中級指定套路", "國小中年級", "女", "", "", 2);
$this->setGrouping("中級指定套路", "國小高年級", "男", "", "", 2);
$this->setGrouping("中級指定套路", "國小高年級", "女", "", "", 2);
$this->setGrouping("中級指定套路", "國中", "男", "", "", 2);
$this->setGrouping("中級指定套路", "國中", "女", "", "", 2);
$this->setGrouping("中級指定套路", "高中", "女", "", "", 2);
$this->setGrouping("中級指定套路", "大專社會", "男", "", "", 2);
$this->setGrouping("中級指定套路", "大專社會", "女", "", "", 2);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小六年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小六年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國中", "男", "預賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國中", "女", "預賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "高中", "男", "預賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "高中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "大專社會", "男", "預賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "大專社會", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小三年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小三年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小四年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小四年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小五年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小五年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "高中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "大專社會", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小三年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小三年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小四年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小四年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小五年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小五年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小六年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小六年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "高中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "高中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "大專社會", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "大專社會", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小三年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小三年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小四年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小四年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小五年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小五年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小六年級", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小六年級", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "高中", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "高中", "女", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "大專社會", "男", "決賽", "", 3);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "大專社會", "女", "決賽", "", 3);
$this->setGrouping("花式煞停", "國小", "男", "", "", 3);
$this->setGrouping("花式煞停", "國小", "女", "", "", 3);
$this->setGrouping("花式煞停", "國中", "男", "", "", 3);
$this->setGrouping("花式煞停", "高中", "男", "", "", 3);
$this->setGrouping("花式煞停", "國中", "女", "", "", 3);
$this->setGrouping("花式煞停", "大專社會", "男", "", "", 3);
$this->setGrouping("花式煞停", "大專社會", "女", "", "", 3);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前進單足S形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "幼童", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小三年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小三年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小四年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小四年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小五年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小五年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小六年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國小六年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "國中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "高中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜雙足S形", "高中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "幼童", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜雙足S形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "幼童", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小三年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小三年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小四年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小四年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小五年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小五年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小六年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國小六年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "國中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "高中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁甲組-前溜交叉形", "高中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁選手菁英-前溜交叉形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "幼童", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小三年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小三年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小四年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小四年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小五年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小五年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小六年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國小六年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "國中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "高中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "大專社會", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜雙足S形", "大專社會", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "幼童", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "幼童", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小一年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小一年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小二年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小二年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小三年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小三年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小四年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小四年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小五年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小五年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小六年級", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國小六年級", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國中", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "國中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "高中", "女", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "大專社會", "男", "決賽", "", 4);
$this->setGrouping("速度過樁乙組-前溜交叉形", "大專社會", "女", "決賽", "", 4);


        //決賽人數視情境而定，所以先設為零人
        $pkGames = ScheduleModel::where('game_type', '預賽')->get();
        foreach ($pkGames as $val) {
            ScheduleModel::where('game_type', '決賽')->where('gender', $val->gender)->where('group', $val->group)->where('item', $val->item)->where('game_id', config('app.game_id'))->update(['number_of_player' => 0]);
        }

        return back()->with(['info' => '場次編組成功']);
    }

    private function setGrouping($item, $group, $gender, $gameType, $remark, $gameDay)
    {
        // 全國沒有初級、新手，全部都是選手級
        $numberOfPlayer = app(EnrollModel::class)->countGameItemNumberOfPlayer($group, $gender, $item, $gameType);

        $schedule = '場次' . (ScheduleModel::where('game_id', config('app.game_id'))->count() + 1);
        if ($numberOfPlayer) {

            ScheduleModel::create([
                'game_id'          => config('app.game_id'),
                'order'            => $schedule,
                'group'            => $group,
                'gender'           => $gender,
                'item'             => $item,
                'game_type'        => $gameType,
                'remark'           => $remark,
                'number_of_player' => $numberOfPlayer,
                'game_day'         => $gameDay,
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

    public function import()
    {

        $accounts = json_decode('');


        foreach ($accounts as $key => $account) {
            echo '.';
//            $this->info("$key - $account->Email");
            $accountId = AccountModel::updateOrCreate(
                [
                    'phone'      => $account->Phone,
                    'email'      => $account->Email,
                    'account'    => $account->Email,
                    'leader'     => $account->Leader,
                    'coach'      => $account->Coach,
                    'management' => $account->Manager,
                    'team_name'  => $account->Unit,
                ], []);


            foreach ($account->Members as $key => $player) {
//                $this->info("$key - $account->Email");
                PlayerModel::updateOrCreate(
                    ['id' => $player->TempNo,],
                    [
                        'account_id' => $accountId->id,
                        'name'       => $player->MemberName,
                        'agency'     => $account->Unit,
                    ]);
            }
        }

        $players = json_decode('');


        foreach ($players as $key1 => $player) {

            PlayerModel::where('id', $player->TempNo)->update([
                'gender' => $player->Gender == 1 ? '男' : '女',
                'city'   => $player->County,
            ]);

            foreach ($player->Items as $key2 => $item) {
                // 將性別過慮掉，只留下年級（為了統一格式）
                $group = str_replace('男子組', '', $item->Option);
                $group = str_replace('女子組', '', $group);

                // 將性別過慮掉，只留下比賽項目（為了統一格式）
                EnrollModel::updateOrCreate([
                    'game_id'       => config('app.game_id'),
                    'player_id'     => $player->TempNo,
                    'player_number' => $player->TempNo,
                    'account_id'    => PlayerModel::where('id', $player->TempNo)->value('account_id'),
                    'group'         => $group,
                    'item'          => $item->Subject,
                ], []);
            }

        }
    }

}
