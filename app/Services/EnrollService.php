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

        $playerSn = $request->playerSn == 'newPlayer' ? null : $request->playerSn;
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
                $player = $playerService->store($playerSn, $name, $gender, $city, $agency);

                $playerSn = $player->id;

                $this->store($playerSn, $group, $doubleS, $singleS, $cross);

                $registryFeeService->calculation($playerSn);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }

        return true;
    }

    private function store($playerSn, $group, $doubleS, $singleS, $cross)
    {
        $enrollModel = new EnrollModel();

        $playerNumber = $this->getPlayerNumber($playerSn);

        $enrollModel->cancel($playerSn);

        // todo playerNumber之後拿掉，因為重新編組會在編組一次
        if (!is_null($doubleS)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $doubleS, $item = '前進雙足S型');
        }
        if (!is_null($singleS)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $singleS, $item = '前進單足S型');
        }
        if (!is_null($cross)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $cross, $item = '前進交叉型');
        }

        return true;
    }

    public function getPlayerNumber($playerSn)
    {
        $enrollModel = new EnrollModel();

        if ($enrollModel->isPlayerExists($playerSn)) {
            return $enrollModel->getPlayerNumber($playerSn);
        } else {
            return $enrollModel->getNewPlayerNumber();
        }
    }

    public function getPlayer($playerSn)
    {
        $playerService = new PlayerService();

        return $playerService->getPlayerWithEnrollInfo($playerSn);
    }

    public function cancel($playerSn)
    {
        $enrollModel      = new EnrollModel();
        $registryFeeModel = new RegistryFeeModel();

        try {
            \DB::disableQueryLog();
            \DB::beginTransaction();

            $enrollModel->cancel($playerSn);
            $registryFeeModel->deleteRegistryFee($playerSn);

            \DB::commit();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
