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
        try {
            \DB::beginTransaction();

            
            $this->createData('楊昕橋','男','花蓮縣','楊永成','花蓮縣體育會滑輪溜冰委員會','大專社會', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('高啟明','男','高雄市','高啟明','高雄市體育總會滑輪溜冰委員會','大專社會', ['中級指定套路']);
            $this->createData('孫麗晴','女','高雄市','李筱茹','高雄市體育總會滑輪溜冰委員會','大專社會', ['個人花式繞樁']);
            $this->createData('孫麗晴','女','高雄市','李筱茹','高雄市體育總會滑輪溜冰委員會','大專社會', ['個人花式繞樁']);
            $this->createData('王佳葳','女','高雄市','王政基','高雄市體育總會滑輪溜冰委員會','大專社會', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('楊士民','男','新北市','王聖文','新北市體育總會溜冰委員會','大專社會', ['個人花式繞樁']);
            $this->createData('蔡榆平','男','新北市','李懿蓓 高林達','新北市體育總會溜冰委員會','大專社會', ['速度過樁乙組-前溜雙足S形','速度過樁乙組-前溜交叉形']);
            $this->createData('魏庸峻','男','新北市','黃冠儒','新北市體育總會溜冰委員會','大專社會', ['速度過樁選手菁英-前進單足S形','速度過樁選手菁英-前溜雙足S形','速度過樁選手菁英-前溜交叉形','個人花式繞樁']);
            $this->createData('楊翔宇','男','新北市','王聖文、楊翔宇','新北市體育總會溜冰委員會','大專社會', ['個人花式繞樁','速度過樁選手菁英-前溜雙足S形','速度過樁選手菁英-前溜交叉形','速度過樁選手菁英-前進單足S形','花式煞停']);
            $this->createData('林鈐毅','男','新北市','林鈐毅','新北市體育總會溜冰委員會','大專社會', ['個人花式繞樁']);
            $this->createData('呂亭諾','女','新北市','王聖文、楊翔宇','新北市體育總會溜冰委員會','大專社會', ['花式煞停']);
            $this->createData('溫瑞玲','女','新北市','李懿蓓 高林達','新北市體育總會溜冰委員會','大專社會', ['個人花式繞樁']);
            $this->createData('周知毅','男','新竹市','杜澄文','新竹市立成德高中','高中', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('孫廷瑋','男','新竹市','杜澄文','新竹市立青草湖國小','國小五年級', ['速度過樁甲組-前溜交叉形','速度過樁甲組-前溜雙足S形']);
            $this->createData('黃宥恩','男','新竹市','杜澄文','新竹市立青草湖國小','國小三年級', ['速度過樁乙組-前溜雙足S形','速度過樁乙組-前溜交叉形']);
            $this->createData('鄭凱駿','男','新竹市','杜澄文','新竹市立培英國中','國中', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('徐若瑀','女','新竹市','杜澄文','新竹市立新竹國小','國小三年級', ['速度過樁乙組-前溜雙足S形','速度過樁乙組-前溜交叉形']);
            $this->createData('陳昱錡','男','嘉義市','王聖文','嘉義市體育會滑輪溜冰委員會','大專社會', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('羅珮瑜','女','嘉義市','羅賢益、吳素菊','嘉義市體育會滑輪溜冰委員會','大專社會', ['速度過樁選手菁英-前溜雙足S形','速度過樁選手菁英-前溜交叉形','速度過樁選手菁英-前進單足S形']);
            $this->createData('陳貝怡','女','嘉義市','羅賢益、吳素菊','嘉義市體育會滑輪溜冰委員會','大專社會', ['速度過樁選手菁英-前進單足S形']);
            $this->createData('李颻','男','臺中市','余嘉浤','臺中市體育總會滑輪溜冰委員會','大專社會', ['花式煞停']);
            $this->createData('郭俊廷','男','臺中市','余嘉浤','臺中市體育總會滑輪溜冰委員會','大專社會', ['花式煞停']);
            $this->createData('陳建廷','不分','臺北市','王聖文','臺北市體育總會滑輪溜冰協會','大專社會', ['雙人花式繞樁']);
            $this->createData('謝牧倫','男','臺北市','王聖文','臺北市體育總會滑輪溜冰協會','大專社會', ['個人花式繞樁']);
            $this->createData('鍾詠字','男','臺北市','鍾詠字','臺北市體育總會滑輪溜冰協會','大專社會', ['花式煞停']);
            $this->createData('侯鈞諺','不分','臺北市','王聖文','臺北市體育總會滑輪溜冰協會','大專社會', ['雙人花式繞樁']);
            $this->createData('吳東諺','男','臺北市','潘莉青','臺北市體育總會滑輪溜冰協會','大專社會', ['速度過樁選手菁英-前溜雙足S形','速度過樁選手菁英-前進單足S形','速度過樁選手菁英-前溜交叉形']);
            $this->createData('莊祥霖','男','澎湖縣','莊祥霖','澎湖縣體育會溜冰委員會','大專社會', ['個人花式繞樁']);
            
            \DB::commit();
            $this->info('done');
        } catch (\Exception $e) {
            dd($e);
            \DB::rollBack();
        }
    }

    private function createData($name,$gender,$city,$coach,$agency,$group,$items)
    {
        $this->info('.');
        $id = PlayerModel::create([
            'account_id' => 40,
            'name' => $name,
            'gender' => $gender,
            'city' => $city,
            'coach' => $coach,
            'agency' => $agency,
        ])->id;

        foreach ($items as $item) {
            EnrollModel::create([
                'group' => $group,
                'gender' => $gender,
                'item' => $item,
                'player_id' => $id,
                'player_number' => $id,
                'account_id' => 40,
                'game_id' => 1,
            ]);
        }
    }
}
