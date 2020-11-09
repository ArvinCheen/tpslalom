<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\ScheduleModel;

class CreatePlayerNumberController extends Controller
{
    public function index()
    {
        $players = EnrollModel::where('game_id', config('app.game_id'))->groupBy('player_id')->inRandomOrder()->get();

        $number = 1;
        foreach ($players as $player) {
            EnrollModel::where('game_id', config('app.game_id'))
                ->where('player_id', $player->player_id)
                ->update(
                    ['player_number' => $number]
                );

            $number++;
        }

        return back()->with(['success' => '生成選手號碼成功']);
    }
}
