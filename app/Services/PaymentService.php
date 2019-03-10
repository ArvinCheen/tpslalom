<?php
namespace App\Services;

use App\Models\RegistryFeeModel;
use App\Models\EnrollModel;

class PaymentService
{
    public function getPaymentInfo()
    {
        $registryFeeModel = new RegistryFeeModel();

        $paymentInfo = $registryFeeModel->getCart();

        foreach ($paymentInfo as $val) {
            $val->item = $this->assembleItem($val->playerSn);
        }

        return $paymentInfo;
    }

    private function assembleItem($playerSn)
    {
        $enrollModel = new EnrollModel();

        $items = $enrollModel->getPlayerEnrollItem($playerSn);

        $item = null;

        foreach ($items as $val) {
            $item .= $val->item . '（' . $val->level . '） / ';
        }

        return substr($item, 0, -3);
    }

    public function getTotal()
    {
        $registryFeeModel = new RegistryFeeModel();

        return $registryFeeModel->getTotal();
    }
}