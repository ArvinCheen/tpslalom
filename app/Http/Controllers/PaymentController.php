<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $paymentService = new PaymentService();

        $cart  = $paymentService->getPaymentInfo();
        $total = number_format($paymentService->getTotal());

        return  view('paymentInfo/index')
            ->with(compact('cart'))
            ->with(compact('total'));
    }
}
