<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\BillService;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $billService = new BillService();

        $bills = $billService->getBills();

        $total = $bills->sum('totalFee');

        return view('admin/bill/index')->with(compact('bills', 'total'));
    }
}
