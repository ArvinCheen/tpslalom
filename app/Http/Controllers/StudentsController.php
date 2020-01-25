<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        $students = app(Students::class)->get();

        return view('students')->with(compact('students'));
    }

    public function add(Request $request)
    {
        app(Students::class)->create(['name' => $request->name]);

        return back();
    }
}
