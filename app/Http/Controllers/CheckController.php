<?php

namespace App\Http\Controllers;

use App\Check;
use App\Http\Controllers\Controller as Controller;
use App\Students;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function check(Request $request)
    {
        if (! app(Students::class)->find($request->studentId)) {
            return back();
        }

        app(Check::class)->updateOrCreate(['student_id' => $request->studentId]);

        return back();
    }
}
