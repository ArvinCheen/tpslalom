<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameModel extends Model
{
    protected $table = 'game';

    protected $fillable = ['abridge_name', 'complete_name', 'letter'];

    public function getAll()
    {
        return $this->orderByDesc('id')->get();
    }
}

