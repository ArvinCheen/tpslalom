<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller as Controller;
use App\Models\PlayerModel;
use Illuminate\Http\Request;
use App\Models\ScheduleModel;
use App\Models\EnrollModel;
use App\Models\GameModel;
use App\Models\AccountModel;
use App\Services\ResultService;
use Excel;
use Storage;
use Spatie\MediaLibrary\MediaStream;

class MusicsController extends Controller
{
    public function index()
    {
        $musics = EnrollModel::where('game_id',config('app.game_id'))->where('sound','not like','%曲目%')->whereNotNull('sound')->get();

        return view('admin.musics',compact('musics'));
    }

    public function download($filename)
    {
        return Storage::download('flower_sound/' . $filename);
    }
}
