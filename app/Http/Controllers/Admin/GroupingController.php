<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\GroupingService;

class GroupingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function grouping()
    {
        $groupingService = new GroupingService();
        $groupingService->grouping();
        $groupingService->createPlayerNumber();  //因延賽後又新增選手，為避免選手號碼錯亂，暫時註解

        app('request')->session()->flash('info', '場次編組成功');
        return back();
    }
}
