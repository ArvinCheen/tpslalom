<?php
namespace App\Services;

use App\Models\RegistryFeeModel;

class BillService
{
    public function getBills()
    {
        $registryFeeModel = new RegistryFeeModel();

        return $registryFeeModel->getBills();
    }
}
