<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use App\Models\EnrollModel;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    public function enrollPlayers()
    {
        return (object) [
            'doubleS' => app(EnrollModel::class)->getEnrollPlayers('前進雙足S型'),
            'singleS' => app(EnrollModel::class)->getEnrollPlayers('前進單足S型'),
            'cross'   => app(EnrollModel::class)->getEnrollPlayers('前進交叉型'),
        ];

        return view('admin/players')->with(compact('players'));
    }
}
