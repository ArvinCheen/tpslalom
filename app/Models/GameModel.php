<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GameModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GameModel query()
 * @mixin \Eloquent
 */
class GameModel extends Model
{
    protected $table = 'game';

    protected $guarded = ['id'];

    public function getAll()
    {
        return $this->orderByDesc('id')->get();
    }
}

