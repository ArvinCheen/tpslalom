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
            'gameSn'    => config('app.gameSn'),
            'accountId' => auth()->user()->accountId,
            'playerSn'  => $playerSn,
        ];

        $data = [
            'gameSn'    => config('app.gameSn'),
            'accountId' => auth()->user()->accountId,
            'playerSn'  => $playerSn,
            'fee'       => 500 + ($enrollCount * 100)
        ];

        return $this->updateOrCreate($existKey, $data);
    }

    public function deleteRegistryFee($playerSn)
    {
        $this->where('playerSn', $playerSn)
            ->where('gameSn', config('app.gameSn'))
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
            ->where('enroll.gameSn', config('app.gameSn'))
            ->where('registryfee.gameSn', config('app.gameSn'))
            ->where('registryfee.accountId', auth()->user()->accountId)
            ->orderByDesc('enroll.enrollSn')
            ->groupBy('enroll.playerNumber')
            ->get();
    }

    public function getTotal()
    {
        return $this->where('accountId', auth()->user()->accountId)
            ->where('gameSn', config('app.gameSn'))
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
        ->where('gameSn', config('app.gameSn'))
        ->groupBy('account.accountId')
        ->get();
    }
}
