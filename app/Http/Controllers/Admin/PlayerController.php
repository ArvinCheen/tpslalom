<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enrollPlayers()
    {
        $playerService = new PlayerService();

        $enrollPlayers = $playerService->getEnrollPlayers();

        return view('admin/player/enrollPlayers')->with(compact('enrollPlayers'));
    }
}
