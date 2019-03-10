<?php
namespace App\Services;

use App\Models\EnrollModel;
use App\Models\RegistryFeeModel;

class RegistryFeeService
{
    public function calculation($playerSn)
    {
        $enrollModel      = new EnrollModel();
        $registryFeeModel = new RegistryFeeModel();

        $enrollCount = $enrollModel->getEnrollQuantity($playerSn);

        return $registryFeeModel->store($playerSn, $enrollCount);
    }
}
