<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use App\Services\RegistryFeeService;
use Illuminate\Http\Request;
use App\Services\EnrollService;
use App\Services\PlayerService;

class EnrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $playerService = new PlayerService();
        $playerList    = $playerService->getPlayers();

        return view('enroll/index')
            ->with('playerList', $playerList);
    }

    public function enroll(Request $request)
    {
        $playerService      = new PlayerService();
        $registryFeeService = new RegistryFeeService();

        $playerSn = $request->playerSn == 'newPlayer' ? null : $request->playerSn;
        $name     = $request->name;
        $agency   = $request->agency;
        $gender   = $request->gender;
        $city     = $request->city;
        $group    = $request->group;
        $doubleS  = $request->doubleS;
        $singleS  = $request->singleS;
        $cross    = $request->cross;
        $cross    = $request->cross;
        $enrollItem = $request->enrollItem;

        try {
            \DB::beginTransaction();

            $playerSn = app(PlayerModel::class)->updateOrCreate(['playerSn' => $playerSn], [
                'accountId' => auth()->user()->accountId,
                'name'      => $name,
                'gender'    => $gender,
                'city'      => $city,
                'agency'    => $agency,
            ])->playerSn;

            $this->store($playerSn, $group, $enrollItem);

            app(RegistryFeeModel::class)::updateOrCreate(
                ['gameSn' => config('app.gameSn'), 'accountId' => auth()->user()->accountId, 'playerSn' => $playerSn],
                ['gameSn' => config('app.gameSn'), 'accountId' => auth()->user()->accountId, 'playerSn' => $playerSn, 'fee' => 500 + (app(EnrollModel::class)->getEnrollQuantity($playerSn) * 100)]
            );

            $request->session()->flash('success', '報名成功');
            \DB::commit();

        } catch (\Exception $e) {
            $request->session()->flash('error', '報名失敗');
            \DB::rollback();
        }

        return back();
    }


    private function store($playerSn, $group, $doubleS, $singleS, $cross)
    {
        $enrollModel = new EnrollModel();

        $playerNumber = $this->getPlayerNumber($playerSn);

        $enrollModel->cancel($playerSn);

        // todo playerNumber之後拿掉，因為重新編組會在編組一次
        if (!is_null($doubleS)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $doubleS, $item = '前進雙足S型');
        }
        if (!is_null($singleS)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $singleS, $item = '前進單足S型');
        }
        if (!is_null($cross)) {
            $enrollModel->store($playerSn, $playerNumber, $group, $cross, $item = '前進交叉型');
        }

        return true;
    }

    public function edit($playerSn)
    {
        $enrollService = new EnrollService();
        $player    = $enrollService->getPlayer($playerSn);

        return view('enroll/edit')->with(compact('player'));
    }

    public function update(Request $request)
    {
        $enrollService = new EnrollService();

        if ($enrollService->enroll($request)) {
            $request->session()->flash('success', '修改報名成功');
        } else {
            $request->session()->flash('error', '修改報名失敗');
            return back();
        }

        return redirect('paymentInfo');
    }

    public function cancel(Request $request)
    {
        $enrollService = new EnrollService();

        if ($enrollService->cancel($request->playerSn)) {
            app('request')->session()->flash('warning', '取消報名成功');
        } else {
            app('request')->session()->flash('error', '取消報名失敗');
        }

        return redirect('paymentInfo');
    }
}
