<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\RegistryFeeModel;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $paymentInfo = app(RegistryFeeModel::class)->getCart();

        foreach ($paymentInfo as $payment) {
            $payment->item = $this->assembleItem($payment->player_number);
        }

        $total = number_format(app(RegistryFeeModel::class)->getTotal());

        return  view('paymentInfo/index')->with(compact('paymentInfo', 'total'));
    }

    private function assembleItem($playerNumber)
    {
        $items = app(EnrollModel::class)->getPlayerEnrollItem($playerNumber);

        $itemView = null;

        foreach ($items as $item) {
            $itemView .= $item->item . '（' . $item->level . '） / ';
        }

        return substr($itemView, 0, -3);
    }
}
