<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\RegistryFeeModel;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentInfo = app(RegistryFeeModel::class)->getCart();

        foreach ($paymentInfo as $payment) {
            $payment->item = $this->assembleItem($payment->player_id);
        }

        $total = number_format(app(RegistryFeeModel::class)->getTotal());

        return view('paymentInfo/index')->with(compact('paymentInfo', 'total'));
    }

    private function assembleItem($playerId)
    {
        $items = app(EnrollModel::class)->getPlayerEnrollItem($playerId);

        $itemView = null;

        foreach ($items as $item) {
            if ($item->item == '初級指定套路') {
                $itemView .= $item->item . ' ' . $item->sound . ' / ';
            } else if($item->item == '中級指定套路') {
                $itemView .= $item->item . ' / ';
            } else {
                $itemView .= $item->level . ' ' . $item->item . ' / ';
            }
        }

        return substr($itemView, 0, -3);
    }
}
