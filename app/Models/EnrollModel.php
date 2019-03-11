<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollModel extends Model
{
    protected $table = 'enroll';

    protected $primaryKey = 'enrollSn';

    protected $fillable = ['gameSn', 'playerSn', 'playerNumber', 'accountId', 'level', 'group', 'item',
        'roundOneSecond', 'roundOneMissConr', 'roundTwoSecond', 'roundTwoMissConr', 'finalResult',
        'rank', 'integral', 'check', 'createTime', 'updateTime', 'checkInTime'];

    public $timestamps = true;

    const CREATED_AT = 'createTime';

    const UPDATED_AT = 'updateTime';

    public function player()
    {
        return $this->hasOne('App\Models\PlayerModel', 'playerSn', 'playerSn');
    }

    public function game()
    {
        return $this->hasOne('App\Models\GameModel', 'gameSn', 'gameSn');
    }

    public function store($playerSn, $playerNumber, $group, $level, $item)
    {
        return $this->create([
            'gameSn'       => config('app.gameSn'),
            'playerSn'     => $playerSn,
            'playerNumber' => $playerNumber,
            'accountId'    => auth()->user()->accountId,
            'level'        => $level,
            'group'        => $group,
            'item'         => $item,
        ]);
    }

    public function isPlayerExists($playerSn)
    {
        return $this->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->exists();
    }

    public function getPlayerNumber($playerSn)
    {
        return $this->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->value('playerNumber');
    }

    public function getNewPlayerNumber()
    {
        return $this->where('gameSn', config('app.gameSn'))->max('playerNumber') + 1;
    }

    public function getEnrollQuantity($playerSn)
    {
        return $this->where('playerSn', $playerSn)
            ->where('gameSn', config('app.gameSn'))
            ->count();
    }

    public function cancel($playerSn)
    {
        return $this->where('playerSn', $playerSn)
            ->where('gameSn', config('app.gameSn'))
            ->delete();
    }

    public function getItemLevel($item, $playerSn)
    {
        return $this->where('gameSn', config('app.gameSn'))
            ->where('item', $item)
            ->where('playerSn', $playerSn)
            ->value('level');
    }

    public function getGroup($playerSn)
    {
        return $this->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->value('group');
    }

    public function getLevel($playerSn)
    {
        return $this->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->value('level');
    }

    public function getPlayerEnrollItem($playerSn)
    {
        return $this->select('level', 'item')
            ->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->get();
    }

    public function getPlayer($playerSn)
    {
        $select = [
            'player.playerSn',
            'player.name',
            'player.gender',
            'player.city',
            'player.agency',
            'enroll.group',
        ];

        return $this->select($select)
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('playerSn', $playerSn)
            ->where('accountId', auth()->user()->accountId)
            ->first();
    }

    public function updateData()
    {

        $updateData = [
            'roundOneSecond' => 0,
            'roundOneMissConr' => '失格',
//            'roundTwoSecond' => 0,
//            'roundTwoMissConr' => '失格',
        ];

        $data = $this
//            ->where('gameSn', '106青年盃')
            ->where('roundOneMissConr',  '失格')
//            ->get();
            ->update($updateData);

        dd($data);
    }

    public function updateSameResultForRank($level, $gender, $group, $item, $finalResult, $city, $updateData)
    {
        $query = $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('finalResult', $finalResult);

        if ($city == '臺北市') {
            $query->where('city', '臺北市');
        } else {
            $query->where('city', '<>', '臺北市');
        }

        $query->update($updateData);
    }

    public function updateSameResultForIntegral($level, $gender, $group, $item, $finalResult, $updateData)
    {
        return $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('finalResult', $finalResult)
            ->update($updateData);
    }

    public function cleanRankAndIntegral($level, $gender, $group, $item)
    {
        $updateData = [
            'rank'     => null,
            'integral' => null,
        ];

        $enrolls = $this
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->get()
            ->map(function($query) {
               return $query->enrollSn;
            });

        return $this->whereIn('enrollSn', $enrolls)->update($updateData);
    }

    public function getGameList()
    {
        return $this->groupBy('gameSn')
            ->orderBy('enrollSn', 'desc')
            ->get();
    }

    public function getEnrollPlayers($item)
    {


        return $this->select([
            'enroll.playerNumber',
            'name',
            'gender',
            'level',
            'group',
            'item',
            'account.accountId',
            'coach',
            'enroll.createTime',
        ])
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->leftJoin('account', 'account.accountId', 'enroll.accountId')
            ->where('gameSn', config('app.gameSn'))
            ->where('item', $item)
            ->groupBy('player.playerSn')
            ->orderByDesc('enroll.createTime')
            ->get();
    }

//    public function isGameOver($level, $gender, $group, $item)
//    {
//          這個好像沒用到
//        $data = $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
//            ->where('level', $level)
//            ->where('gender', $gender)
//            ->where('group', $group)
//            ->where('item', $item)
//            ->whereNull('finalResult')
//            ->get();
//
//        if ($data) {
//            return false;
//        } else {
//            return true;
//        }
//    }

    public function resetPlayerResult($level, $gender, $group, $item)
    {
        $updateData = [
                "rank" => null,
                "integral" => null
            ];

        return $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->update($updateData);
    }

    public function getResultOrderSns($level, $gender, $group, $item, $city)
    {
        $query = $this
            ->select('enroll.enrollSn')
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('finalResult', '<>', '無成績');

        if (!is_null($city)) {
            if ($city == '臺北市') {
                $query->where('city', '臺北市');
            } else {
                $query->where('city', '<>', '臺北市');
            }
        }

        return $query->limit(6)
            ->orderBy(\DB::raw("finalResult * 1"))
            ->get();
    }

    public function getOtherCityResultOrderSn($level, $gender, $group, $item)
    {
        return $this
            ->select('enroll.enrollSn')
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('city', '<>', '臺北市')
            ->where('finalResult', '<>','無成績')
            ->orderBy(DB::raw("convert(finalResult, decimal)"))
            ->get();
    }

    public function getSameResult($level, $gender, $group, $item, $city = null)
    {
        $query = $this
            ->select(DB::raw('
                min(rank) as rank,
                max(integral) as integral,
                count(finalResult) as sameResult,
                finalResult
    '))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item);

        if ($city == '臺北市' && !is_null($city)) {
            $query->where('city', '臺北市');
        }

        if ($city <> '臺北市' && !is_null($city)) {
            $query->where('city', '<>', '臺北市');
        }

        $query->groupBy('finalResult');
        $query->having('finalResult', '>', 2);

        return $query->get();
    }

    public function getMedalQuantity()
    {
        $taipeiMedal = $this
            ->select(\DB::raw('
                `gender`,
                `level`,
                `group`,
                `item`,
                `city`,
                count(*) as quantity
    '))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('city', '臺北市')
            ->where('level', '新人組')
            ->groupBy('level', 'group', 'item', 'gender');

        $noTaipeiMedal = $this
            ->select(\DB::raw('
                `gender`,
                `level`,
                `group`,
                `item`,
                `city`,
                count(*) as quantity
    '))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('city', '<>', '臺北市')
            ->where('level', '新人組')
            ->groupBy('level', 'group', 'item', 'gender');

        $選手Medal = $this
            ->select(\DB::raw('
                `gender`,
                `level`,
                `group`,
                `item`,
                `city`,
                count(*) as quantity
    '))
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->groupBy('level', 'group', 'item', 'gender');

        return $taipeiMedal->union($noTaipeiMedal)->union($選手Medal)
            ->orderBy('level')
            ->orderBy('group')
            ->orderBy('item')
            ->orderBy('city', 'desc')
            ->orderBy('gender', 'desc')
            ->get();
    }

    public function countGameItemNumberOfPlayer($level, $group, $gender, $item)
    {
        return $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('group', $group)
            ->where('gender', $gender)
            ->where('item', $item)
            ->count();
        dd();
    }


    public function getParticipateTeam()
    {
        return $this->leftJoin('account', 'account.accountId', 'enroll.accountId')
            ->where('gameSn', config('app.gameSn'))
            ->groupBy('enroll.accountId')
            ->get();
    }

    public function getAllDoc()
    {
        return $this->select(\DB::raw('
            enroll.playerNumber, 
            name, 
            `level`, 
            `group`, 
            gender, 
            teamName, 
            agency,
            city, 
            coach, 
            leader, 
            management,
            fee,
            GROUP_CONCAT(item) AS itemAll
        '))
        ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
        ->leftJoin('account', 'account.accountId', 'player.accountId')
        ->leftJoin('registryfee', 'registryfee.playerSn', 'enroll.playerSn')
        ->where('enroll.gameSn', config('app.gameSn'))
        ->where('registryfee.gameSn', config('app.gameSn'))
        ->groupBy('enroll.playerNumber')
        ->get();
    }

    public function isGameOver($level, $gender, $group, $item)
    {
        $data = $this->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('gameSn', config('app.gameSn'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('finalResult', '<>', '無成績')
            ->whereNull('rank')
            ->count();

        if ($data == 0) {
            return true;
        } else {
            return false;
        }
    }
}
