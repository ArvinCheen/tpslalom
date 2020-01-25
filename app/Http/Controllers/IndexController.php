<?php
namespace App\Http\Controllers;

use App\Check;
use App\Http\Controllers\Controller as Controller;
use App\Students;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $checkStudents = app(Check::class)->with('students')->get();

        return view('index')->with(compact('checkStudents'));
    }
}
