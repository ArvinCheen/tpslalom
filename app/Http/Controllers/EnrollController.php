<?php

namespace App\Http\Controllers;

use App\Helpers\SlackNotify;
use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\PlayerModel;
use App\Models\RegistryFeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class EnrollController extends Controller
{
    public function index($playerId = null)
    {
        $players  = app(PlayerModel::class)::where('account_id', auth()->user()->id)->orderByDesc('id')->get();
        $level    = null;
        $enrolls  = [];
        $gameInfo = GameModel::find(config('app.game_id'));

        if ($gameInfo->is_open_enroll) {
            $status = true;
        } else {
            $status = false;
        }

        if (! is_null($playerId)) {
            $level   = EnrollModel::where('player_id', $playerId)->where('level', '<>', '')->value('level');
            $enrolls = EnrollModel::where('player_id', $playerId)->get();
        }

        return view('enroll.index', compact('players', 'status', 'playerId', 'level', 'enrolls'));
    }

    public function enroll(Request $request)
    {
        if (! $this->store($request)) {
            return back()->with(['error' => '報名失敗，請確定欄位都填寫完畢']);
        }

        return redirect('paymentInfo')->with(['success' => '報名成功']);;
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
        $level      = $request->level;
        $group      = $request->group;
        $enrollItem = $request->enrollItem;
        $flowerItem = $request->flowerItem;
        $sound      = $request->sound;


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

            if ($enrollItem) {
                foreach ($enrollItem as $item) {
                    EnrollModel::create([
                        'game_id'    => config('app.game_id'),
                        'player_id'  => $playerId,
                        'account_id' => auth()->user()->id,
                        'level'      => $level,
                        'group'      => $group,
                        'gender'     => $gender,
                        'item'       => $item,
                    ]);
                }
            }

//            if ($flowerItem == '中級指定套路' && $request->hasFile('soundFile')) {
//                $soundName = $this->getFlowerGroup($group) . '-' . $flowerItem . '-' . $name . '.mp3';
//                Storage::put('flower_sound/' . $soundName, $request->file('soundFile')->get());
//                EnrollModel::create([
//                    'game_id'    => config('app.game_id'),
//                    'player_id'  => $playerId,
//                    'account_id' => auth()->user()->id,
//                    'group'      => $group,
//                    'group2'     => $this->getFlowerGroup($group),
//                    'item'       => $flowerItem,
//                    'gender'     => $gender,
//                    'sound'      => $soundName,
//                ]);
//            }
//            if ($flowerItem == '初級指定套路') {
//                EnrollModel::create([
//                    'game_id'    => config('app.game_id'),
//                    'player_id'  => $playerId,
//                    'account_id' => auth()->user()->id,
//                    'group'      => $group,
//                    'group2'     => $this->getFlowerGroup($group),
//                    'item'       => $flowerItem,
//                    'gender'     => $gender,
//                    'sound'      => $sound == null ? '未選曲目' : $sound,
//                ]);
//            }


            app(RegistryFeeModel::class)::updateOrCreate(
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId],
                ['game_id' => config('app.game_id'), 'account_id' => auth()->user()->id, 'player_id' => $playerId, 'fee' => $this->calculationFee($enrollItem, $flowerItem)]
            );

            $account = AccountModel::find(auth()->user()->id)->team_name;
            app(SlackNotify::class)->setMsg("```選手： {$name}（{$account}） 報名成功```")->notify();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            app()->make(SlackNotify::class)->setMsg('[EnrollController@store] Error ' . $e->getMessage())->notify();
            DB::rollback();
            return false;
        }
    }

    private function getFlowerGroup($group)
    {
        switch ($group) {
            case '國小一年級':
                return '國小低年級';
                break;
            case '國小二年級':
                return '國小低年級';
                break;
            case '國小三年級':
                return '國小中年級';
                break;
            case '國小四年級':
                return '國小中年級';
                break;
            case '國小五年級':
                return '國小高年級';
                break;
            case '國小六年級':
                return '國小高年級';
                break;
            default:
                return $group;
                break;
        }
    }

    private function calculationFee($enrollItem, $flowerItem)
    {
        $fee = 0;

        if ($enrollItem) {
            $fee += count($enrollItem) * 100 + 400;
        }

        if ($flowerItem) {
            $fee += 400;
        }

        return $fee;

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
