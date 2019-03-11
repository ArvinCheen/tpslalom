<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    protected $table = 'player';

    protected $primaryKey = 'playerSn';

    protected $fillable = ['accountId', 'name', 'gender', 'city', 'agency', 'createTime', 'updateTime'];

    public $timestamps = true;

    const CREATED_AT = 'createTime';

    const UPDATED_AT = 'updateTime';

    public function store($playerSn, $data)
    {
        return $this->updateOrCreate(['playerSn' => $playerSn], $data);
    }

    public function getPlayers()
    {
        return $this->where('accountId', auth()->user()->accountId)->orderByDesc('playerSn')->get();
    }
}
