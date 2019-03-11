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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        return view('enroll/index', compact('playerList'));
    }

    public function enroll(Request $request)
    {
        $this->store($request);

        return back();
    }

    public function update(Request $request)
    {
        if (! $this->store($request)) {
            return back();
        }

        return redirect('paymentInfo');
    }

    private function store($request)
    {
        $playerSn   = $request->playerSn == 'newPlayer' ? null : $request->playerSn;
        $name       = $request->name;
        $agency     = $request->agency;
        $gender     = $request->gender;
        $city       = $request->city;
        $group      = $request->group;
        $level      = $request->level;
        $enrollItem = $request->enrollItem;

        if (is_null($enrollItem)) {
            Log::error("[EnrollController@enroll] 報名失敗", ['未選擇報名項目']);
            $request->session()->flash('error', '報名失敗，請確定欄位都填寫完畢');

            return false;
        }

        try {
            DB::beginTransaction();

            $playerSn = app(PlayerModel::class)->updateOrCreate(['playerSn' => $playerSn], [
                'accountId' => auth()->user()->accountId,
                'name'      => $name,
                'gender'    => $gender,
                'city'      => $city,
                'agency'    => $agency,
            ])->playerSn;

            $playerNumber = $this->getPlayerNumber($playerSn);

            app(EnrollModel::class)->cancel($playerSn);

            foreach ($enrollItem as $item) {
                app(EnrollModel::class)->store($playerSn, $playerNumber, $group, $level, $item);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['gameSn' => config('app.gameSn'), 'accountId' => auth()->user()->accountId, 'playerSn' => $playerSn],
                ['gameSn' => config('app.gameSn'), 'accountId' => auth()->user()->accountId, 'playerSn' => $playerSn, 'fee' => 500 + (app(EnrollModel::class)->getEnrollQuantity($playerSn) * 100)]
            );

            $request->session()->flash('info', '報名成功');

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Log::error("[EnrollController@enroll] 報名失敗", [$e->getMessage()]);

            $request->session()->flash('error', '報名失敗，請確定欄位都填寫完畢');

            DB::rollback();

            return false;
        }
    }

    private function getPlayerNumber($playerSn)
    {
        $enrollModel = new EnrollModel();

        if ($enrollModel->isPlayerExists($playerSn)) {
            return $enrollModel->getPlayerNumber($playerSn);
        } else {
            return $enrollModel->getNewPlayerNumber();
        }
    }

    public function edit($playerSn)
    {
        $enrollModel = new EnrollModel();

        $player          = PlayerModel::find($playerSn);
        $player->doubleS = $enrollModel->getItemLevel($item = '前進雙足S型', $playerSn);
        $player->singleS = $enrollModel->getItemLevel($item = '前進單足S型', $playerSn);
        $player->cross   = $enrollModel->getItemLevel($item = '前進交叉型', $playerSn);
        $player->group   = $enrollModel->getGroup($playerSn);
        $player->level   = $enrollModel->getLevel($playerSn);

        return view('enroll/edit')->with(compact('player'));
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
