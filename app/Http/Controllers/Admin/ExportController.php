<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleModel;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\AccountModel;
use App\Services\ResultService;
use Excel;

class ExportController extends Controller
{
    public function certificate($scheduleId)
    {
        $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $scheduleId)->first();
        $order    = $gameInfo->order;
        $group    = $gameInfo->group;
        $item     = $gameInfo->item;

        $scheduleiInfo = ScheduleModel::find($scheduleId);

        $rankLimit = $scheduleiInfo->number_of_player;

        if ($rankLimit > 6) {
            $rankLimit = 6;
        }

        if ($scheduleiInfo->item == '雙人花式繞樁') {
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo) {
            })
                ->where('game_id', config('app.game_id'))
                ->where('item', $item)
                ->whereNotNull('rank')
                ->where('rank', '<>', 0)
                ->orderBy('rank')
                ->limit($rankLimit)
                ->get();
        } else {
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo) {
                $query->where('gender', $gameInfo->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('group', $group)
                ->where('item', $item)
                ->whereNotNull('rank')
                ->where('rank', '<>', 0)
                ->orderBy('rank')
                ->limit($rankLimit)
                ->get();
        }


        if ($enrolls->isEmpty()) {
            return back()->with(['error' => '無獎狀資料']);
        }

        if (strpos($scheduleiInfo->item, '速度過樁') !== false) {
            $this->exportExcel($order, $enrolls, 'certificate');
        } else {
            $this->exportExcelFreeStyle($order, $enrolls, 'certificate');
        }
    }

    /**
     * 分組名冊
     */
    public function groups()
    {
        $schedules = ScheduleModel::get();
        Excel::create('分組名冊', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order,
                    function ($sheet) use ($schedule) {
                        $sheet->setFontFamily('微軟正黑體');
                        $enrolls = EnrollModel::wherehas('player', function ($query) use ($schedule) {
                            $query->where('gender', $schedule->gender);
                        })
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->orderBy('appearance')
                            ->orderBy('player_number')
                            ->orderBy('player_id')
                            ->get();

                        foreach ($enrolls as $key => $enroll) {
                            $local = $key + 2;

                            $sheet->cell('A1', function ($cell) use ($enroll) {
                                $cell->setValue('出場序');
                            });
                            $sheet->cell('B1', function ($cell) use ($enroll) {
                                $cell->setValue('選手編號');
                            });
                            $sheet->cell('C1', function ($cell) use ($enroll) {
                                $cell->setValue('選手姓名');
                            });
                            $sheet->cell('D1', function ($cell) use ($enroll) {
                                $cell->setValue('單位');
                            });

                            $sheet->cell('A' . ($local), function ($cell) use ($enroll) {
                                $cell->setValue($enroll->appearance);
                            });
                            $sheet->cell('B' . ($local), function ($cell) use ($enroll) {
                                $cell->setValue($enroll->player_number);
                            });
                            $sheet->cell('C' . ($local), function ($cell) use ($enroll) {
                                $cell->setValue($enroll->player->name);
                            });
                            $sheet->cell('D' . ($local), function ($cell) use ($enroll) {
                                $cell->setValue($enroll->player->agency);
                            });
                        }
                    });
            }
        })->download('xls');
    }

    // 全國沒有完賽證明
//    public function completion($accountId)
//    {
//        $enrolls = EnrollModel::with('player')
//            ->where('game_id', config('app.game_id'))
//            ->where('enroll.account_id', $accountId)
//            ->whereNull('rank')
//            ->where('check', 1)
//            ->where('final_result', '<>', '無成績')
//            ->get();
//
//        if ($enrolls->isEmpty()) {
//            app('request')->session()->flash('error', '該隊伍無第六名以後的選手資料');
//            return back();
//        }
//
//        $teamName = AccountModel::where('id', $accountId)->value('team_name');
//
//        $this->exportExcel($teamName, $enrolls, 'completion');
//    }
    private function exportExcelFreeStyle($fileName, $enrolls)
    {
        $scheduleId = substr($fileName, 6);

        Excel::create($fileName, function ($excel) use ($enrolls, $scheduleId) {
            foreach ($enrolls as $enroll) {
                $excel->sheet($enroll->rank . '名-' . $enroll->player->name . '-' . $enroll->player_number,
                    function ($sheet) use ($enroll, $scheduleId) {
                        $sheet->setFontFamily('微軟正黑體');
                        $sheet->mergeCells('A9:L9');
                        $sheet->mergeCells('A12:L12');
                        $sheet->mergeCells('G13:K13');
                        $sheet->mergeCells('G14:K14');
                        $sheet->mergeCells('C15:E15');
                        $sheet->mergeCells('F15:K15');
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
                        $sheet->mergeCells('F27:J27');
                        $sheet->mergeCells('A43:L43');
                        $sheet->cell('A9', function ($cell) use ($enroll) {
                            $cell->setValue('獎　　　狀');
//                            $cell->setFontFamily('標楷體');
                            $cell->setFontSize(60);

                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A12', function ($cell) use ($enroll) {
                            $cell->setValue('中華民國109年第17屆總統盃全國溜冰錦標賽');
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('G13', function ($cell) use ($enroll) {
                            $cell->setValue('臺教體署競(二)字第1090002504號函');
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('G14', function ($cell) use ($enroll) {
                            $cell->setValue('臺教體署競(二)字第1090006392號函辦理');
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C15', function ($cell) use ($enroll) {
                            $cell->setValue('單　　　位：');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F15', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->agency_all);

                            if (mb_strlen($enroll->player->agency_all) >= 10) {
                                $cell->setFontSize(14);
                            } else {
                                $cell->setFontSize(18);
                            }

                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C17', function ($cell) use ($enroll) {
                            $cell->setValue('姓　　　名：');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F17', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C19', function ($cell) use ($enroll) {
                            $cell->setValue('組　　　別：');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F19', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->group . $enroll->player->gender . '子組');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C21', function ($cell) use ($enroll) {
                            $cell->setValue('項　　　目：');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F21', function ($cell) use ($enroll) {
                            $item = str_replace('(男)', '', $enroll->item);
                            $item = str_replace('(女)', '', $item);
                            $cell->setValue($item);
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C23', function ($cell) use ($enroll) {
                            $cell->setValue('名　　　次：');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F23', function ($cell) use ($enroll) {
                            $cell->setValue('第 ' . $enroll->rank . ' 名');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });

//                        $sheet->cell('C25', function ($cell) use ($enroll, $scheduleId) {
//                            $cell->setValue('成　　　績：');
//                            $cell->setFontSize(20);
//                            $cell->setAlignment('center');
//                            $cell->setValignment('center');
//                        });

//                        $sheet->cell('F25', function ($cell) use ($enroll, $scheduleId) {
//                            $explodeSecond = explode(".", $enroll->final_result);
//                            if ($explodeSecond[0] >= 60) {
//                                $result = gmdate("i分s秒", $explodeSecond[0]);
//                            } else {
//                                $result = gmdate("s秒", $explodeSecond[0]);
//                            }
//
//                            if (isset($explodeSecond[1])) {  //如果剛好整秒如8秒00、9秒00，就會掉進來
//                                $result .= $explodeSecond[1];
//                            }
//
//                            $cell->setValue($result);
//                            $cell->setFontSize(20);
//                            $cell->setAlignment('center');
//                            $cell->setValignment('center');
//                        });
                        $sheet->cell('A43', function ($cell) use ($enroll) {
                            $cell->setValue('中　華　民　國　一　百　零　九　年　六　月　二　十　一　日');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                    });
            }
        })->download('xls');
    }


    private function exportExcel($fileName, $enrolls)
    {

        $scheduleId = substr($fileName, 6);

        Excel::create($fileName, function ($excel) use ($enrolls, $scheduleId) {
            foreach ($enrolls as $enroll) {
                $excel->sheet($enroll->rank . '名-' . $enroll->player->name . '-' . $enroll->player_number,
                    function ($sheet) use ($enroll, $scheduleId) {
                        $sheet->setFontFamily('微軟正黑體');
                        $sheet->mergeCells('A9:L9');
                        $sheet->mergeCells('A12:L12');
                        $sheet->mergeCells('G13:K13');
                        $sheet->mergeCells('G14:K14');
                        $sheet->mergeCells('C15:E15');
                        $sheet->mergeCells('F15:K15');
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
                        $sheet->mergeCells('F27:J27');
                        $sheet->mergeCells('A41:L41');
                        $sheet->cell('A9', function ($cell) use ($enroll) {
                            $cell->setValue('獎　　　狀');
//                            $cell->setFontFamily('標楷體');
                            $cell->setFontSize(60);

                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A12', function ($cell) use ($enroll) {
                            $cell->setValue('中華民國109年第17屆總統盃全國溜冰錦標賽');
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('G13', function ($cell) use ($enroll) {
                            $cell->setValue('臺教體署競(二)字第1090002504號函');
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('G14', function ($cell) use ($enroll) {
                            $cell->setValue('臺教體署競(二)字第1090006392號函辦理');
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C15', function ($cell) use ($enroll) {
                            $cell->setValue('單　　　位：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F15', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->agency_all);

                            if (mb_strlen($enroll->player->agency_all) >= 10) {
                                $cell->setFontSize(14);
                            } else {
                                $cell->setFontSize(18);
                            }

                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C17', function ($cell) use ($enroll) {
                            $cell->setValue('姓　　　名：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F17', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C19', function ($cell) use ($enroll) {
                            $cell->setValue('組　　　別：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F19', function ($cell) use ($enroll) {
                            $cell->setValue($enroll->group . $enroll->player->gender . '子組');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C21', function ($cell) use ($enroll) {
                            $cell->setValue('項　　　目：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F21', function ($cell) use ($enroll) {
                            $item = str_replace('(男)', '', $enroll->item);
                            $item = str_replace('(女)', '', $item);
                            $cell->setValue($item);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C23', function ($cell) use ($enroll) {
                            $cell->setValue('名　　　次：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F23', function ($cell) use ($enroll) {
                            $cell->setValue('第 ' . $enroll->rank . ' 名');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });

//                        $sheet->cell('C25', function ($cell) use ($enroll, $scheduleId) {
//                            $cell->setValue('　');
//                            $cell->setFontSize(24);
//                            $cell->setAlignment('center');
//                            $cell->setValignment('center');
//                        });
//
//                        $sheet->cell('F25', function ($cell) use ($enroll, $scheduleId) {
//                            $cell->setValue('　');
//                            $cell->setFontSize(24);
//                            $cell->setAlignment('center');
//                            $cell->setValignment('center');
//                        });
                        //
                        $sheet->cell('C25', function ($cell) use ($enroll, $scheduleId) {
                            $cell->setValue('成　　　績：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });

                        $sheet->cell('F25', function ($cell) use ($enroll, $scheduleId) {
                            $explodeSecond = explode(".", $enroll->final_result);
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
                        $sheet->cell('A41', function ($cell) use ($enroll) {
                            $cell->setValue('中　華　民　國　一　百　零　九　年　六　月　二　十　一　日');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                    });
            }
        })->download('xls');
    }

//    public function teamCheckIn()
//    {
//        $teams = EnrollModel::select('teamName')
//            ->leftJoin('account', 'account.id', 'enroll.account_id')
//            ->where('game_id', config('app.game_id'))
//            ->groupBy('enroll.account_id')
//            ->get();
//
//        $fileName = '隊伍簽到表';
//        \Excel::create($fileName, function ($excel) use ($teams, $fileName) {
//            $excel->sheet($fileName, function ($sheet) use ($teams) {
//                $sheet->setFontFamily('微軟正黑體');
//                $sheet->mergeCells('A1:B1');
//                $sheet->setWidth([
//                    'A' => 50,
//                    'B' => 50,
//                ]);
//                $sheet->setHeight(1, 80);
//                $sheet->cell('A1', function ($cell) {
//                    $abridgeName = GameModel::where('game_id', config('app.game_id'))->value('abridge_name');
//                    $cell->setValue($abridgeName . ' 隊伍簽到表');
//                    $cell->setFontSize(24);
//                    $cell->setAlignment('center');
//                    $cell->setValignment('center');
//                });
//
//                foreach ($teams as $key => $enroll) {
//
//                    $heightLoca = $key + 2;
//                    $sheet->cell('A' . $heightLoca . ':B' . $heightLoca, function ($cell) {
//                        $cell->setBorder(null, null, 'thin', null);
//                    });
//                    $sheet->setHeight($heightLoca, 25);
//                    $sheet->cell('A' . ($heightLoca), function ($cell) use ($enroll) {
//                        $cell->setValue($enroll->teamName);
//                        $cell->setFontSize(14);
//                        $cell->setAlignment('center');
//                        $cell->setValignment('center');
//                    });
//                }
//            });
//        })->download('xls');
//    }

    public function records()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))->get();

        Excel::create('紀錄手寫單', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order, function ($sheet) use ($schedule) {

                    $sheet->setAllBorders('thin');
                    $sheet->setFontFamily('微軟正黑體');

                    $sheet->mergeCells('A1:G1');
                    $sheet->mergeCells('A2:G2');
                    $sheet->mergeCells('A3:C3');
                    $sheet->mergeCells('D3:E3');
                    $sheet->mergeCells('F3:G3');
                    $sheet->mergeCells('A4:G4');
                    $sheet->mergeCells('A5:A6');
                    $sheet->mergeCells('B5:B6');
                    $sheet->mergeCells('C5:C6');
                    $sheet->mergeCells('D5:E5');
                    $sheet->mergeCells('F5:G5');
                    $sheet->setWidth([
                        'A' => 9.5,
                        'B' => 9.5,
                        'C' => 30,
                        'D' => 9.5,
                        'E' => 9.5,
                        'F' => 9.5,
                        'G' => 9.5,
                        'H' => 9.5,
                        'I' => 9.5,
                        'J' => 9.5,
                        'K' => 9.5,
                        'L' => 9.5,
                    ]);
                    $sheet->cell('A1', function ($cell) use ($schedule) {
                        $abridgeName = GameModel::where('id', config('app.game_id'))->value('abridge_name');
                        $cell->setValue($abridgeName . ' - 紀錄單 - ' . $schedule->order);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B1', function ($cell) use ($schedule) {
                        $cell->setFontSize(16);
                        $cell->setValue($schedule->item);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) use ($schedule) {
                        $cell->setFontSize(12);
                        $cell->setValue($schedule->item . ' ' . $schedule->group . $schedule->gender . '子組');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function ($cell) {
                        $cell->setValue('紀錄人員');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A5', function ($cell) {
                        $cell->setValue('編號');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B5', function ($cell) {
                        $cell->setValue('姓名');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C5', function ($cell) {
                        $cell->setValue('學校單位');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D5', function ($cell) {
                        $cell->setValue('第一回合');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F5', function ($cell) {
                        $cell->setValue('第二回合');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C6', function ($cell) {
                        $cell->setValue('學校單位');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D6', function ($cell) {
                        $cell->setValue('成績');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E6', function ($cell) {
                        $cell->setValue('誤樁');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F6', function ($cell) {
                        $cell->setValue('成績');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G6', function ($cell) {
                        $cell->setValue('誤樁');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    $sheet->setHeight('3', 33);
                    $sheet->setHeight('5', 33);
                    $gameId = $schedule->game_id;
                    $level  = $schedule->level;
                    $group  = $schedule->group;
                    $gender = $schedule->gender;
                    $item   = $schedule->item;


                    $enrolls = EnrollModel::whereHas('player', function ($query) use ($gender) {
                        $query->where('gender', $gender);
                    })
                        ->where('game_id', $gameId)
                        ->where('group', $group)
                        ->where('item', $item)
                        ->orderBy('appearance')
                        ->get();

                    $location = 6;
                    foreach ($enrolls as $key => $enroll) {
                        $location++;
                        $sheet->setHeight($location, 45);

                        $sheet->cell('A' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player_number);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('B' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->agency);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                    }
                });
            }
        })->download('xls');
    }

    public function result()
    {
        $gameInfo = GameModel::where('id', config('app.game_id'))->first();
        $gameCompleteName = $gameInfo->complete_name;
        $abridgeName = $gameInfo->abridge_name;

        Excel::create($abridgeName . '賽後成績', function ($excel) use ($gameCompleteName) {
            $excel->sheet('賽後成績', function ($sheet) use ($gameCompleteName) {

                $sheet->setAllBorders('thin');
                $sheet->setFontFamily('微軟正黑體');
                $sheet->setFontSize(10);
                $sheet->setWidth(array(
                    'A' => 8,
                    'B' => 7,
                    'C' => 7,
                    'D' => 7,
                    'E' => 12,
                    'F' => 30,
                    'G' => 12,
                    'H' => 8,
                ));

                $sheet->mergeCells('A1:H1');

                $sheet->cell('A', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('B', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('C', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('D', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('E', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('F', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('G', function ($cell) {$cell->setAlignment('center');});
                $sheet->cell('H', function ($cell) {$cell->setAlignment('center');});

                $sheet->cell('A1', function ($cell) use ($gameCompleteName) {
                    $cell->setAlignment('center');
                    $cell->setValue($gameCompleteName);
                });

                $schedules = ScheduleModel::where('game_id', config('app.game_id'))->get();

                $initIndex = 2;
                foreach ($schedules as $schedule) {


                        $results = EnrollModel::select('player_number', 'name', 'agency', 'final_result', 'rank')
                            ->leftJoin('player', 'player.id', 'enroll.player_id')
                            ->where('game_id', config('app.game_id'))
                            ->where('group', $schedule->group)
                            ->where('level', $schedule->level)
                            ->where('item', $schedule->item)
                            ->whereNotNull('rank')
                            ->limit(8)
                            ->orderBy('rank')
                            ->get();

//                        $sheet->mergeCells('A' . $initIndex . ':I' . $initIndex);
//                        $sheet->cell('A' . $initIndex, function ($cell) {
//                            $cell->setAlignment('center');
//                            $cell->setValue('臺北市');
//                        });
//                        $initIndex++;

                        $sheet->row($initIndex, ['場次', '名次', '編號', '姓名', '年級組別', '項目', '單位', '成績']);
                        $initIndex++;

                        if ($results->isEmpty()) {
                            $sheet->row($initIndex, [$schedule->order]);
                            $sheet->mergeCells('B' . $initIndex . ':I' . $initIndex);
                            $sheet->cell('B' . $initIndex, function ($cell) {
                                $cell->setValue('無資料');
                            });
                            $initIndex++;
                        } else {
                            foreach ($results as $result) {
                                $item = str_replace('(女)',' 女子組',$schedule->item);
                                $item = str_replace('(男)',' 男子組',$item);
                                $sheet->row($initIndex, [$schedule->order, $result->rank, $result->player_number, $result->name, $schedule->group, $item, $result->agency, $result->final_result]);
                                $initIndex++;
                            }
                        }
                    }
            });
        })->download('xls');
    }
}
