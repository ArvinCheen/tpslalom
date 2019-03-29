<?php
namespace App\Services;

use App\Models\EnrollModel;
use App\Models\RegistryFeeModel;

class EnrollService
{
    public function enroll($request)
    {
        $playerService      = new PlayerService();
        $registryFeeService = new RegistryFeeService();

        $playerId = $request->playerSn == 'newPlayer' ? null : $request->playerSn;
        $name     = $request->name;
        $agency   = $request->agency;
        $gender   = $request->gender;
        $city     = $request->city;
        $group    = $request->group;
        $doubleS  = $request->doubleS;
        $singleS  = $request->singleS;
        $cross    = $request->cross;

        try {
            \DB::beginTransaction();

//            if(is_null($doubleS) && is_null($singleS) && is_null($cross)) {
            if(is_null($singleS)) {
                return false;
            } else {
                $player = $playerService->store($playerId, $name, $gender, $city, $agency);

                $playerId = $player->id;

                $this->store($playerId, $group, $doubleS, $singleS, $cross);

                $registryFeeService->calculation($playerId);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }

        return true;
    }

    private function store($playerId, $group, $doubleS, $singleS, $cross)
    {
        $enrollModel = new EnrollModel();

        $playerNumber = $this->getPlayerNumber($playerId);

        $enrollModel->cancel($playerId);

        // todo playerNumber之後拿掉，因為重新編組會在編組一次
        if (!is_null($doubleS)) {
            $enrollModel->store($playerId, $playerNumber, $group, $doubleS, $item = '前進雙足S型');
        }
        if (!is_null($singleS)) {
            $enrollModel->store($playerId, $playerNumber, $group, $singleS, $item = '前進單足S型');
        }
        if (!is_null($cross)) {
            $enrollModel->store($playerId, $playerNumber, $group, $cross, $item = '前進交叉型');
        }

        return true;
    }

    public function getPlayerNumber($playerId)
    {
        $enrollModel = new EnrollModel();

        if ($enrollModel->isPlayerExists($playerId)) {
            return $enrollModel->getPlayerNumber($playerId);
        } else {
            return $enrollModel->getNewPlayerNumber();
        }
    }

    public function getPlayer($playerId)
    {
        $playerService = new PlayerService();

        return $playerService->getPlayerWithEnrollInfo($playerId);
    }

    public function cancel($playerId)
    {
        $enrollModel      = new EnrollModel();
        $registryFeeModel = new RegistryFeeModel();

        try {
            \DB::disableQueryLog();
            \DB::beginTransaction();

            $enrollModel->cancel($playerId);
            $registryFeeModel->deleteRegistryFee($playerId);

            \DB::commit();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
