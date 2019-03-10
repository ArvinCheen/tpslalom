<?php
//
//namespace App\Http\Controllers\Admin;
//
//use App\Http\Controllers\Controller as Controller;
//use Illuminate\Http\Request;
//use App\Models\EnrollModel;
//use App\Models\ScheduleModel;
//use App\Services\ResultService;
//use App\Services\GameService;
//use DB;
//
//class GameController extends Controller
//{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
//
//    public function gameList()
//    {
////        $enrollModel = new EnrollModel();
////        $gameList = $enrollModel->getGameList();
////
////        foreach ($gameList as $val) {
////            $val->numberOfParticipants = DB::table('registryFee')->where('gameSn', $val->gameSn)->count();
////            $val->feeTotal = DB::table('registryFee')->where('gameSn', $val->gameSn)->sum('fee');
////        }
//
//        return view('admin/game/gameList');
//    }
//
//    public function programDocument($gameEvent)
//    {
//        return view('admin/game/programDocument')
//            ->with('gameEvent', $gameEvent);
//    }
//
//    public function enrollPlayerList($gameEvent)
//    {
//        $enrollModel = new EnrollModel();
//
//        $playerListFeet   = $enrollModel->getGamePlayerList($gameEvent, $item = '前進雙足S型');
//        $playerListSingle = $enrollModel->getGamePlayerList($gameEvent, $item = '前進單足S型');
//        $playerListCross  = $enrollModel->getGamePlayerList($gameEvent, $item = '前進交叉型');
//
//        return view('admin/game/enrollPlayerList')
//            ->with('gameEvent', $gameEvent)
//            ->with('playerListFeet', $playerListFeet)
//            ->with('playerListSingle', $playerListSingle)
//            ->with('playerListCross', $playerListCross);
//    }
//
//    public function enterResultMode($gameSn, $order)
//    {
////        $EnrollQuery = new EnrollQuery();
////        $EnrollQuery->updateData();
////
////        dd('over');
//
//        $scheduleQuery = new ScheduleModel();
//        $scheduleList  = $scheduleQuery->getAllSchedule($gameSn);
//        $schedule      = $scheduleQuery->getSchedule($gameSn, $order);
//
//        $enrollData = DB::table('enroll')
//            ->select(
//                'enroll.enrollSn',
//                'finalResult',
//                'rank',
//                'playerNumber',
//                'name',
//                'city',
//                'agency',
//                'roundOneSecond',
//                'round_one_miss_conr',
//                'round_two_second',
//                'round_two_miss_conr',
//                'finalResult',
//                'integral'
//            )
//            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
//            ->where($gameSn, $gameSn)
//            ->where('level', $schedule->level)
//            ->where('group', $schedule->group)
//            ->where('gender', $schedule->gender)
//            ->where('item', $schedule->item)
//            ->orderBy('playerNumber')
//            ->get();
//
//        foreach ($enrollData as $val) {
//            if (!is_null($val->finalResult)) {
//                $explodeSecond = explode(".", $val->finalResult);
//                if ($explodeSecond[0] <> '無成績') {
//
//                    if ($explodeSecond[0] >= 60) {
//                        $result = gmdate("i分s秒", $explodeSecond[0]);
//                    } else {
//                        $result = gmdate("s秒", $explodeSecond[0]);
//                    }
//
//                    if (count($explodeSecond) == 2) {
//                        $result .= $explodeSecond[1];
//                    }
//
//                    $val->finalResult = $result;
//                }
//            }
//        }
//
//        return view('admin/game/enterResultMode')
//            ->with('enrollData', $enrollData)
//            ->with('scheduleList', $scheduleList)
//            ->with('order', $order)
//            ->with($gameSn, $gameSn)
//            ->with('order', $schedule->order)
//            ->with('level', $schedule->level)
//            ->with('group', $schedule->group)
//            ->with('gender', $schedule->gender)
//            ->with('item', $schedule->item);
//    }
//
//    public function getGameItem(Request $request)
//    {
//        $enrollModel = new EnrollModel();
//
//        $gameEvent = $request->gameEvent;
//        $item      = $request->item;
//        $level     = $request->level;
//        $group     = $request->group;
//
//        $playerList = $enrollModel->getGamePlayerList($gameEvent, $item, $level, $group);
//
//        return view('admin/game/enterMode')
//            ->with('playerList', $playerList)
//            ->with('gameEvent', $gameEvent)
//            ->with('item', $item)
//            ->with('level', $level)
//            ->with('group', $group);
//    }
//
//    public function medalQuantity($gameSn)
//    {
//        $enrollModel = new EnrollModel();
//
//        $medalData = $enrollModel->getMedalQuantity($gameSn);
//
//        $goldTotal   = 0;
//        $silverTotal = 0;
//        $copperTotal = 0;
//        foreach ($medalData as $val) {
//            $val->city   = $val->city == '臺北市' ? '臺北市' : '外縣市';
//            $val->gold   = 1;
//            $val->silver = $val->numberOfPlayer >= 2 ? 1 : 0;
//            $val->copper = $val->numberOfPlayer >= 3 ? 1 : 0;
//
//            $goldTotal   += $val->gold;
//            $silverTotal += $val->silver;
//            $copperTotal += $val->copper;
//        }
//
//        return view('admin/game/medalQuantity')
//            ->with('medalData', $medalData)
//            ->with('goldTotal', $goldTotal)
//            ->with('silverTotal', $silverTotal)
//            ->with('copperTotal', $copperTotal);
//    }
//
//    public function arrangementSchedule($gameSn)
//    {
////        這個好像沒用到了
////        $scheduleQuery = new ScheduleModel();
////        $scheduleQuery::where($gameSn, $gameSn)->delete();
////
////        $gameService = new GameService();
////
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '幼童', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '幼童', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小一年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小一年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小二年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小二年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '幼童', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '幼童', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小一年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小一年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小二年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小二年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小三年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小三年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小四年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小四年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小五年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小五年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小六年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國小六年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小三年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小三年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小四年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小四年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小五年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小五年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小六年級', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國小六年級', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國中', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '國中', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國中', $gender = '男', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '國中', $gender = '女', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '新人', $group = '男女子', $gender = '男女子', $item = '前進單足S型');
////        $gameService->arrangementSchedule($gameSn, $level = '選手', $group = '男女子', $gender = '男女子', $item = '前進單足S型');
////
////        app('request')->session()->flash('success', '場次編組成功');
////        return back();
//    }
//}
