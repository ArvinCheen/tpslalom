<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    protected $table = 'game';

    public function getAll()
    {
        return $this->orderByDesc('id')->get();
    }
}

