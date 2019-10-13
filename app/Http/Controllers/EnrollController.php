<?php

namespace App\Http\Controllers;

use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use App\Services\RegistryFeeService;
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

        $gameInfo = GameModel::find(config('app.game_id'));

        $status = false;

        $now = strtotime(date('Y/m/d H:i:s'));
        if ($now <= strtotime($gameInfo->enroll_close_time) && $now >= strtotime($gameInfo->enroll_start_time)) {
            $status = true;
        }

        return view('enroll/index', compact('players', 'status'));
    }

    public function enroll(Request $request)
    {
        $playerId        = $request->playerId == 'newPlayer' ? null : $request->playerId;
        $name            = $request->name;
        $agency          = $request->agency;
        $gender          = $request->gender;
        $city            = $request->city;
        $group           = $request->group;
        $freeLevel       = $request->freeLevel;
        $speedLevel      = $request->speedLevel;
        $action          = $request->action;
        $enrollFreeItem  = $request->input('enrollFreeItem', []);
        $enrollSpeedItem = $request->input('enrollSpeedItem', []);

        if (empty($enrollFreeItem) & empty($enrollSpeedItem)) {
            Log::error("[EnrollController@enroll] 報名失敗", ['未選擇報名項目']);
            return back()->with(['error' => '報名失敗，請選擇報名項目']);
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

            $playerNumber = $this->getPlayerNumber($playerId);
            app(EnrollModel::class)->cancel($playerId);

            foreach ($enrollFreeItem as $freeItem) {
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $freeLevel,
                    'group'         => $group,
                    'item'          => $freeItem,
                ]);
            }

            foreach ($enrollSpeedItem as $speedItem) {
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $speedLevel,
                    'group'         => $group,
                    'item'          => $speedItem,
                ]);
            }

            $enrollFee = 0;

            if (count($enrollSpeedItem) <> 0) {
                $enrollFee += 300 + ((count($enrollSpeedItem) - 1) * 100);
            }

            if (count($enrollFreeItem) <> 0) {
                $enrollFee += 300 + ((count($enrollFreeItem) - 1) * 100);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => $enrollFee]
            );

            $account  = AccountModel::find(auth()->user()->id)->team_name;
            $totalFee = app(RegistryFeeModel::class)->getTotal();

            $enrollItem = array_merge($enrollFreeItem, $enrollSpeedItem);
            app(SlackNotify::class)->setMsg("```選手號碼：{$playerNumber} {$name}({$account}) " . $action . "\n比賽項目：" . implode(", ", $enrollItem) . " \n目前比賽經費：" . number_format($totalFee) . "元```")->notify();
            DB::commit();

            return back()->with(['success' => $action . '成功']);
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
            DB::rollback();
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢，如還是無法報名，請聯絡承辦人']);
        }
    }

    public function edit($playerId)
    {
        $players = app(PlayerModel::class)::where('account_id', auth()->user()->id)->orderByDesc('id')->get();

        $gameInfo = GameModel::find(config('app.game_id'));

        $now    = strtotime(date('Y/m/d H:i:s'));
        $status = false;

        if ($now <= strtotime($gameInfo->enroll_close_time && $now >= strtotime($gameInfo->enroll_start_time))) {
            $status = true;
        } else {
            if ($now <= strtotime($gameInfo->errata_close_time)) {
                $status = true;
            }
        }

        return view('enroll/edit')->with(compact('playerId', 'players', 'status'));
    }

    public function update(Request $request)
    {
        $playerId        = $request->playerId == 'newPlayer' ? null : $request->playerId;
        $name            = $request->name;
        $agency          = $request->agency;
        $gender          = $request->gender;
        $city            = $request->city;
        $group           = $request->group;
        $freeLevel       = $request->freeLevel;
        $speedLevel      = $request->speedLevel;
        $enrollFreeItem  = $request->input('enrollFreeItem', []);
        $enrollSpeedItem = $request->input('enrollSpeedItem', []);

        if (empty($enrollFreeItem) & empty($enrollSpeedItem)) {
            Log::error("[EnrollController@enroll] 報名失敗", ['未選擇報名項目']);
            return back()->with(['error' => '報名失敗，請選擇報名項目']);
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

//            這裡應該是直接帶入，不取消，用更新的方式，或許可以共同修改報名功能
            app(EnrollModel::class)->cancel($playerId);

            $playerNumber = $this->getPlayerNumber($playerId);

            foreach ($enrollFreeItem as $freeItem) {
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $freeLevel,
                    'group'         => $group,
                    'item'          => $freeItem,
                ]);
            }

            foreach ($enrollSpeedItem as $speedItem) {
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $speedLevel,
                    'group'         => $group,
                    'item'          => $speedItem,
                ]);
            }

            $enrollFee = 0;

            if (count($enrollSpeedItem) <> 0) {
                $enrollFee += 300 + ((count($enrollSpeedItem) - 1) * 100);
            }

            if (count($enrollFreeItem) <> 0) {
                $enrollFee += 300 + ((count($enrollFreeItem) - 1) * 100);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => $enrollFee]
            );

            $account  = AccountModel::find(auth()->user()->id)->team_name;
            $totalFee = app(RegistryFeeModel::class)->getTotal();

            $enrollItem = array_merge($enrollFreeItem, $enrollSpeedItem);
            app(SlackNotify::class)->setMsg("```選手號碼：{$playerNumber} {$name} - {$account} 參賽\n比賽項目：" . implode(", ", $enrollItem) . " \n目前比賽經費：" . number_format($totalFee) . "元```")->notify();
            DB::commit();

            return back()->with(['success' => '報名成功']);
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
            DB::rollback();
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢，如還是無法報名，請聯絡承辦人']);
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

    public function cancel(Request $request)
    {
        try {
            DB::beginTransaction();

            $playerId = $request->playerId;

            $playerNumber = app(EnrollModel::class)->getPlayerNumber($playerId);
            $playerName   = app(PlayerModel::class)->find($playerId)->name;

            app(EnrollModel::class)->cancel($playerId);
            app(RegistryFeeModel::class)->deleteRegistryFee($playerId);


            $totalFee = app(RegistryFeeModel::class)->getTotal();

            app(SlackNotify::class)->setMsg('```'.$playerName . '(' . $playerNumber . ') 取消參賽'. " \n目前比賽經費：" . number_format($totalFee) . '元```')->notify();


            DB::commit();
            return redirect('paymentInfo')->with(['warning' => $playerName . '(' . $playerNumber . ') 取消參賽']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error("[EnrollController@cancel] 取消報名失敗", [$e->getMessage()]);
            return redirect('paymentInfo')->with(['error' => '取消報名失敗']);
        }
    }
}
