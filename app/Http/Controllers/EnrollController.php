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

        $now = strtotime(date('Y/m/d H:i:s'));
        if ($now >= strtotime($gameInfo->enroll_start_time) && $now <= strtotime($gameInfo->enroll_close_time)) {
            $status = true;
        } else {
            $status = false;
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
        $level           = $request->level;
        $enrollSpeedItem = $request->input('enrollSpeedItem', []);
        $enrollFreeItem  = $request->input('enrollFreeItem', []);
        $enrollItem = array_merge($enrollFreeItem,$enrollSpeedItem);

        if (is_null($enrollSpeedItem) && is_null($enrollFreeItem)) {
            Log::error("[EnrollController@enroll] 報名失敗", ['未選擇報名項目']);
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢']);
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

            foreach ($enrollItem as $Item) {
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $level,
                    'group'         => $group,
                    'item'          => $Item,
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

            $account = AccountModel::find(auth()->user()->id)->team_name;
            app(SlackNotify::class)->setMsg("```選手號碼：{$playerNumber} {$name}（{$account}） 報名成功```")->notify();
            DB::commit();

            return back()->with(['success' => '報名成功']);
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
            DB::rollback();
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢，如還是無法報名，請聯絡承辦人']);
        }
    }

    public function update(Request $request)
    {
        $playerId   = $request->playerId;
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

            PlayerModel::where('id', $playerId)->update([
                'name'   => $name,
                'agency' => $agency,
                'gender' => $gender,
                'city'   => $city,
            ]);

            $playerNumber = $this->getPlayerNumber($playerId);

            app(EnrollModel::class)->cancel($playerId);

            foreach ($enrollItem as $item) {
                EnrollModel::Create([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $level,
                    'group'         => $group,
                    'item'          => $item,
                ]);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => 600 + (app(EnrollModel::class)->getEnrollQuantity($playerId) * 100)]
            );

            $account = AccountModel::find(auth()->user()->id)->team_name;
            app(SlackNotify::class)->setMsg("```選手號碼：{$playerNumber} {$name}（{$account}） 報名成功```")->notify();
            DB::commit();
            return redirect('paymentInfo')->with(['success' => '修改報名成功']);
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
            DB::rollback();
            return back()->with(['error' => '修改報名失敗']);
        }
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
                EnrollModel::updateOrCreate([
                    'player_id'     => $playerId,
                    'game_id'       => config('app.game_id'),
                    'player_number' => $playerNumber,
                    'account_id'    => auth()->user()->id,
                    'level'         => $level,
                    'group'         => $group,
                    'item'          => $item,
                ]);
            }

            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => 600 + (app(EnrollModel::class)->getEnrollQuantity($playerId) * 100)]
            );

            $account = AccountModel::find(auth()->user()->id)->team_name;
            app(SlackNotify::class)->setMsg("```選手號碼：{$playerNumber} {$name}（{$account}） 報名成功```")->notify();
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
        $player          = PlayerModel::find($playerId);
        $player->doubleS = app(EnrollModel::class)->getItemLevel($playerId, '前進雙足S型');
        $player->singleS = app(EnrollModel::class)->getItemLevel($playerId, '前進單足S型');
        $player->cross   = app(EnrollModel::class)->getItemLevel($playerId, '前進交叉型');
        $player->group   = app(EnrollModel::class)->getGroup($playerId);
        $player->level   = app(EnrollModel::class)->getLevel($playerId);


        $gameInfo = GameModel::find(config('app.game_id'));

        $now          = strtotime(date('Y/m/d H:i:s'));
        $errataStatus = true;
        $enrollStatus = false;

        if ($now > strtotime($gameInfo->enroll_start_time) && $now < strtotime($gameInfo->enroll_close_time)) {
            $enrollStatus = true;
            $errataStatus = true;
        } else {
            if ($now >= strtotime($gameInfo->errata_close_time)) {
                $errataStatus = false;
            }
        }

        return view('enroll/edit')->with(compact('player', 'enrollStatus', 'errataStatus'));
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
