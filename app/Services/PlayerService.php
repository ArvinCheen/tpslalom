<?php
namespace App\Services;

use App\Models\EnrollModel;
use App\Models\PlayerModel;

class PlayerService
{
    public function store($playerSn, $name, $gender, $city, $agency)
    {
        $playerModel = new PlayerModel();

        return $playerModel->store($playerSn , [
            'accountId' => auth()->user()->accountId,
            'name'      => $name,
            'gender'    => $gender,
            'city'      => $city,
            'agency'    => $agency,
        ]);
    }

    public function getPlayerWithEnrollInfo($playerSn)
    {
        $enrollModel = new EnrollModel();

        $player = PlayerModel::find($playerSn);
        $player->doubleS = $enrollModel->getItemLevel($item = '前進雙足S型', $playerSn);
        $player->singleS = $enrollModel->getItemLevel($item = '前進單足S型', $playerSn);
        $player->cross   = $enrollModel->getItemLevel($item = '前進交叉型', $playerSn);
        $player->group   = $enrollModel->getGroup($playerSn);

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