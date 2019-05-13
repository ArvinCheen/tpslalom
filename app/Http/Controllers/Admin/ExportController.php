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
        $level    = $gameInfo->level;
        $group    = $gameInfo->group;
        $item     = $gameInfo->item;

        $enrolls = EnrollModel::wherehas('player', function ($query) use ($gameInfo) {
            $query->where('gender', $gameInfo->gender);
            $query->orderBy('city');
        })
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('group', $group)
            ->where('item', $item)
            ->where('rank', '<=', 6)
            ->orderBy('rank')
            ->get();

        if ($enrolls->isEmpty()) {
            return back()->with(['error' => '無獎狀資料']);
        }

        $this->exportExcel($order, $enrolls, 'certificate');
    }

    public function completion($accountId)
    {
        $enrolls = EnrollModel::with('player')
            ->where('game_id', config('app.game_id'))
            ->where('enroll.account_id', $accountId)
            ->whereNull('rank')
            ->where('check', 1)
            ->where('final_result', '<>', '無成績')
            ->get();

        if ($enrolls->isEmpty()) {
            app('request')->session()->flash('error', '該隊伍無第六名以後的選手資料');
            return back();
        }

        $teamName = AccountModel::where('id', $accountId)->value('team_name');

        $this->exportExcel($teamName, $enrolls, 'completion');
    }

    private function exportExcel($fileName, $enrolls, $type)
    {
        Excel::create($fileName, function ($excel) use ($enrolls, $type) {
            foreach ($enrolls as $enroll) {
                $excel->sheet($enroll->rank . '名-' . $enroll->player->name . '-' . $enroll->player_number,
                    function ($sheet) use ($enroll, $type) {
                        $sheet->setFontFamily('微軟正黑體');
                        $sheet->mergeCells('A9:L9');
                        $sheet->mergeCells('A12:L12');
                        $sheet->mergeCells('H13:K13');
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
                        $sheet->mergeCells('A48:K48');
                        $sheet->cell('A9', function ($cell) use ($enroll, $type) {
                            if ($type == 'certificate') {
                                $cell->setValue('獎　　　狀');
                            }
                            if ($type == 'completion') {
                                $cell->setValue('完 賽 證 明');
                            }
                            $cell->setFontFamily('標楷體');
                            $cell->setFontSize(60);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A12', function ($cell) use ($enroll) {
                            $cell->setValue(GameModel::where('id', config('app.game_id'))->value('complete_name'));
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('H13', function ($cell) use ($enroll) {
                            $cell->setValue(GameModel::where('id', config('app.game_id'))->value('letter') . '　');
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
                            $cell->setValue($enroll->player->city . " " . $enroll->player->agency);

                            if (mb_strlen($enroll->player->agency) >= 10) {
                                $cell->setFontSize(16);
                            } else {
                                $cell->setFontSize(22);
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
                            $cell->setValue(str_replace('組', '', $enroll->level) . ' ' . $enroll->player->gender . '子' . $enroll->group);
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
                            $cell->setValue($enroll->item);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C23', function ($cell) use ($enroll) {
                            $cell->setValue('成　　　績：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F23', function ($cell) use ($enroll) {
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
                        $sheet->cell('C25', function ($cell) use ($enroll) {
                            $cell->setValue('名　　　次：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F25', function ($cell) use ($enroll, $type) {
                            if ($type == 'certificate') {
                                $cell->setValue('第 ' . $enroll->rank . ' 名');
                            }
                            if ($type == 'completion') {
                                $cell->setValue('優      勝');
                            }
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A48', function ($cell) use ($enroll) {
                            $date     = GameModel::where('id', config('app.game_id'))->value('date');
                            $setValue = date('Y', strtotime($date)) - 1911 . '　年　' . date('m　月　d　日', strtotime($date));
                            $cell->setValue('中　華　民　國　' . $setValue);
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
                        $cell->setFontSize(16);
                        $cell->setValue($schedule->item . '　' . $schedule->level . ' ' . $schedule->group . $schedule->gender . '子組');
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
                        ->where('level', $level)
                        ->where('group', $group)
                        ->where('item', $item)
                        ->orderBy('player_number')
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
}
