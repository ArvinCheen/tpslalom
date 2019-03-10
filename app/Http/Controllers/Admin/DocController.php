<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\EnrollModel;
use App\Services\DocService;
//use App\Model\RegistryFeeModel;
//use DB;
//use Excel;

class DocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allDoc()
    {
        $docService = new DocService();
        $allDoc = $docService->getAllDoc();

        return view('admin/doc/allDoc')->with(compact('allDoc'));
    }

    public function groupsInfo()
    {
        $docService = new DocService();
        $groupsInfo = $docService->getGroupsInfo();

        return view('admin/doc/groupsInfo')->with(compact('groupsInfo'));
    }

    public function teamsInfo()
    {
        $docService = new DocService();
        $teamsInfo = $docService->getTeamsInfo();

        return view('admin/doc/teamsInfo')->with(compact('teamsInfo'));
    }

    public function checkBill()
    {
        $docService = new DocService();

        $bills = $docService->getBills();

        $total = $bills->sum('totalFee');

        return view('admin/doc/checkBill')->with(compact('bills', 'total'));
    }

    public function medals()
    {
        $enrollModel = new EnrollModel();

        $medalData = $enrollModel->getMedalQuantity();

        $goldTotal   = 0;
        $silverTotal = 0;
        $copperTotal = 0;

        foreach ($medalData as $val) {
            if ($val->level == '選手組') {
                $val->city   = '不分縣';
            } else {
                $val->city   = $val->city == '臺北市' ? '臺北市' : '外縣市';
            }
            $val->gold   = 1;
            $val->silver = $val->quantity >= 2 ? 1 : 0;
            $val->copper = $val->quantity >= 3 ? 1 : 0;

            $goldTotal   += $val->gold;
            $silverTotal += $val->silver;
            $copperTotal += $val->copper;
        }

        return view('admin/doc/medal')
            ->with('medalData', $medalData)
            ->with('goldTotal', $goldTotal)
            ->with('silverTotal', $silverTotal)
            ->with('copperTotal', $copperTotal);
    }

    public function playersInfo()
    {
        $docService = new DocService();

        $players = $docService->getEnrollPlayers();

        return view('admin/doc/playersInfo')->with(compact('players'));
    }
}
