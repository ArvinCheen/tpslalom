<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\RegisterService;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function index()
    {
        \Auth::logout();
        return view('auth/register');
    }

    public function register(Request $request)
    {
        $registerService = new RegisterService();

        $accountId  = $request->accountId;
        $email      = $request->email;
        $teamName   = $request->teamName;
        $phone      = $request->phone;
        $coach      = $request->coach;

        if ($accountId == '' || $email == '' || $teamName == '' || $phone == '' || $coach == '') {
            $request->session()->flash('error', '請輸入必填欄位');
            return false;
        }

        if ($registerService->register($request)) {
            \Auth::attempt(['accountId' => $request->accountId, 'password' => $request->password], true);
            $request->session()->flash('success', '註冊成功');
            return redirect('/');
        } else {
            return back()->withInput();
        }
    }
}
