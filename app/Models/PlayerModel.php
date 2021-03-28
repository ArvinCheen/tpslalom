<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlayerModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlayerModel query()
 * @mixin \Eloquent
 */
class PlayerModel extends Model
{
    protected $table = 'player';

    protected $guarded = ['id'];

    public function store($playerId, $data)
    {
        return $this->updateOrCreate(['player_id' => $playerId], $data);
    }

    public function account()
    {
        return $this->hasOne('App\Models\AccountModel', 'id', 'account_id');
    }

    public function enroll()
    {
        return $this->belongsTo('App\Models\EnrollModel', 'id', 'player_id');
    }

    public function getPlayers()
    {
        return $this->where('account_id', auth()->user()->id)->orderByDesc('id')->get();
    }
}
