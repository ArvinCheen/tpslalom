<?php

namespace App\Console\Commands;

use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\ScheduleModel;
use Illuminate\Console\Command;

class tmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '109總統盃版本的隊伍名冊';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public $group = '國中';
    public $item = '個人花式繞樁(男)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schedules = ScheduleModel::where('game_type', '決賽')->where('item', 'like', '%選手菁英%')
            ->orderBy('id')->get();

        foreach ($schedules as $schedule) {
            if ($schedule->order == '場次33') {
                $this->info('場次33 青年 女子組 速度過樁選手菁英組-前溜單足S形');
                $this->info('358 劉巧兮 積分：12');
                $this->info('160 丁于恩 積分：9');
                $this->info('363 黃苗嫚 積分：7');
                $this->info('266 王佑瑜 積分：5');
                $this->info('128 楊允彣 積分：4');
                $this->info('215 李蘊芳 積分：3');
                $this->info('249 徐嘉欣 積分：2');
                $this->info('173 江芮琳 積分：1');
                $this->info('');
                continue;
            }

            if ($schedule->order == '場次34') {
                $this->info('場次34 青年 男子組 速度過樁選手菁英組積分賽-前溜單足S形');
                $this->info('255 鄭宇翔 積分：12');
                $this->info('373 郭加恩 積分：9');
                $this->info('058 楊凱崴 積分：7');
                $this->info('113 許至曦 積分：5');
                $this->info('138 林子宸 積分：4');
                $this->info('105 盧右晨 積分：3');
                $this->info('061 巫蘇宇恩 積分：2');
                $this->info('112 陳廷翊 積分：1');
                $this->info('');
                continue;
            }

            if ($schedule->order == '場次35') {
                $this->info('場次35 成年 女子組 速度過樁選手菁英組積分賽-前溜單足S形');
                $this->info('283 陳貝怡 積分：12');
                $this->info('119 呂采榛 積分：9');
                $this->info('282 羅珮瑜 積分：7');
                $this->info('252 梁宣旼 積分：5');
                $this->info('159 王佳葳 積分：4');
                $this->info('');
                continue;
            }

            if ($schedule->order == '場次36') {
                $this->info('場次36 成年 男子組 速度過樁選手菁英組積分賽-前溜單足S形');
                $this->info('281 陳昱錡 積分：12');
                $this->info('172 鄭睿綸 積分：9');
                $this->info('256 李孝恒 積分：7');
                $this->info('186 呂尚豐 積分：5');
                $this->info('065 楊曾智 積分：4');
                $this->info('352 吳東諺 積分：3');
                $this->info('253 賴徐捷 積分：2');
                $this->info('254 盧奕辰 積分：1');
                $this->info('');
                continue;
            }

            if ($schedule->order == '場次52') {
                $this->info('場次52 國中 男子組 速度過樁選手菁英-前溜單足S形');
                $this->info('373 郭加恩 積分：12');
                $this->info('058 楊凱崴 積分：9');
                $this->info('061 巫蘇宇恩 積分：7');
                $this->info('264 黃緯華 積分：5');
                $this->info('113 許至曦 積分：4');
                $this->info('263 黃品睿 積分：3');
                $this->info('219 滑彥凱 積分：2');
                $this->info('267 王宥鈞 積分：1');
                $this->info('');
                continue;
            }

            if ($schedule->order == '場次53') {
                $this->info('場次53 國中 女子組 速度過樁選手菁英-前溜單足S形');
                $this->info('118 游涵伃 積分：12');
                $this->info('215 李蘊芳 積分：9');
                $this->info('128 楊允彣 積分：7');
                $this->info('275 江艾琳 積分：5');
                $this->info('106 丁昕羽 積分：4');
                $this->info('089 涂舒婷 積分：3');
                $this->info('095 張芃竹 積分：2');
                $this->info('330 林紜妘 積分：1');
                $this->info('');
                continue;
            }
            $enrolls = EnrollModel::wherehas('player', function ($query) use ($schedule) {
                $query->where('gender', $schedule->gender);
            })
                ->where('game_id', config('app.game_id'))
                ->where('group', $schedule->group)
                ->where('item', $schedule->item)
                ->whereNotNull('rank')
                ->orderBy('rank')
                ->limit(8)
                ->get();

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
            $this->info($schedule->order . ' ' . $schedule->group . ' ' . $schedule->gender . '子組 ' . $schedule->item);
            foreach ($enrolls as $enroll) {
                $this->info($enroll->player->id . ' ' . $enroll->player->name . ' 積分：' . $積分[$enroll->rank]);
            }
            $this->info('');
        }
    }
}
