<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RegistryFeeModel extends Model
{
    protected $table = 'registryfee';

    protected $primaryKey = 'registryFeeSn';

    protected $fillable = ['gameSn', 'accountId', 'playerNumber', 'playerSn', 'fee'];

    public $timestamps = true;

    const CREATED_AT = 'createTime';

    const UPDATED_AT = 'updateTime';

    public function store($playerSn, $enrollCount)
    {
        $existKey = [
            'gameSn'    => env('GAME'),
            'accountId' => auth()->user()->accountId,
            'playerSn'  => $playerSn,
        ];

        $data = [
            'gameSn'    => env('GAME'),
            'accountId' => auth()->user()->accountId,
            'playerSn'  => $playerSn,
//            'fee'       => 400 + ($enrollCount * 100)
            'fee'       => 500 //36中正盃改為只開放單項，費用500
        ];

        return $this->updateOrCreate($existKey, $data);
    }

    public function deleteRegistryFee($playerSn)
    {
        $this->where('playerSn', $playerSn)
            ->where('gameSn', env('GAME'))
            ->delete();
    }

    public function getCart()
    {
        $select = [
            'registryfee.fee',
            'enroll.playerSn',
            'enroll.level',
            'enroll.group',
            'player.name'
        ];

        return $this->select($select)
            ->leftJoin('enroll', 'enroll.playerSn', 'registryfee.playerSn')
            ->leftJoin('player', 'player.playerSn', 'enroll.playerSn')
            ->where('enroll.gameSn', env('GAME'))
            ->where('registryfee.gameSn', env('GAME'))
            ->where('registryfee.accountId', auth()->user()->accountId)
            ->orderByDesc('enroll.enrollSn')
            ->groupBy('enroll.playerNumber')
            ->get();
    }

    public function getTotal()
    {
        return $this->where('accountId', auth()->user()->accountId)
            ->where('gameSn', env('GAME'))
            ->sum('fee');
    }

    public function getBills()
    {
        return $this->select(DB::raw('
            account.accountId,
            teamName,
            email,
            phone,
            address,
            coach,
            leader,
            management,
            sum(fee) AS totalFee
    '))
        ->leftJoin('account', 'account.accountId', 'registryfee.accountId')
        ->where('gameSn', session('gameSn'))
        ->groupBy('account.accountId')
        ->get();
    }
}
