<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\GameModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $gameInfo = GameModel::find(env('GAME'));

        return view('index')->with(compact('gameInfo'));
    }
}
