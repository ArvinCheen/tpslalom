<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
//use App\Model\EnrollModel;
//use App\Model\ScheduleModel;
//use App\Services\ResultService;
//use App\Services\GameService;

class DashboardController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin/dashboard');
    }
}
