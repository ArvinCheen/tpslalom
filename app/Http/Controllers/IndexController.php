<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\GameModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $gameInfo = GameModel::find(config('app.game_id'));

        return view('index')->with(compact('gameInfo'));
    }
}
