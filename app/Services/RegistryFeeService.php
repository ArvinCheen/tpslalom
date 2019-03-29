<?php
namespace App\Services;

use App\Models\EnrollModel;
use App\Models\RegistryFeeModel;

class RegistryFeeService
{
    public function calculation($playerId)
    {
        $enrollModel      = new EnrollModel();
        $registryFeeModel = new RegistryFeeModel();

        $enrollCount = $enrollModel->getEnrollQuantity($playerId);

        return $registryFeeModel->store($playerId, $enrollCount);
    }
}
