<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller as Controller;
use App\Models\PlayerModel;
use Illuminate\Http\Request;
use App\Models\ScheduleModel;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\AccountModel;
use App\Services\ResultService;
use Excel;
use Storage;
use Spatie\MediaLibrary\MediaStream;

class ExportController extends Controller
{
    public function certificate($scheduleId)
    {
        $gameInfo = ScheduleModel::where('game_id', config('app.game_id'))->where('id', $scheduleId)->first();
        $order    = $gameInfo->order;
        $group    = $gameInfo->group;
        $item     = $gameInfo->item;
        $level     = $gameInfo->level;

        $scheduleiInfo = ScheduleModel::find($scheduleId);

        $rankLimit = $scheduleiInfo->number_of_player;

        if ($rankLimit > 6) {
            $rankLimit = 6;
        }

        if ($scheduleiInfo->item == '雙人花式繞樁') {
            $enrolls = EnrollModel::where('game_id', config('app.game_id'))
                ->where('item', $item)
                ->where('level', $level)
                ->whereNotNull('rank')
                ->where('rank', '<>', 0)
                ->orderBy('rank')
                ->limit($rankLimit)
                ->get();
        } else {
            $enrolls = EnrollModel::where('gender', $gameInfo->gender)
                ->where('game_id', config('app.game_id'))
                ->where('group', $group)
                ->where('item', $item)
                ->where('level', $level)
                ->whereNotNull('rank')
                ->where('rank', '<>', 0)
                ->orderBy('rank')
                ->limit($rankLimit)
                ->get();
        }

        if ($enrolls->isEmpty()) {
            return back()->with(['error' => '無獎狀資料']);
        }

//        if (strpos($scheduleiInfo->item, '速度過樁') !== false) {
            $this->exportExcel($scheduleId, $order, $enrolls, 'certificate');
//        } else {
//            $this->exportExcelFreeStyle($order, $enrolls, 'certificate');
//        }
    }

    /**
     * 分組名冊
     */
    public function groups()
    {
        ini_set('memory_limit', '256M');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('微軟正黑體'); //設定預設字型
        $section = $phpWord->addSection([
            'marginLeft' => 700, 'marginRight' => 700,
            'marginTop'  => 700, 'marginBottom' => 700
        ]);

        $gameName = GameModel::find(config('app.game_id'))->complete_name;
        $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER])->addText('分組名冊', ['size' => 20]);
        $section->addTextBreak();
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))->orderBy('id')->get();

        foreach ($schedules as $schedule) {
            $fontSize            = 10;
            $fancyTableStyleName = 'Fancy Table';
            $fancyTableStyle     = ['borderSize' => 1, 'borderColor' => 'white', 'cellMargin' => 130];
            $textStyle           = ['size' => $fontSize];
            $textSpaceStyle      = ['size' => $fontSize, 'color' => 'white'];
            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);

            $table->addRow();
            $table->addCell(100 * 20, ['borderTopSize' => 1, 'borderLeftSize' => 1])->addText($schedule->order, $textStyle);
            $table->addCell(100 * 60, ['borderTopSize' => 1])->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER])->addText("$schedule->group $schedule->item", $textStyle);
            $numberOfPlyaer = empty($schedule->number_of_player) ? '?' : $schedule->number_of_player;
            $table->addCell(100 * 20, ['borderTopSize' => 1, 'borderRightSize' => 1])->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END])->addText('共 ' . $numberOfPlyaer . ' 人', $textStyle);


            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);

            if ($schedule->number_of_player == 0) {
                $table->addRow();
                $table->addCell(100 * 33, ['borderLeftSize' => 1])->addText('', ['size' => 1]);
                $table->addCell(100 * 0.5)->addText('.', ['size' => 1]);
                $table->addCell(100 * 33)->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER])->addText('PK賽採動態排位', ['size' => 8]);
                $table->addCell(100 * 0.5)->addText('.', ['size' => 1]);
                $table->addCell(100 * 33, ['borderRightSize' => 1])->addText('', ['size' => 1]);
            } else {
                $enrolls = EnrollModel::query();
                $enrolls->where('game_id', config('app.game_id'));

                if (strpos($schedule->item, '套路') !== false) {
                    $enrolls->where('group2', $schedule->group);
                } else {
                    $enrolls->where('group', $schedule->group);
                }

                $enrolls = $enrolls->where('level', $schedule->level)
                    ->where('gender', $schedule->gender)
                    ->where('item', $schedule->item)
                    ->orderBy('appearance')
                    ->orderBy('player_number')
                    ->orderBy('player_id')
                    ->get();

                for ($i = 0; $i < count($enrolls); $i += 3) {
                    $agencyName = $enrolls[$i]->player->city . $enrolls[$i]->player->agency;

                    $table->addRow();
                    $table->addCell(100 * 33, ['borderLeftSize' => 1])->addText($enrolls[$i]->player_number . ' ' . $enrolls[$i]->player->name . '(' . $agencyName . ')', $textStyle);
                    $table->addCell(100 * 0.5, ['borderLeftSize' => 1])->addText('.', $textSpaceStyle);

                    if (isset($enrolls[$i + 1])) {
                        $agencyName = $enrolls[$i + 1]->player->city . $enrolls[$i + 1]->player->agency;

                        $table->addCell(100 * 33)->addText($enrolls[$i + 1]->player_number . ' ' . $enrolls[$i + 1]->player->name . '(' . $agencyName . ')', $textStyle);
                        $table->addCell(100 * 0.5, ['borderLeftSize' => 1])->addText('.', $textSpaceStyle);
                    } else {
                        $table->addCell(100 * 33)->addText('.', $textSpaceStyle);
                        $table->addCell(100 * 0.5)->addText('.', $textSpaceStyle);
                    }

                    if (isset($enrolls[$i + 2])) {
                        $agencyName = $enrolls[$i + 2]->player->city . $enrolls[$i + 2]->player->agency;

                        $table->addCell(100 * 33, ['borderRightSize' => 1])->addText($enrolls[$i + 2]->player_number . ' ' . $enrolls[$i + 2]->player->name . '(' . $agencyName . ')', $textStyle);
                    } else {
                        $table->addCell(100 * 33, ['borderRightSize' => 1])->addText('.', $textSpaceStyle);
                    }
                }
            }

            $section->addTextBreak();
        }

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $fileName     = $gameName . ' 分組名冊' . time();
        $objectWriter->save(storage_path($fileName . '.docx'));

        return response()->download(storage_path($fileName . '.docx'));
    }

    public function agencies()
    {
        ini_set('memory_limit', '256M');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('微軟正黑體'); //設定預設字型
        $section  = $phpWord->addSection([
            'marginLeft' => 700, 'marginRight' => 700,
            'marginTop'  => 700, 'marginBottom' => 700
        ]);
        $gameName = GameModel::find(config('app.game_id'))->complete_name;
        $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER])->addText(' 隊伍名冊', ['size' => 20]);
        $section->addTextBreak();

        $agencies = PlayerModel::selectRaw('agency,city,count(*) as co')->groupBy('agency')->groupBy('city')->orderByDesc('co')->get();

        foreach ($agencies as $agency) {
            $fontSize            = 10;
            $fancyTableStyleName = 'Fancy Table';
            $fancyTableStyle     = ['borderSize' => 1, 'borderColor' => 'white', 'cellMargin' => 130];
            $textStyle           = ['size' => $fontSize];
            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);

            $coach   = '';
            $leader  = '';
            $manager = '';

            $numberOfPlayer = PlayerModel::where('agency', $agency->agency)->get()->count();

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('coach')->groupBy('coach')->get() as $coachData) {
                if ($coachData->coach <> '') {
                    $coach .= $coachData->coach . '、';
                }
            }

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('leader')->groupBy('leader')->get() as $leaderData) {
                if ($leaderData->leader <> '') {
                    $leader .= $leaderData->leader . '、';
                }
            }

            foreach (PlayerModel::where('agency', $agency->agency)->whereNotNull('manager')->groupBy('manager')->get() as $managerData) {
                if ($managerData->manager <> '') {
                    $manager .= $managerData->manager . '、';
                }
            }

            if ($coach <> '') {
                $coach = mb_substr($coach, 0, -1);
            }

            if ($leader <> '') {
                $leader = mb_substr($leader, 0, -1);
            }

            if ($manager <> '') {
                $manager = mb_substr($manager, 0, -1);
            }

            if (strpos($agency->agency, $agency->city) !== false) {
                $agencyName = $agency->agency;
            } else {
                $agencyName = $agency->city . $agency->agency;
            }

            $table->addRow();
            $table->addCell(100 * 100, ['borderBottomSize' => 1])->addText('單位：' . $agencyName . ' - ' . $numberOfPlayer . '位選手參賽 / 教練：' . $coach . ' / 領隊：' . $leader . ' / 經理：' . $manager, $textStyle);


            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);


            $players = EnrollModel::wherehas('player', function ($query) use ($agency) {
                $query->where('agency', $agency->agency);
            })->where('game_id', config('app.game_id'))->groupBy('player_id')->get();

            for ($i = 0; $i < count($players); $i += 5) {
                $table->addRow();
                $table->addCell(100 * 20)->addText($players[$i]->player_number . ' ' . $players[$i]->player->name, $textStyle);

                if (isset($players[$i + 1])) {
                    $table->addCell(100 * 20)->addText($players[$i + 1]->player_number . ' ' . $players[$i + 1]->player->name, $textStyle);
                }
                if (isset($players[$i + 2])) {
                    $table->addCell(100 * 20)->addText($players[$i + 2]->player_number . ' ' . $players[$i + 2]->player->name, $textStyle);
                }
                if (isset($players[$i + 3])) {
                    $table->addCell(100 * 20)->addText($players[$i + 3]->player_number . ' ' . $players[$i + 3]->player->name, $textStyle);
                }
                if (isset($players[$i + 4])) {
                    $table->addCell(100 * 20)->addText($players[$i + 4]->player_number . ' ' . $players[$i + 4]->player->name, $textStyle);
                }
            }

            $section->addTextBreak();
        }

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $fileName     = $gameName . ' 單位名冊' . time();
        $objectWriter->save(storage_path($fileName . '.docx'));

        return response()->download(storage_path($fileName . '.docx'));
    }


    public function teams()
    {
        ini_set('memory_limit', '256M');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('微軟正黑體'); //設定預設字型
        $section = $phpWord->addSection([
            'marginLeft' => 700, 'marginRight' => 700,
            'marginTop'  => 700, 'marginBottom' => 700
        ]);

        $gameName = GameModel::find(config('app.game_id'))->complete_name;
        $section->addTextRun(['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER])->addText(' 隊伍名冊', ['size' => 20]);
        $section->addTextBreak();

        $agencies = EnrollModel::where('game_id', config('app.game_id'))->groupBy('account_id')->get()->map(function ($query) {
            return (object)[
                'team_name'  => $query->account->team_name,
                'account_id' => $query->account_id,
                'coach'      => is_null($query->account->coach) ? '無' : $query->account->coach,
                'leader'     => is_null($query->account->leader) ? '無' : $query->account->leader,
                'manager'    => is_null($query->account->manager) ? '無' : $query->account->manager,
            ];
        });

        foreach ($agencies as $agency) {
            $fontSize            = 10;
            $fancyTableStyleName = 'Fancy Table';
            $fancyTableStyle     = ['borderSize' => 1, 'borderColor' => 'white', 'cellMargin' => 130];
            $textStyle           = ['size' => $fontSize];
            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);

            $numberOfPlayer = EnrollModel::where('game_id', config('app.game_id'))->where('account_id', $agency->account_id)->groupBy('player_id')->get()->count();

            $table->addRow();
            $table->addCell(100 * 100, ['borderBottomSize' => 1])->addText($agency->team_name . ' - ' . $numberOfPlayer . '位選手參賽 / 教練：' . $agency->coach . ' / 領隊：' . $agency->leader . ' / 經理：' . $agency->manager, $textStyle);


            $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle);
            $table = $section->addTable($fancyTableStyleName);


            $players = EnrollModel::where('game_id', config('app.game_id'))->where('account_id', $agency->account_id)->groupBy('player_id')->get()->map(function ($query) {
                return (object)[
                    'name'          => $query->player->name,
                    'player_number' => $query->player_number,
                ];
            });

            for ($i = 0; $i < count($players); $i += 5) {
                $table->addRow();
                $table->addCell(100 * 20)->addText($players[$i]->player_number . ' ' . $players[$i]->name, $textStyle);

                if (isset($players[$i + 1])) {
                    $table->addCell(100 * 20)->addText($players[$i + 1]->player_number . ' ' . $players[$i + 1]->name, $textStyle);
                }
                if (isset($players[$i + 2])) {
                    $table->addCell(100 * 20)->addText($players[$i + 2]->player_number . ' ' . $players[$i + 2]->name, $textStyle);
                }
                if (isset($players[$i + 3])) {
                    $table->addCell(100 * 20)->addText($players[$i + 3]->player_number . ' ' . $players[$i + 3]->name, $textStyle);
                }
                if (isset($players[$i + 4])) {
                    $table->addCell(100 * 20)->addText($players[$i + 4]->player_number . ' ' . $players[$i + 4]->name, $textStyle);
                }
            }

            $section->addTextBreak();
        }

        $objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $fileName     = $gameName . ' 隊伍名冊' . time();
        $objectWriter->save(storage_path($fileName . '.docx'));

        return response()->download(storage_path($fileName . '.docx'));
    }

    public function playerNumber()
    {
        $data = EnrollModel::selectRaw("player_number as 選手號碼,player.name as 選手姓名,city as 縣市,player.agency as 單位,account.team_name as 隊伍,account.coach as 教練,account.leader as 領隊,account.manager as 管理,enroll.group as 組別,player.gender as 性別,group_concat(item) as 報名項目")
            ->leftjoin('player', 'player.id', 'enroll.player_id')
            ->leftjoin('account', 'account.id', 'enroll.account_id')
            ->where('game_id', config('app.game_id'))
            ->groupBy('player_id')
            ->get();
        Excel::create('選手號碼布列表', function ($excel) use ($data) {//第一參數是檔案名稱
            $excel->sheet('SheetName', function ($sheet) use ($data) {//第一個參數是sheet名稱
                $sheet->fromArray($data);//可以簡單用fromArray這個函式傳資料進去。
            });
        })->export('xls');//輸出格式，也可選擇csv，若是要輸出成pdf則需要另外安裝套件
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
        dd($fileName);
        $scheduleId = substr($fileName, 6);

        Excel::create($fileName, function ($excel) use ($enrolls, $scheduleId) {
            $excel->sheet('明細', function ($sheet) use ($enrolls, $scheduleId) {
                $gameInfo = ScheduleModel::find($scheduleId);
                dd($gameInfo);
                $sheet->setWidth(array(
                    'A' => 24,
                    'B' => 24,
                    'C' => 24,
                ));

                $sheet->mergeCells("A1:H1");
                $sheet->row(1, ["$gameInfo->order $gameInfo->group $gameInfo->gender $gameInfo->item"]);
                $sheet->row(2, ['名次', '姓名', '教練']);
                $initIndex = 3;
                foreach ($enrolls as $enroll) {
                    $sheet->row($initIndex, [$enroll->rank, ' ' . $enroll->player_number . ' ' . $enroll->player->name, $enroll->player->coach]);
                    $initIndex++;
                }
            });

            foreach ($enrolls as $enroll) {
                $excel->sheet($enroll->rank . '名-' . $enroll->player->name . '-' . $enroll->player_number,
                    function ($sheet) use ($enroll, $scheduleId) {
                        $gameInfo = GameModel::find(config('app.game_id'));
                        $sheet->setFontFamily('微軟正黑體');
                        $sheet->mergeCells('A9:L9');
                        $sheet->mergeCells('A12:L12');
                        $sheet->mergeCells('C13:K13');
                        $sheet->mergeCells('C14:K14');
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
                        $sheet->cell('A12', function ($cell) use ($enroll, $gameInfo) {
                            $cell->setValue($gameInfo->complete_name);
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C13', function ($cell) use ($enroll, $gameInfo) {
                            $cell->setValue(explode(' ', $gameInfo->letter)[0]);
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C14', function ($cell) use ($enroll, $gameInfo) {
                            if (isset(explode(' ', $gameInfo->letter)[1])) {
                                $cell->setValue(explode(' ', $gameInfo->letter)[1]);
                            }
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
                            $cell->setValue($enroll->player->agency);

                            if (mb_strlen($enroll->player->agency) >= 10) {
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
                            $cell->setFontSize(18);
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
                            $cell->setValue('中　華　民　國　一　百　零　九　年　十 一　月　二 十 一　日');
                            $cell->setFontSize(20);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                    });
            }
        })->download('xls');
    }


    private function exportExcel($scheduleId, $fileName, $enrolls)
    {
        Excel::create($fileName, function ($excel) use ($enrolls, $scheduleId) {
            $excel->sheet('明細', function ($sheet) use ($enrolls, $scheduleId) {
                $gameInfo = ScheduleModel::find($scheduleId);
                $sheet->setWidth(array(
                    'A' => 24,
                    'B' => 24,
                    'C' => 24,
                ));

                $sheet->mergeCells("A1:H1");
                $sheet->row(1, ["$gameInfo->order $gameInfo->group $gameInfo->gender $gameInfo->item"]);
                $sheet->row(2, ['名次', '姓名', '隊伍 & 教練']);

                $sheet->cell('A1', function ($cell) {
                    $cell->setFontSize(20);
                });
                $sheet->cell('A2', function ($cell) {
                    $cell->setFontSize(20);
                });
                $sheet->cell('B2', function ($cell) {
                    $cell->setFontSize(20);
                });
                $sheet->cell('C2', function ($cell) {
                    $cell->setFontSize(20);
                });

                $initIndex = 3;
                foreach ($enrolls as $enroll) {
                    $sheet->row($initIndex, [$enroll->rank, ' ' . $enroll->player_number . ' ' . $enroll->player->name, $enroll->account->team_name .' '.$enroll->account->coach]);

                    $sheet->cell('A' . $initIndex, function ($cell) {
                        $cell->setFontSize(20);
                    });

                    $sheet->cell('B' . $initIndex, function ($cell) {
                        $cell->setFontSize(20);
                    });

                    $sheet->cell('C' . $initIndex, function ($cell) {
                        $cell->setFontSize(20);
                    });
                    $initIndex++;
                }
            });

            foreach ($enrolls as $enroll) {
                $excel->sheet($enroll->rank . '名-' . $enroll->player->name . '-' . $enroll->player_number,
                    function ($sheet) use ($enroll, $scheduleId) {
                        $gameInfo = GameModel::find(config('app.game_id'));
                        $sheet->setFontFamily('微軟正黑體');
                        $sheet->mergeCells('A9:L9');
                        $sheet->mergeCells('A12:L12');
                        $sheet->mergeCells('C13:K13');
                        $sheet->mergeCells('C14:K14');
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
//                            $cell->setValue('獎　　　狀');
                            $cell->setValue('  ');
                            $cell->setFontSize(60);

                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('A12', function ($cell) use ($enroll, $gameInfo) {
                            $cell->setValue($gameInfo->complete_name);
                            $cell->setFontSize(22);
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C13', function ($cell) use ($enroll, $gameInfo) {
                            $cell->setValue(explode(' ', $gameInfo->letter)[0]);
                            $cell->setFontSize(12);
                            $cell->setAlignment('right');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C14', function ($cell) use ($enroll, $gameInfo) {
                            if (isset(explode(' ', $gameInfo->letter)[1])) {
                                $cell->setValue(explode(' ', $gameInfo->letter)[1]);
                            }
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
                            $agency = $enroll->player->city . ' ' . $enroll->player->agency;
                            $cell->setValue($agency);

                            if (mb_strlen($agency) >= 10) {
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
                            $cell->setFontSize(18);
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
                            $cell->setValue('中　華　民　國　一　百　零　九　年　十 一　月　二 十 一　日');
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
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->get();

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
                        $cell->setValue($schedule->order);
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
                        $cell->setValue($schedule->level . ' ' . $schedule->item . ' ' . $schedule->group . $schedule->gender . '子組');
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
                    $group  = $schedule->group;
                    $gender = $schedule->gender;
                    $item   = $schedule->item;
                    $level   = $schedule->level;


                    if (strpos($schedule->item, '套路') !== false && strpos($schedule->group, '國小') !== false) {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group2', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    } else {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    }

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
        $gameInfo         = GameModel::where('id', config('app.game_id'))->first();
        $gameCompleteName = $gameInfo->complete_name;
        $abridgeName      = $gameInfo->abridge_name;

        Excel::create($abridgeName . '賽後成績', function ($excel) use ($gameCompleteName) {
            $excel->sheet('賽後成績', function ($sheet) use ($gameCompleteName) {

                $sheet->setAllBorders('thin');
                $sheet->setFontFamily('微軟正黑體');
                $sheet->setFontSize(10);
                $sheet->setWidth(array(
                    'A' => 10,
                    'B' => 15,
                    'C' => 35,
                    'D' => 12,
                    'E' => 12,
                ));


                $sheet->cell('A', function ($cell) {
                    $cell->setAlignment('center');
                });
                $sheet->cell('B', function ($cell) {
                    $cell->setAlignment('center');
                });
                $sheet->cell('C', function ($cell) {
                    $cell->setAlignment('center');
                });
                $sheet->cell('D', function ($cell) {
                    $cell->setAlignment('center');
                });
                $sheet->cell('E', function ($cell) {
                    $cell->setAlignment('center');
                });

                $sheet->mergeCells('A1:E1');
                $sheet->cell('A1', function ($cell) use ($gameCompleteName) {
                    $cell->setAlignment('center');
                    $cell->setValue($gameCompleteName);
                });

                $schedules = ScheduleModel::where('game_id', config('app.game_id'))->get();

                $initIndex = 2;
                foreach ($schedules as $schedule) {
                    $results = EnrollModel::wherehas('player', function ($query) use ($schedule) {
                        if ($schedule->item <> '雙人花式繞樁') {
                            $query->where('gender', $schedule->gender);
                        }
                    })
                        ->where('game_id', config('app.game_id'))
                        ->where('group', $schedule->group)
                        ->where('item', $schedule->item)
                        ->where('level', $schedule->level)
                        ->whereNotNull('rank')
                        ->orderBy('rank')
                        ->get();

                    $sheet->row($initIndex, ['名次', '選手', '單位', '成績', '積分']);
                    $initIndex++;

                    $sheet->mergeCells('A' . $initIndex . ':E' . $initIndex);
                    $sheet->cell('A' . $initIndex, function ($cell) use ($schedule) {
                        $cell->setAlignment('center');
                        $cell->setValue($schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . '子組 ' . $schedule->item);
                    });
                    $initIndex++;

                    if ($schedule->order == '場次33') {
                        $sheet->row($initIndex, [1, '358 劉巧兮', PlayerModel::find('358')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '160 丁于恩', PlayerModel::find('160')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '363 黃苗嫚', PlayerModel::find('363')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '266 王佑瑜', PlayerModel::find('266')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '128 楊允彣', PlayerModel::find('128')->agency, '', '4']);
                        $initIndex++;
                        $sheet->row($initIndex, [6, '215 李蘊芳', PlayerModel::find('215')->agency, '', '3']);
                        $initIndex++;
                        $sheet->row($initIndex, [7, '249 徐嘉欣', PlayerModel::find('249')->agency, '', '2']);
                        $initIndex++;
                        $sheet->row($initIndex, [8, '173 江芮琳', PlayerModel::find('173')->agency, '', '1']);
                        $initIndex++;
                        continue;
                    }

                    if ($schedule->order == '場次34') {
                        $sheet->row($initIndex, [1, '255 鄭宇翔', PlayerModel::find('255')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '373 郭加恩', PlayerModel::find('373')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '058 楊凱崴', PlayerModel::find('058')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '113 許至曦', PlayerModel::find('113')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '138 林子宸', PlayerModel::find('138')->agency, '', '4']);
                        $initIndex++;
                        $sheet->row($initIndex, [6, '105 盧右晨', PlayerModel::find('105')->agency, '', '3']);
                        $initIndex++;
                        $sheet->row($initIndex, [7, '061 巫蘇宇恩', PlayerModel::find('061')->agency, '', '2']);
                        $initIndex++;
                        $sheet->row($initIndex, [8, '112 陳廷翊', PlayerModel::find('112')->agency, '', '1']);
                        $initIndex++;
                        continue;
                    }

                    if ($schedule->order == '場次35') {
                        $sheet->row($initIndex, [1, '283 陳貝怡', PlayerModel::find('283')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '119 呂采榛', PlayerModel::find('119')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '282 羅珮瑜', PlayerModel::find('282')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '252 梁宣旼', PlayerModel::find('252')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '159 王佳葳', PlayerModel::find('159')->agency, '', '4']);
                        $initIndex++;
                        continue;
                    }

                    if ($schedule->order == '場次36') {
                        $sheet->row($initIndex, [1, '281 陳昱錡', PlayerModel::find('281')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '172 鄭睿綸', PlayerModel::find('172')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '256 李孝恒', PlayerModel::find('256')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '186 呂尚豐', PlayerModel::find('186')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '065 楊曾智', PlayerModel::find('065')->agency, '', '4']);
                        $initIndex++;
                        $sheet->row($initIndex, [6, '352 吳東諺', PlayerModel::find('352')->agency, '', '3']);
                        $initIndex++;
                        $sheet->row($initIndex, [7, '253 賴徐捷', PlayerModel::find('253')->agency, '', '2']);
                        $initIndex++;
                        $sheet->row($initIndex, [8, '254 盧奕辰', PlayerModel::find('254')->agency, '', '1']);
                        $initIndex++;
                        continue;
                    }

                    if ($schedule->order == '場次52') {
                        $sheet->row($initIndex, [1, '373 郭加恩', PlayerModel::find('373')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '058 楊凱崴', PlayerModel::find('058')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '061 巫蘇宇恩', PlayerModel::find('061')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '264 黃緯華', PlayerModel::find('264')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '113 許至曦', PlayerModel::find('113')->agency, '', '4']);
                        $initIndex++;
                        $sheet->row($initIndex, [6, '263 黃品睿', PlayerModel::find('263')->agency, '', '3']);
                        $initIndex++;
                        $sheet->row($initIndex, [7, '219 滑彥凱', PlayerModel::find('219')->agency, '', '2']);
                        $initIndex++;
                        $sheet->row($initIndex, [8, '267 王宥鈞', PlayerModel::find('267')->agency, '', '1']);
                        $initIndex++;
                        continue;
                    }

                    if ($schedule->order == '場次53') {
                        $sheet->row($initIndex, [1, '118 游涵伃', PlayerModel::find('118')->agency, '', '12']);
                        $initIndex++;
                        $sheet->row($initIndex, [2, '215 李蘊芳', PlayerModel::find('215')->agency, '', '9']);
                        $initIndex++;
                        $sheet->row($initIndex, [3, '128 楊允彣', PlayerModel::find('128')->agency, '', '7']);
                        $initIndex++;
                        $sheet->row($initIndex, [4, '275 江艾琳', PlayerModel::find('275')->agency, '', '5']);
                        $initIndex++;
                        $sheet->row($initIndex, [5, '106 丁昕羽', PlayerModel::find('106')->agency, '', '4']);
                        $initIndex++;
                        $sheet->row($initIndex, [6, '089 涂舒婷', PlayerModel::find('089')->agency, '', '3']);
                        $initIndex++;
                        $sheet->row($initIndex, [7, '095 張芃竹', PlayerModel::find('095')->agency, '', '2']);
                        $initIndex++;
                        $sheet->row($initIndex, [8, '330 林紜妘', PlayerModel::find('330')->agency, '', '1']);
                        $initIndex++;
                        continue;
                    }

                    if ($results->isEmpty()) {
                        $sheet->mergeCells('A' . $initIndex . ':E' . $initIndex);
                        $sheet->cell('A' . $initIndex, function ($cell) {
                            $cell->setValue('無資料');
                        });
                        $initIndex++;
                    } else {
                        foreach ($results as $result) {
                            if (strpos($result->item, '選手菁英') !== false) {
                                $積分 = [
                                    1 => 12,
                                    2 => 9,
                                    3 => 7,
                                    4 => 5,
                                    5 => 4,
                                    6 => 3,
                                    7 => 2,
                                    8 => 1,
                                ];

                                if ($result->rank > 8) {
                                    $sheet->row($initIndex, [$result->rank, $result->player_number . ' ' . $result->player->name, $result->player->agency, $result->final_result]);
                                } else {
                                    $sheet->row($initIndex, [$result->rank, $result->player_number . ' ' . $result->player->name, $result->player->agency, $result->final_result, $積分[$result->rank]]);
                                }

                            } else {
                                $sheet->row($initIndex, [$result->rank, $result->player_number . ' ' . $result->player->name, $result->player->agency, $result->final_result]);
                            }

                            $initIndex++;
                        }
                    }
                }
            });
        })->download('xls');
    }

    public function 花樁評分表()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->where('item', 'like', '%花%')
            ->orWhere('item', 'like', '%套路%')
            ->get();

        Excel::create('花樁評分表', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order, function ($sheet) use ($schedule) {
                    $sheet->setAllBorders('thin');
                    $sheet->setHeight(40);
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->setFontSize(10);
                    $sheet->setWidth(array(
                        'A' => 12,
                        'B' => 12,
                        'C' => 12,
                        'D' => 12,
                        'E' => 12,
                        'F' => 12,
                        'G' => 12,
                        'H' => 12,
                    ));

                    $sheet->setHeight(1, 40);
                    $sheet->setHeight(3, 30);

                    $sheet->mergeCells('A1:H1');

                    $sheet->cell('A1', function ($cell) use ($schedule) {
                        $cell->setValue($schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . ' ' . $schedule->item);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) {
                        $cell->setValue('簽序');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B3', function ($cell) {
                        $cell->setValue('選手號');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C3', function ($cell) {
                        $cell->setValue('選手姓名');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function ($cell) {
                        $cell->setValue('基礎分50%');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E3', function ($cell) {
                        $cell->setValue('質量分50%');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F3', function ($cell) {
                        $cell->setValue('失誤輔分');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G3', function ($cell) {
                        $cell->setValue('時間罰分');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H3', function ($cell) {
                        $cell->setValue('總分');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    if (strpos($schedule->item, '套路') !== false && strpos($schedule->group, '國小') !== false) {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group2', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    } else {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    }

                    $location = 4;
                    foreach ($enrolls as $key => $enroll) {

                        $sheet->setHeight($location, 30);

                        $sheet->cell('A' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->appearance);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('B' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player_number);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $location++;
                    }
                });
            }
        })->download('xls');
    }

    public function 花樁總匯表()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->where('item', 'like', '%花%')
            ->orWhere('item', 'like', '%套路%')
            ->get();

        Excel::create('花樁總匯表', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order, function ($sheet) use ($schedule) {
                    $sheet->setAllBorders('thin');
                    $sheet->setHeight(40);
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->setFontSize(10);
                    $sheet->setWidth(array(
                        'A' => 12,
                        'B' => 12,
                        'C' => 12,
                        'D' => 12,
                        'E' => 12,
                        'F' => 12,
                        'G' => 12,
                        'H' => 12,
                    ));

                    $sheet->setHeight(1, 40);
                    $sheet->setHeight(3, 30);

                    $sheet->mergeCells('A1:H1');

                    $sheet->cell('A1', function ($cell) use ($schedule) {
                        $cell->setValue($schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . ' ' . $schedule->item);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) {
                        $cell->setValue('簽序');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B3', function ($cell) {
                        $cell->setValue('選手號');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C3', function ($cell) {
                        $cell->setValue('選手姓名');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function ($cell) {
                        $cell->setValue('裁判一');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E3', function ($cell) {
                        $cell->setValue('裁判二');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F3', function ($cell) {
                        $cell->setValue('裁判三');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G3', function ($cell) {
                        $cell->setValue('裁判四');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('H3', function ($cell) {
                        $cell->setValue('裁判五');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    if (strpos($schedule->item, '套路') !== false && strpos($schedule->group, '國小') !== false) {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group2', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->orderBy('appearance')
                            ->get();
                    } else {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->orderBy('appearance')
                            ->get();
                    }

                    $location = 4;
                    foreach ($enrolls as $key => $enroll) {

                        $sheet->setHeight($location, 30);

                        $sheet->cell('A' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->appearance);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('B' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player_number);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $location++;
                    }
                });
            }
        })->download('xls');
    }

    public function 花樁罰分紀錄()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->where('item', 'like', '%花%')
            ->orWhere('item', 'like', '%套路%')
            ->get();

        Excel::create('花樁罰分紀錄', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order, function ($sheet) use ($schedule) {
                    $sheet->setAllBorders('thin');
                    $sheet->setHeight(40);
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->setFontSize(10);
                    $sheet->setWidth(array(
                        'A' => 12,
                        'B' => 12,
                        'C' => 12,
                        'D' => 12,
                        'E' => 12,
                        'F' => 12,
                        'G' => 12,
                    ));

                    $sheet->setHeight(1, 40);
                    $sheet->setHeight(3, 30);

                    $sheet->mergeCells('A1:G1');

                    $sheet->cell('A1', function ($cell) use ($schedule) {
                        $cell->setValue($schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . ' ' . $schedule->item);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) {
                        $cell->setValue('簽序');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B3', function ($cell) {
                        $cell->setValue('選手號');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C3', function ($cell) {
                        $cell->setValue('選手姓名');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function ($cell) {
                        $cell->setValue('誤樁數');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E3', function ($cell) {
                        $cell->setValue('誤樁扣分');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F3', function ($cell) {
                        $cell->setValue('時間');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G3', function ($cell) {
                        $cell->setValue('時間罰分');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    if (strpos($schedule->item, '套路') !== false && strpos($schedule->group, '國小') !== false) {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group2', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    } else {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    }

                    $location = 4;
                    foreach ($enrolls as $key => $enroll) {

                        $sheet->setHeight($location, 30);

                        $sheet->cell('A' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->appearance);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('B' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player_number);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $sheet->cell('C' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $location++;
                    }
                });
            }
        })->download('xls');
    }

    public function 花樁紀錄()
    {
        $schedules = ScheduleModel::where('game_id', config('app.game_id'))
            ->where('item', 'like', '%花%')
            ->orWhere('item', 'like', '%套路%')
            ->get();

        Excel::create('花樁紀錄', function ($excel) use ($schedules) {
            foreach ($schedules as $schedule) {
                $excel->sheet($schedule->order, function ($sheet) use ($schedule) {
                    $sheet->setAllBorders('thin');
                    $sheet->setFontFamily('微軟正黑體');
                    $sheet->setFontSize(10);
                    $sheet->setWidth(array(
                        'A' => 24,
                        'B' => 24,
                        'C' => 24,
                        'D' => 24,
                        'E' => 24,
                        'F' => 24,
                        'G' => 24,
                    ));

                    $sheet->setHeight(1, 40);
                    $sheet->setHeight(3, 30);

                    $sheet->mergeCells('A1:G1');

                    $sheet->cell('A1', function ($cell) use ($schedule) {
                        $cell->setValue('花樁紀錄 ' . $schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . ' ' . $schedule->item);
                        $cell->setFontSize(18);
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('A3', function ($cell) {
                        $cell->setValue('選手');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('B3', function ($cell) {
                        $cell->setValue('其它類');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('C3', function ($cell) {
                        $cell->setValue('蹲坐類');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('D3', function ($cell) {
                        $cell->setValue('跳躍類');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('E3', function ($cell) {
                        $cell->setValue('單輪類');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('F3', function ($cell) {
                        $cell->setValue('旋轉類');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });
                    $sheet->cell('G3', function ($cell) {
                        $cell->setValue('備註');
                        $cell->setAlignment('center');
                        $cell->setValignment('center');
                    });

                    if (strpos($schedule->item, '套路') !== false && strpos($schedule->group, '國小') !== false) {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group2', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    } else {

                        $enrolls = EnrollModel::where('gender', $schedule->gender)
                            ->where('group', $schedule->group)
                            ->where('item', $schedule->item)
                            ->where('level', $schedule->level)
                            ->where('game_id', config('app.game_id'))
                            ->orderBy('appearance')
                            ->get();
                    }

                    $location = 4;
                    foreach ($enrolls as $key => $enroll) {

                        $sheet->setHeight($location, 80);

                        $sheet->cell('A' . $location, function ($cell) use ($enroll) {
                            $cell->setValue($enroll->player_number . ' ' . $enroll->player->name);
                            $cell->setAlignment('center');
                            $cell->setValignment('center');
                        });
                        $location++;
                    }
                });
            }
        })->download('xls');
    }
}
