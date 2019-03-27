<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerModel extends Model
{
    protected $table = 'player';

    protected $fillable = ['account_id', 'name', 'gender', 'city', 'agency'];

    public function store($playerId, $data)
    {
        return $this->updateOrCreate(['player_id' => $playerId], $data);
    }

    public function getPlayers()
    {
        return $this->where('account_id', auth()->user()->Id)->orderByDesc('player_id')->get();
    }
}
