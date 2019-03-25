<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Model\ScheduleModel;
use App\Model\EnrollModel;
use App\Model\RegistryFeeModel;
use DB;
use Excel;

class DocumentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function schedule($gameSn)
    {

        $scheduleQuery = new ScheduleModel();
        $schedule = $scheduleQuery->getAllSchedule($gameSn);

        $second = 0;
        $controllerSecond = 20;
        foreach ($schedule as $val) {
            $second += $val->number_of_player * $controllerSecond;
            $val->endTime = date("H:i", mktime(8, 0, $second));
            $val->startTime = date("H:i", strtotime($val->endTime) - ($val->number_of_player * $controllerSecond) + 60);
        }

        return view('admin/document/schedule')
            ->with('schedule', $schedule)
            ->with('gameSn', $gameSn);
    }

    public function playerRegister($gameSn)
    {
        $scheduleQuery = new ScheduleModel();
        $schedule = $scheduleQuery->getAllSchedule($gameSn);

        foreach ($schedule as $val) {
            $level = $val->level;
            $group = $val->group;
            $gender = $val->gender;
            $item = $val->item;

            $val->players = DB::table('enroll')
                ->leftJoin('player', 'player.sn', 'enroll.playerSn')
                ->where('gameSn', $gameSn)
                ->where('level', $level)
                ->where('group', $group)
                ->where('gender', $gender)
                ->where('item', $item)
                ->get();
        }

        return view('admin/document/playerRegister')
            ->with('schedule', $schedule)
            ->with('gameSn', $gameSn);
    }

    public function teamRegister($gameSn)
    {
        $enrollQuery = new EnrollModel();
        $participateTeam = $enrollQuery->getParticipateTeam($gameSn);

        foreach ($participateTeam as $val) {

            $val->players = DB::table('enroll')
                ->leftJoin('player', 'player.sn', 'enroll.playerSn')
                ->where('gameSn', $gameSn)
                ->where('enroll.accountId', $val->accountId)
                ->groupBy('enroll.playerSn')
                ->get();
        }

        return view('admin/document/teamRegister')
            ->with('participateTeam', $participateTeam)
            ->with('gameSn', $gameSn);
    }

    public function checkBill($gameSn)
    {
        $registryFee = new RegistryFeeModel();
        $checkBill = $registryFee->checkBill($gameSn);

        return view('admin/document/checkBill')
            ->with('checkBill', $checkBill)
            ->with('gameSn', $gameSn);
    }

    public function detailDocument($gameSn)
    {
        $enrollQuery = new EnrollModel();
        $enrollPlayer = $enrollQuery->getDetailDocument($gameSn);

        foreach ($enrollPlayer as $val) {
            if (preg_match("/\前進雙足S型/i", $val->item_all)){
                $val->itemFeet = '前進雙足S型';
            }
            if (preg_match("/\前進單足S型/i", $val->item_all)){
                $val->itemSingle = '前進單足S型';
            }
            if (preg_match("/\前進交叉型/i", $val->item_all)){
                $val->itemCross = '前進交叉型';
            }
        }

        return view('admin/document/detailDocument')
            ->with('enrollPlayer', $enrollPlayer)
            ->with('gameSn', $gameSn);
    }

    public function certificateOfCompletion($gameSn)
    {
        $teamList = DB::table('enroll')
            ->leftJoin('account', 'account.accountId', 'enroll.accountId')
            ->where('gameSn', $gameSn)
            ->groupBy('enroll.accountId')
            ->get();


        return view('admin/document/certificateOfCompletion')
            ->with('gameSn', $gameSn)
            ->with('teamList', $teamList);
    }

    public function exportCertificateOfCompletion($gameSn, $accountId)
    {
        $data = DB::table('enroll')->leftJoin('player', 'player.sn', 'enroll.playerSn')
            ->where('gameSn', $gameSn)
            ->where('enroll.accountId', $accountId)
            ->where('rank', '>', '6')
            ->where('finalResult', '<>', '無成績')
            ->get();

        if ($data->isEmpty()) {
            app('request')->session()->flash('error', '該隊伍無第六名以後的選手資料');
            return back();
        }

        $teamName = DB::table('account')->where('accountId', $accountId)->value('team_name');

        $this->exportExcelForCertificateOfCompletion($teamName, $data);
    }


    private function exportExcelForCertificateOfCompletion($teamName, $data)
    {
        Excel::create($teamName, function($excel) use($data) {
            foreach($data as $val) {
                $excel->sheet($val->rank . '名-' . $val->name . '（' . $val->playerNumber . '）', function($sheet) use($val) {
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->mergeCells('A11:L11');
                    $sheet->mergeCells('A14:L14');
                    $sheet->mergeCells('H15:K15');
                    $sheet->mergeCells('C17:E17');
                    $sheet->mergeCells('F17:K17');
                    $sheet->mergeCells('C19:E19');
                    $sheet->mergeCells('F19:K19');
                    $sheet->mergeCells('C21:E21');
                    $sheet->mergeCells('F21:K21');
                    $sheet->mergeCells('C23:E23');
                    $sheet->mergeCells('F23:K23');
                    $sheet->mergeCells('C25:E25');
                    $sheet->mergeCells('F25:K25');
                    $sheet->mergeCells('C27:E27');
                    $sheet->mergeCells('F27:K27');
                    $sheet->mergeCells('C29:E29');
                    $sheet->mergeCells('F29:J29');
                    $sheet->mergeCells('A49:K49');
                    $sheet->cell('A11', function($cell) use($val) {
                        $cell->setValue('完 賽 證 明');
                        $cell->setFontFamily('標楷體');
                        $cell->setFontSize(60);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A14', function($cell) use($val) {
                        $cell->setValue('  106年臺北市第三十五屆中正盃自由式溜冰錦標賽');
                        $cell->setFontSize(22);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H15', function($cell) use($val) {
                        $cell->setValue('北市體輔字第10630737101號函');
                        $cell->setFontSize(12);
                        $cell->setAlignment('right');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C17', function($cell) use($val) {
                        $cell->setValue('單　　　位：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F17', function($cell) use($val) {
                        if ($val->agency == '無') {
                            $cell->setValue($val->city);
                        } else {
                            $cell->setValue($val->city . " " . $val->agency);
                        }

                        if (mb_strlen($val->agency) >= 10) {
                            $cell->setFontSize(16);
                        } else {
                            $cell->setFontSize(22);
                        }

                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C19', function($cell) use($val) {
                        $cell->setValue('姓　　　名：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F19', function($cell) use($val) {
                        $cell->setValue($val->name);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C21', function($cell) use($val) {
                        $cell->setValue('組　　　別：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F21', function($cell) use($val) {
                        $cell->setValue(str_replace('組', '', $val->level) . ' ' . $val->gender . '子' . $val->group);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C23', function($cell) use($val) {
                        $cell->setValue('項　　　目：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F23', function($cell) use($val) {
                        $cell->setValue($val->item);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C25', function($cell) use($val) {
                        $cell->setValue('成　　　績：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F25', function($cell) use($val) {
                        $explodeSecond = explode(".", $val->finalResult);
                        if ($explodeSecond[0] >= 60) {
                            $result = gmdate("i分s秒", $explodeSecond[0]);
                        } else {
                            $result = gmdate("s秒", $explodeSecond[0]);
                        }

                        if (isset($explodeSecond[1])) {  //如果剛好整秒如8秒00、9秒00，就會掉進來
                            $result .= $explodeSecond[1];
                        }

                        $cell->setValue($result);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C27', function($cell) use($val) {
                        $cell->setValue('名　　　次：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F27', function($cell) use($val) {
                        $cell->setValue('優      勝');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A49', function($cell) use($val) {
                        $ORCYear =  date('Y', time()) - 1911;
                        $month = date('m', time());
                        $day = date('d', time());
                        //todo 這裡要帶比賽當天的日期
                        $cell->setValue('中　華　民　國　106　年　12　月　03　日');
                        $cell->setFontSize(20);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                });
            }
        })->download('xls');
    }

    public function exportCertificate($order, $gameSn, $level, $group, $gender, $item)
    {
        $enrollQuery = new EnrollModel();
        $isOverGame = $enrollQuery->isOverGame($gameSn, $level, $gender, $group, $item);

        if (!$isOverGame) {
            app('request')->session()->flash('error', '賽事未結束');
            return back();
        }

        $queryTaipei = DB::table('enroll')->leftJoin('player', 'player.sn', 'enroll.playerSn')
            ->where('gameSn', $gameSn)
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('city', '臺北市')
            ->whereNotNull('rank')
            ->limit(6)
            ->orderBy('rank')
            ->get();

        $queryOtherCity = DB::table('enroll')->leftJoin('player', 'player.sn', 'enroll.playerSn')
            ->where('gameSn', $gameSn)
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('city', '<>', '臺北市')
            ->whereNotNull('rank')
            ->limit(6)
            ->orderBy('rank')
            ->get();

        $queryTaipei    = json_decode(json_encode($queryTaipei));
        $queryOtherCity = json_decode(json_encode($queryOtherCity));

        $data = array_merge($queryTaipei, $queryOtherCity);

        $this->exportExcel($order, $data);
    }

    private function exportExcel($order, $data)
    {
        Excel::create($order, function($excel) use($data) {
            foreach($data as $val) {
                $excel->sheet($val->rank . '名-' . $val->name . '（' . $val->playerNumber . '）', function($sheet) use($val) {
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->mergeCells('A11:L11');
                    $sheet->mergeCells('A14:L14');
                    $sheet->mergeCells('H15:K15');
                    $sheet->mergeCells('C17:E17');
                    $sheet->mergeCells('F17:K17');
                    $sheet->mergeCells('C19:E19');
                    $sheet->mergeCells('F19:K19');
                    $sheet->mergeCells('C21:E21');
                    $sheet->mergeCells('F21:K21');
                    $sheet->mergeCells('C23:E23');
                    $sheet->mergeCells('F23:K23');
                    $sheet->mergeCells('C25:E25');
                    $sheet->mergeCells('F25:K25');
                    $sheet->mergeCells('C27:E27');
                    $sheet->mergeCells('F27:K27');
                    $sheet->mergeCells('C29:E29');
                    $sheet->mergeCells('F29:J29');
                    $sheet->mergeCells('A49:K49');
                    $sheet->cell('A11', function($cell) use($val) {
                        $cell->setValue('獎　　　狀');
                        $cell->setFontFamily('標楷體');
                        $cell->setFontSize(60);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A14', function($cell) use($val) {
                        $cell->setValue('  106年臺北市第三十五屆中正盃自由式溜冰錦標賽');
                        $cell->setFontSize(22);
                        $cell->setFontWeight('bold');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H15', function($cell) use($val) {
                        $cell->setValue('北市體輔字第10630737101號函');
                        $cell->setFontSize(12);
                        $cell->setAlignment('right');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C17', function($cell) use($val) {
                        $cell->setValue('單　　　位：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F17', function($cell) use($val) {
                        if ($val->agency == '無') {
                            $cell->setValue($val->city);
                        } else {
                            $cell->setValue($val->city . " " . $val->agency);
                        }

                        if (mb_strlen($val->agency) >= 10) {
                            $cell->setFontSize(16);
                        } else {
                            $cell->setFontSize(22);
                        }

                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C19', function($cell) use($val) {
                        $cell->setValue('姓　　　名：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F19', function($cell) use($val) {
                        $cell->setValue($val->name);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C21', function($cell) use($val) {
                        $cell->setValue('組　　　別：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F21', function($cell) use($val) {
                        $cell->setValue(str_replace('組', '', $val->level) . ' ' . $val->gender . '子' . $val->group);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C23', function($cell) use($val) {
                        $cell->setValue('項　　　目：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F23', function($cell) use($val) {
                        $cell->setValue($val->item);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C25', function($cell) use($val) {
                        $cell->setValue('成　　　績：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F25', function($cell) use($val) {
                        $explodeSecond = explode(".", $val->finalResult);
                        if ($explodeSecond[0] >= 60) {
                            $result = gmdate("i分s秒", $explodeSecond[0]);
                        } else {
                            $result = gmdate("s秒", $explodeSecond[0]);
                        }

                        if (isset($explodeSecond[1])) {  //如果剛好整秒如8秒00、9秒00，就會掉進來
                            $result .= $explodeSecond[1];
                        }

                        $cell->setValue($result);
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C27', function($cell) use($val) {
                        $cell->setValue('名　　　次：');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F27', function($cell) use($val) {
                        $cell->setValue('第 ' . $val->rank . ' 名');
                        $cell->setFontSize(24);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A49', function($cell) use($val) {
                        $ORCYear =  date('Y', time()) - 1911;
                        $month = date('m', time());
                        $day = date('d', time());
                        //todo 這裡要帶比賽當天的日期
                        $cell->setValue('中　華　民　國　106　年　12　月　03　日');
                        $cell->setFontSize(20);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                });
            }
        })->download('xls');
    }

    public function checkIn($gameSn)
    {
        $schedule = DB::table('schedule')->where('gameSn', $gameSn)->get();

        Excel::create('檢錄單', function($excel) use($schedule) {
            foreach($schedule as $val) {
                $excel->sheet($val->order, function($sheet) use($val) {

                    $sheet->setAllBorders('thin');
                    $sheet->setFontFamily('微軟正黑體');

                    $sheet->mergeCells('A1:H1');
                    $sheet->mergeCells('A2:H2');
                    $sheet->mergeCells('A3:A4');
                    $sheet->mergeCells('B3:C4');
                    $sheet->mergeCells('D3:D4');
                    $sheet->mergeCells('F3:G3');
                    $sheet->mergeCells('F4:G4');
                    $sheet->mergeCells('A5:H5');
                    $sheet->mergeCells('A6:A7');
                    $sheet->mergeCells('B6:B7');
                    $sheet->mergeCells('C6:C7');
                    $sheet->mergeCells('D6:D7');
                    $sheet->mergeCells('E6:F6');
                    $sheet->mergeCells('G6:H6');
                    $sheet->setWidth([
                        'A' => 9.5,
                        'B' => 9.5,
                        'C' => 9.5,
                        'D' => 40,
                        'E' => 9.5,
                        'F' => 9.5,
                        'G' => 9.5,
                        'H' => 9.5,
                        'I' => 9.5,
                        'J' => 9.5,
                        'K' => 9.5,
                        'L' => 9.5,
                    ]);
                    $sheet->cell('A1', function($cell) {
                        $cell->setValue('106年第三十五屆臺北市中正盃自由式溜冰錦標賽-檢錄暨紀錄單');
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function($cell) use($val) {
                        $cell->setValue($val->order);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B3', function($cell) use($val) {
                        $cell->setFontSize(16);
                        $cell->setValue($val->item);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function($cell) use($val) {
                        $cell->setFontSize(16);
                        $cell->setValue($val->level . ' ' . $val->group . $val->gender . '子組');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E3', function($cell) {
                        $cell->setValue('檢錄人員');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E4', function($cell) {
                        $cell->setValue('記錄人員');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H3', function($cell) {
                        $cell->setValue('time');
                        $cell->setFontSize(9);
                        $cell->setAlignment('right');
                        $cell->setValignment('bottom');
                    });
                    $sheet->cell('H4', function($cell) {
                        $cell->setValue('time');
                        $cell->setFontSize(9);
                        $cell->setAlignment('right');
                        $cell->setValignment('bottom');
                    });
                    $sheet->cell('A6', function($cell) {
                        $cell->setValue('檢錄');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B6', function($cell) {
                        $cell->setValue('編號');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C6', function($cell) {
                        $cell->setValue('姓名');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C6', function($cell) {
                        $cell->setValue('學校單位');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E6', function($cell) {
                        $cell->setValue('第一回合');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G6', function($cell) {
                        $cell->setValue('第二回合');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D6', function($cell) {
                        $cell->setValue('學校單位');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E7', function($cell) {
                        $cell->setValue('成績');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F7', function($cell) {
                        $cell->setValue('誤樁');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G7', function($cell) {
                        $cell->setValue('成績');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H7', function($cell) {
                        $cell->setValue('誤樁');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    $sheet->setHeight('3', 33);
                    $sheet->setHeight('4', 33);
                    $gameSn = $val->gameSn;
                    $level = $val->level;
                    $group = $val->group;
                    $gender = $val->gender;
                    $item = $val->item;

                    $players = DB::table('enroll')->leftJoin('player', 'player.sn', 'enroll.playerSn')
                        ->where('gameSn', $gameSn)
                        ->where('level', $level)
                        ->where('group', $group)
                        ->where('gender', $gender)
                        ->where('item', $item)
                        ->orderBy('playerNumber')
                        ->get();

                    $location = 7;
                    foreach ($players as $key => $player) {
                        $location++;
                        $sheet->setHeight($location, 33);

                        $sheet->cell('B' . $location, function($cell) use($player) {
                            $cell->setValue($player->playerNumber);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function($cell) use($player) {
                            $cell->setValue($player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('D' . $location, function($cell) use($player) {
                            $cell->setValue($player->agency);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                    }
                });
            }
        })->download('xls');
    }
}
