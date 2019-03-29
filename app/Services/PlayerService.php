<?php
namespace App\Services;

use App\Models\EnrollModel;
use App\Models\PlayerModel;

class PlayerService
{
    public function store($playerId, $name, $gender, $city, $agency)
    {
        $playerModel = new PlayerModel();

        return $playerModel->store($playerId , [
            'accountId' => auth()->user()->accountId,
            'name'      => $name,
            'gender'    => $gender,
            'city'      => $city,
            'agency'    => $agency,
        ]);
    }

    public function getPlayerWithEnrollInfo($playerId)
    {
        $enrollModel = new EnrollModel();

        $player = PlayerModel::find($playerId);
        $player->doubleS = $enrollModel->getItemLevel($item = '前進雙足S型', $playerId);
        $player->singleS = $enrollModel->getItemLevel($item = '前進單足S型', $playerId);
        $player->cross   = $enrollModel->getItemLevel($item = '前進交叉型', $playerId);
        $player->group   = $enrollModel->getGroup($playerId);

        return $player;
    }

    public function getEnrollPlayers()
    {
        $enrollModel = new EnrollModel();

        return (object) [
            'doubleS' => $enrollModel->getEnrollPlayers($item = '前進雙足S型'),
            'singleS' => $enrollModel->getEnrollPlayers($item = '前進單足S型'),
            'cross'   => $enrollModel->getEnrollPlayers($item = '前進交叉型'),
        ];
    }

    public function getPlayers()
    {
        $playerModel = new PlayerModel();

        return $playerModel->getPlayers();
    }

}
