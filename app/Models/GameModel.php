<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    protected $table = 'game';

    protected $primaryKey = 'gameSn';

    protected $fillable = ['abridgeName', 'completeName', 'letter'];

    public function getAll()
    {
        return $this->orderByDesc('gameSn')->get();
    }
}

