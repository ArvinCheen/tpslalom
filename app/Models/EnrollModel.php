<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnrollModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel query()
 * @mixin \Eloquent
 */
class EnrollModel extends Model
{
    protected $table = 'enroll';


    protected $fillable = ['game_id', 'player_id', 'player_number', 'account_id', 'level', 'group', 'item',
        'round_one_second', 'round_one_miss_conr', 'round_two_second', 'round_two_miss_conr', 'final_result',
        'rank', 'integral', 'check', 'check_in_time'];

    public function player()
    {
        return $this->hasOne('App\Models\PlayerModel', 'id', 'player_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\AccountModel', 'id', 'account_id');
    }
//
//    public function game()
//    {
//        return $this->hasOne('App\Models\GameModel', 'game_id', 'game_id');
//    }

    public function isPlayerExists($playerId)
    {
        return $this->where('game_id', config('app.game_id'))->where('player_id', $playerId)->exists();
    }

    public function getPlayerNumber($playerId)
    {
        return $this->where('game_id', config('app.game_id'))->where('player_id', $playerId)->value('player_number');
    }

    public function getNewPlayerNumber()
    {
        return $this->where('game_id', config('app.game_id'))->max('player_number') + 1;
    }

    public function getEnrollQuantity($playerId)
    {
        return $this->where('player_id', $playerId)
            ->where('game_id', config('app.game_id'))
            ->count();
    }

    public function cancel($playerId)
    {
        return $this->where('player_id', $playerId)->where('game_id', config('app.game_id'))->delete();
    }

    public function getItemLevel($playerId, $item)
    {
        return $this->where('game_id', config('app.game_id'))
            ->where('item', $item)
            ->where('player_id', $playerId)
            ->value('level');
    }

    public function getGroup($playerId)
    {
        return $this->where('game_id', config('app.game_id'))->where('player_id', $playerId)->value('group');
    }

    public function getLevel($playerId)
    {
        return $this->where('game_id', config('app.game_id'))
            ->where('player_id', $playerId)
            ->value('level');
    }

    public function getPlayerEnrollItem($playerId)
    {
        return $this->select('level', 'item')
            ->where('game_id', config('app.game_id'))
            ->where('player_id', $playerId)
            ->get();
    }

    public function getPlayer($playerId)
    {
        $select = [
            'player.id',
            'player.name',
            'player.gender',
            'player.city',
            'player.agency',
            'enroll.group',
        ];

        return $this->select($select)
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('player_id', $playerId)
            ->where('account_id', auth()->user()->id)
            ->first();
    }

    public function updateData()
    {

        $updateData = [
            'round_one_second'    => 0,
            'round_one_miss_conr' => '失格',
            'round_two_second'    => 0,
            'round_two_miss_conr' => '失格',
        ];

        $data = $this
//            ->where('game_id', '106青年盃')
            ->where('round_one_miss_conr', '失格')
//            ->get();
            ->update($updateData);

        dd($data);
    }

    public function updateSameResultForRank($level, $gender, $group, $item, $finalResult, $city, $updateData)
    {
        $query = $this->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('final_result', $finalResult);

        if ($city == '臺北市') {
            $query->where('city', '臺北市');
        } else {
            $query->where('city', '<>', '臺北市');
        }

        $query->update($updateData);
    }

    public function updateSameResultForIntegral($level, $gender, $group, $item, $finalResult, $updateData)
    {
        return $this->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('final_result', $finalResult)
            ->update($updateData);
    }

    public function cleanRankAndIntegral($scheduleId)
    {
        $gameInfo = ScheduleModel::find($scheduleId);

        $enrolls = $this->select('enroll.id')
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $gameInfo->level)
            ->where('gender', $gameInfo->gender)
            ->where('group', $gameInfo->group)
            ->where('item', $gameInfo->item)
            ->get()
            ->map(function ($query) {
                return $query->id;
            });

        return $this->whereIn('id', $enrolls)->update(['rank' => null, 'integral' => null,]);
    }

    public function getGameList()
    {
        return $this->groupBy('game_id')
            ->orderByDesc('id')
            ->get();
    }

    public function getEnrollPlayers($item)
    {
        return $this->select([
            'enroll.player_number',
            'name',
            'gender',
            'level',
            'group',
            'item',
            'account.id',
            'coach',
        ])
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->leftJoin('account', 'account.id', 'enroll.account_id')
            ->where('game_id', config('app.game_id'))
            ->where('item', $item)
            ->groupBy('player.id')
            ->orderBy('enroll.player_number')
            ->get();
    }

//    public function isGameOver($level, $gender, $group, $item)
//    {
//          這個好像沒用到
//        $data = $this->leftJoin('player', 'player.id', 'enroll.player_id')
//            ->where('level', $level)
//            ->where('gender', $gender)
//            ->where('group', $group)
//            ->where('item', $item)
//            ->whereNull('final_result')
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
            "rank"     => null,
            "integral" => null
        ];

        return $this->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->update($updateData);
    }

    public function getResults($level, $gender, $group, $item, $city)
    {
        return $this::whereHas('player', function ($query) use ($gender, $city) {
                $query->where('gender', $gender);

                if (! is_null($city)) {
                    if ($city == '臺北市') {
                        $query->where('city', '臺北市');
                    } else {
                        $query->where('city', '<>', '臺北市');
                    }
                }
            })
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('group', $group)
            ->where('item', $item)
            ->where('final_result', '<>', '無成績')
            ->limit(6)
            ->orderBy(\DB::raw("final_result * 1"))
            ->get();
    }

    public function getOtherCityResultOrderSn($level, $gender, $group, $item)
    {
        return $this
            ->select('enroll.id')
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('city', '<>', '臺北市')
            ->where('final_result', '<>', '無成績')
            ->orderBy(DB::raw("convert(final_result, decimal)"))
            ->get();
    }

    public function getSameResult($level, $gender, $group, $item, $city = null)
    {
        $query = $this
            ->select(DB::raw('
                min(rank) as rank,
                max(integral) as integral,
                count(final_result) as sameResult,
                final_result
    '))
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item);

        if ($city == '臺北市' && ! is_null($city)) {
            $query->where('city', '臺北市');
        }

        if ($city <> '臺北市' && ! is_null($city)) {
            $query->where('city', '<>', '臺北市');
        }

        $query->groupBy('final_result');
        $query->having('final_result', '>', 2);

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
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
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
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
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
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
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
        return $this->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('group', 'like',"%$group%")
            ->where('gender', $gender)
            ->where('item', $item)
            ->count();
    }


    public function getParticipateTeam()
    {
        return $this->with('account')->where('game_id', config('app.game_id'))
            ->groupBy('enroll.account_id')
            ->get();
    }

    public function getAllDoc()
    {
        return $this->select(\DB::raw('
            enroll.player_number, 
            name, 
            `level`, 
            `group`, 
            gender, 
            team_name, 
            agency,
            city, 
            coach, 
            leader, 
            management,
            fee,
            GROUP_CONCAT(item) AS itemAll
        '))
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->leftJoin('account', 'account.id', 'player.account_id')
            ->leftJoin('registry_fee', 'registry_fee.player_id', 'enroll.player_id')
            ->where('enroll.game_id', config('app.game_id'))
            ->where('registry_fee.game_id', config('app.game_id'))
            ->groupBy('enroll.player_number')
            ->get();
    }

    public function isGameOver($level, $gender, $group, $item)
    {
        $data = $this->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('game_id', config('app.game_id'))
            ->where('level', $level)
            ->where('gender', $gender)
            ->where('group', $group)
            ->where('item', $item)
            ->where('final_result', '<>', '無成績')
            ->whereNull('rank')
            ->count();
return true; // todo 這裡有換個方式呈現成績
        if ($data == 0) {
            return true;
        } else {
            return false;
        }
    }
}
