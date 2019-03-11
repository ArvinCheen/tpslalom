<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Services\DocService;

class AllDocController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $allDocService = new DocService();
        $allDoc = $allDocService->getAllDoc();

        return view('admin/allDoc/index')->with(compact('allDoc'));
    }
}
