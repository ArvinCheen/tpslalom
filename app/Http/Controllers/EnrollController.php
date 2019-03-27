<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use App\Services\RegistryFeeService;
use App\Services\SlackNotify;
use Illuminate\Http\Request;
use App\Services\EnrollService;
use App\Services\PlayerService;
use Illuminate\Notifications\Messages\SlackMessage;
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
            return back()->with(['error' => '報名失敗']);
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
                'account_id' => auth()->user()->id,
                'name'       => $name,
                'gender'     => $gender,
                'city'       => $city,
                'agency'     => $agency,
            ])->id;

            app(EnrollModel::class)->cancel($playerId);

            $playerNumber = $this->getPlayerNumber($playerId);

            foreach ($enrollItem as $item) {
                EnrollModel::create([
                    'game_id'       => config('app.game_id'),
                    'player_id'     => $playerId,
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $level,
                    'group'         => $group,
                    'item'          => $item,
                ]);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => 500 + (app(EnrollModel::class)->getEnrollQuantity($playerId) * 100)]
            );

            app()->make(SlackNotify::class)->setMsg("報名成功：{$name} - {$playerId}")->notify();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
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
        $player               = PlayerModel::find($playerId);
        $player->doubleS      = app(EnrollModel::class)->getItemLevel($playerId, '前進雙足S型');
        $player->singleS      = app(EnrollModel::class)->getItemLevel($playerId, '前進單足S型');
        $player->cross        = app(EnrollModel::class)->getItemLevel($playerId, '前進交叉型');
        $player->group        = app(EnrollModel::class)->getGroup($playerId);
        $player->level        = app(EnrollModel::class)->getLevel($playerId);

        return view('enroll/edit')->with(compact('player'));
    }

    public function cancel(Request $request)
    {
        try {
            DB::beginTransaction();

            app(EnrollModel::class)->cancel($request->playerId);
            app(RegistryFeeModel::class)->deleteRegistryFee($request->playerId);

            DB::commit();

            app(SlackNotify::class)->setMsg('有人取消報名')->notify();
            return redirect('paymentInfo')->with(['warning' => '取消報名成功']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error("[EnrollController@cancel] 取消報名失敗", [$e->getMessage()]);
            return redirect('paymentInfo')->with(['error' => '取消報名失敗']);
        }
    }
}
