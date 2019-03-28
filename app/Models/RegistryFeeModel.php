<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * App\Models\RegistryFeeModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RegistryFeeModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RegistryFeeModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RegistryFeeModel query()
 * @mixin \Eloquent
 */
class RegistryFeeModel extends Model
{
    protected $table = 'registry_fee';

    protected $fillable = ['game_id', 'account_id', 'player_id', 'fee'];

//    public function store($playerSn, $enrollCount)
//    {
//        $existKey = [
//            'game_id'    => config('app.game_id'),
//            'accountId' => auth()->user()->accountId,
//            'playerSn'  => $playerSn,
//        ];
//
//        $data = [
//            'game_id'    => config('app.game_id'),
//            'accountId' => auth()->user()->accountId,
//            'playerSn'  => $playerSn,
//            'fee'       => 500 + ($enrollCount * 100)
//        ];
//
//        return $this->updateOrCreate($existKey, $data);
//    }

    public function deleteRegistryFee($playerId)
    {
        $this->where('player_id', $playerId)
            ->where('game_id', config('app.game_id'))
            ->delete();
    }

    public function getCart()
    {
        return $this->select([
            'registry_fee.fee',
            'enroll.player_id',
            'enroll.level',
            'enroll.group',
            'player.name',
        ])
            ->leftJoin('enroll', 'enroll.player_id', 'registry_fee.player_id')
            ->leftJoin('player', 'player.id', 'enroll.player_id')
            ->where('enroll.game_id', config('app.game_id'))
            ->where('registry_fee.game_id', config('app.game_id'))
            ->where('registry_fee.account_id', auth()->user()->id)
            ->orderByDesc('enroll.id')
            ->groupBy('enroll.player_id')
            ->get();
    }

    public function getTotal()
    {
        return $this->where('account_id', auth()->user()->id)->where('game_id', config('app.game_id'))->sum('fee');
    }

//    public function getBills()
//    {
//        return $this->select(DB::raw('
//            account.id,
//            teamName,
//            email,
//            phone,
//            address,
//            coach,
//            leader,
//            management,
//            sum(fee) AS totalFee
//    '))
//        ->leftJoin('account', 'account.id', 'registry_fee.accountId')
//        ->where('game_id', config('app.game_id'))
//        ->groupBy('account.id')
//        ->get();
//    }
}
