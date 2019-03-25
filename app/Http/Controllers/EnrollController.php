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
    public function index()
    {
        $players = app(PlayerModel::class)::where('account_id', auth()->user()->id)->orderByDesc('id')->get();

        return view('enroll/index', compact('players'));
    }

    public function enroll(Request $request)
    {
        if (! $this->store($request)) {
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢']);
        }

        return back()->with(['success' => '報名成功']);
    }

    public function update(Request $request)
    {
        if (! $this->store($request)) {
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢']);
        }

        return redirect('paymentInfo')->with(['success' => '報名成功']);
    }

    private function store($request)
    {
        $playerId   = $request->playerId == 'newPlayer' ? null : $request->playerId;
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

            $playerId = app(PlayerModel::class)->updateOrCreate(['id' => $playerId], [
                'accountId' => auth()->user()->id,
                'name'      => $name,
                'gender'    => $gender,
                'city'      => $city,
                'agency'    => $agency,
            ])->id;

            app(EnrollModel::class)->cancel($playerId);

            $playerNumber = $this->getPlayerNumber($playerId);

            foreach ($enrollItem as $item) {
                app(EnrollModel::class)->store($playerId, $playerNumber, $group, $level, $item);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['gameSn' => config('app.gameSn'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['gameSn' => config('app.gameSn'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => 500 + (app(EnrollModel::class)->getEnrollQuantity($playerId) * 100)]
            );

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Log::error("[EnrollController@enroll] 報名失敗", [$e->getMessage()]);
            DB::rollback();

            return false;
        }
    }

    private function getPlayerNumber($playerId)
    {
        $enrollModel = new EnrollModel();

        if ($enrollModel->isPlayerExists($playerId)) {
            return $enrollModel->getPlayerNumber($playerId);
        } else {
            return $enrollModel->getNewPlayerNumber();
        }
    }

    public function edit($playerId)
    {
        $enrollModel = new EnrollModel();

        $player          = PlayerModel::find($playerId);
        $player->doubleS = $enrollModel->getItemLevel($item = '前進雙足S型', $playerId);
        $player->singleS = $enrollModel->getItemLevel($item = '前進單足S型', $playerId);
        $player->cross   = $enrollModel->getItemLevel($item = '前進交叉型', $playerId);
        $player->group   = $enrollModel->getGroup($playerId);
        $player->level   = $enrollModel->getLevel($playerId);

        return view('enroll/edit')->with(compact('player'));
    }

    public function cancel(Request $request)
    {
        $enrollService = new EnrollService();

        if ($enrollService->cancel($request->playerId)) {
            app('request')->session()->flash('warning', '取消報名成功');
        } else {
            app('request')->session()->flash('error', '取消報名失敗');
        }

        return redirect('paymentInfo');
    }
}
