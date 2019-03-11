<?php

namespace App\Http\Controllers\Admin;

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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function certificate($scheduleSn)
    {
        $resultService = new ResultService();
        $isOverGame  = $resultService->isGameOver($scheduleSn);

        if (!$isOverGame) {
            app('request')->session()->flash('error', '賽事未結束');
            return back();
        }

        $gameInfo = ScheduleModel::where('gameSn', config('app.gameSn'))->where('scheduleSn', $scheduleSn)->first();
        $order    = $gameInfo->order;
        $level    = $gameInfo->level;
        $gender   = $gameInfo->gender;
        $group    = $gameInfo->group;
        $item     = $gameInfo->item;

        $queryTaipei = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('city', '臺北市')
            ->whereNotNull('rank')
            ->limit(6)
            ->orderBy('rank')
            ->get();

        $queryOtherCity = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
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

        $this->exportExcel($order, $data, 'certificate');
    }

    public function completion($accountId)
    {
        $data = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('enroll.accountId', $accountId)
            ->whereNotNull('rank')
            ->where('check', '出賽')
            ->where('finalResult', '<>', '無成績')
            ->get();

        if ($data->isEmpty()) {
            app('request')->session()->flash('error', '該隊伍無第六名以後的選手資料');
            return back();
        }

        $teamName = AccountModel::where('accountId', $accountId)->value('teamName');

        $this->exportExcel($teamName, $data, 'completion');
    }

    private function exportExcel($fileName, $data, $type)
    {
        Excel::create($fileName, function ($excel) use ($data, $type) {
            foreach ($data as $val) {
                $excel->sheet($val->rank . '名-' . $val->name . '-' . $val->playerNumber,
                    function ($sheet) use ($val, $type) {
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
                        $sheet->mergeCells('A44:K44');
                        $sheet->cell('A9', function ($cell) use ($val, $type) {
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
                        $sheet->cell('A12', function ($cell) use ($val) {
                            $completeName = GameModel::where('gameSn', config('app.gameSn'))->value('completeName');
                            $cell->setValue($completeName);
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('H13', function ($cell) use ($val) {
                            $letter = GameModel::where('gameSn', config('app.gameSn'))->value('letter');
                            $cell->setValue($letter);
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C15', function ($cell) use ($val) {
                            $cell->setValue('單　　　位：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F15', function ($cell) use ($val) {
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
                        $sheet->cell('C17', function ($cell) use ($val) {
                            $cell->setValue('姓　　　名：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F17', function ($cell) use ($val) {
                            $cell->setValue($val->name);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C19', function ($cell) use ($val) {
                            $cell->setValue('組　　　別：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F19', function ($cell) use ($val) {
                            $cell->setValue(str_replace('組', '', $val->level) . ' ' . $val->gender . '子' . $val->group);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C21', function ($cell) use ($val) {
                            $cell->setValue('項　　　目：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F21', function ($cell) use ($val) {
                            $cell->setValue($val->item);
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C23', function ($cell) use ($val) {
                            $cell->setValue('成　　　績：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F23', function ($cell) use ($val) {
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
                        $sheet->cell('C25', function ($cell) use ($val) {
                            $cell->setValue('名　　　次：');
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('F25', function ($cell) use ($val, $type) {
                            if ($type == 'certificate') {
                                $cell->setValue('第 ' . $val->rank . ' 名');
                            }
                            if ($type == 'completion') {
                                $cell->setValue('優      勝');
                            }
                            $cell->setFontSize(24);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A44', function ($cell) use ($val) {
                            $date     = GameModel::where('gameSn', config('app.gameSn'))->value('date');
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

    public function teamCheckIn()
    {
        $teams = EnrollModel::select('teamName')
            ->leftJoin('account', 'account.accountId', 'enroll.accountId')
            ->where('gameSn', config('app.gameSn'))
            ->groupBy('enroll.accountId')
            ->get();

        $fileName = '隊伍簽到表';
        \Excel::create($fileName, function ($excel) use ($teams, $fileName) {
            $excel->sheet($fileName, function ($sheet) use ($teams) {
                $sheet->setFontFamily('微軟正黑體');
                $sheet->mergeCells('A1:B1');
                $sheet->setWidth([
                    'A' => 50,
                    'B' => 50,
                ]);
                $sheet->setHeight(1, 80);
                $sheet->cell('A1', function ($cell) {
                    $abridgeName = GameModel::where('gameSn', config('app.gameSn'))->value('abridgeName');
                    $cell->setValue($abridgeName . ' 隊伍簽到表');
                    $cell->setFontSize(24);
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                });

                foreach ($teams as $key => $val) {

                    $heightLoca = $key + 2;
                    $sheet->cell('A' . $heightLoca . ':B' . $heightLoca, function ($cell) {
                        $cell->setBorder(null, null, 'thin', null);
                    });
                    $sheet->setHeight($heightLoca, 25);
                    $sheet->cell('A' . ($heightLoca), function ($cell) use ($val) {
                        $cell->setValue($val->teamName);
                        $cell->setFontSize(14);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                }
            });
        })->download('xls');
    }


    public function records()
    {
        $schedule = ScheduleModel::where('gameSn', config('app.gameSn'))->get();

        Excel::create('紀錄手寫單', function ($excel) use ($schedule) {
            foreach ($schedule as $val) {
                $excel->sheet($val->order, function ($sheet) use ($val) {

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
                    $sheet->cell('A1', function ($cell) use ($val) {
                        $abridgeName = GameModel::where('gameSn', config('app.gameSn'))->value('abridgeName');
                        $cell->setValue($abridgeName . ' - 紀錄單 - ' . $val->order);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B1', function ($cell) use ($val) {
                        $cell->setFontSize(16);
                        $cell->setValue($val->item);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) use ($val) {
                        $cell->setFontSize(16);
                        $cell->setValue($val->item . '　' . $val->level . ' ' . $val->group . $val->gender . '子組');
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
                    $gameSn = $val->gameSn;
                    $level  = $val->level;
                    $group  = $val->group;
                    $gender = $val->gender;
                    $item   = $val->item;

                    $playerList = EnrollModel::leftJoin('player', 'player.playerSn', 'enroll.playerSn')
                        ->where('gameSn', $gameSn)
                        ->where('level', $level)
                        ->where('group', $group)
                        ->where('gender', $gender)
                        ->where('item', $item)
                        ->orderBy('playerNumber')
                        ->get();

                    $location = 6;
                    foreach ($playerList as $key => $player) {
                        $location++;
                        $sheet->setHeight($location, 33);

                        $sheet->cell('A' . $location, function ($cell) use ($player) {
                            $cell->setValue($player->playerNumber);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('B' . $location, function ($cell) use ($player) {
                            $cell->setValue($player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function ($cell) use ($player) {
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
