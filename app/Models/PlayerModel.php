<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    protected $table = 'player';

    public function store($playerSn, $data)
    {
        return $this->updateOrCreate(['playerSn' => $playerSn], $data);
    }

    public function getPlayers()
    {
        return $this->where('accountId', auth()->user()->accountId)->orderByDesc('playerSn')->get();
    }
}
