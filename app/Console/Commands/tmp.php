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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (PlayerModel::groupBy('coach')->get() as $v) {
            $players = PlayerModel::where('coach',$v->coach)->orderBy('id')->get();

            $this->info('團隊教練：'.$v->coach);
            foreach ($players as $player) {

                $this->info("$player->id, $player->name, $player->cloth_size, $player->agency");
            }
            $this->info(' ');
        }
        dd();

        $aminoAcid = [
            1  => '苯丙胺酸',
            2  => '白胺酸',
            3  => '異白胺酸',
            4  => '甲硫胺酸',
            5  => '纈胺酸',
            6  => '絲胺酸',
            7  => '脯胺酸',
            8  => '蘇胺酸',
            9  => '丙胺酸',
            10 => '酪胺酸',
            11 => '組胺酸',
            12 => '離胺酸',
            13 => '天門冬胺酸',
            14 => '麩胺酸',
            15 => '半胱胺酸',
            16 => '色胺酸',
            17 => '精胺酸',
            18 => '甘胺酸',
            19 => '麩胺醯胺',
            20 => '天門冬醯胺'
        ];

        foreach ($aminoAcid as $k => $v) {
            $this->info($k . ',' . $v);
        }

//        \DB::table('amino_acid')->truncate();
//        \DB::table('amino_acid')->insert(['id' => 1, 'name' => $aminoAcid[1]]);
//        \DB::table('amino_acid')->insert(['id' => 2, 'name' => $aminoAcid[2]]);
//        \DB::table('amino_acid')->insert(['id' => 3, 'name' => $aminoAcid[3]]);
//        \DB::table('amino_acid')->insert(['id' => 4, 'name' => $aminoAcid[4]]);
//        \DB::table('amino_acid')->insert(['id' => 5, 'name' => $aminoAcid[5]]);
//        \DB::table('amino_acid')->insert(['id' => 6, 'name' => $aminoAcid[6]]);
//        \DB::table('amino_acid')->insert(['id' => 7, 'name' => $aminoAcid[7]]);
//        \DB::table('amino_acid')->insert(['id' => 8, 'name' => $aminoAcid[8]]);
//        \DB::table('amino_acid')->insert(['id' => 9, 'name' => $aminoAcid[9]]);
//        \DB::table('amino_acid')->insert(['id' => 10, 'name' => $aminoAcid[10]]);
//        \DB::table('amino_acid')->insert(['id' => 11, 'name' => $aminoAcid[11]]);
//        \DB::table('amino_acid')->insert(['id' => 12, 'name' => $aminoAcid[12]]);
//        \DB::table('amino_acid')->insert(['id' => 13, 'name' => $aminoAcid[13]]);
//        \DB::table('amino_acid')->insert(['id' => 14, 'name' => $aminoAcid[14]]);
//        \DB::table('amino_acid')->insert(['id' => 15, 'name' => $aminoAcid[15]]);
//        \DB::table('amino_acid')->insert(['id' => 16, 'name' => $aminoAcid[16]]);
//        \DB::table('amino_acid')->insert(['id' => 17, 'name' => $aminoAcid[17]]);
//        \DB::table('amino_acid')->insert(['id' => 18, 'name' => $aminoAcid[18]]);
//        \DB::table('amino_acid')->insert(['id' => 19, 'name' => $aminoAcid[19]]);
//        \DB::table('amino_acid')->insert(['id' => 20, 'name' => $aminoAcid[20]]);

        $characteristic = [
            1 => null,
            2 => null,
            3 => null,
            4 => null,
        ];

        $characteristicNumber = 1;

        foreach ($aminoAcid as $key1 => $v1) {

            $characteristic[1] = "($key1)$v1";

            foreach ($aminoAcid as $key2 => $v2) {
                $characteristic[2] = "($key2)$v2";

                foreach ($aminoAcid as $key3 => $v3) {
                    $characteristic[3] = "($key3)$v3";

                    foreach ($aminoAcid as $key4 => $v4) {
                        $characteristic[4] = "($key4)$v4";
//                        \DB::table('characteristic')->insert([
//                            'id'      => $characteristicNumber,
//                            'amino_1' => $key1,
//                            'amino_2' => $key2,
//                            'amino_3' => $key3,
//                            'amino_4' => $key4,
//                            'name'    => null,
//                        ]);

                        $this->info($characteristicNumber . ',' . $characteristic[1] . ',' . $characteristic[2] . ',' . $characteristic[3] . ',' . $characteristic[4] . ',特性');

                        $characteristicNumber++;
                    }
                }
            }
        }
    }
}
