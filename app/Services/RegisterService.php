<?php
namespace App\Services;

use App\Models\AccountModel;

class RegisterService
{
    public function register($request)
    {
        $accountModel = new AccountModel();

        $accountId  = $request->accountId;
        $password   = $request->password;
        $email      = $request->email;
        $teamName   = $request->teamName;
        $phone      = $request->phone;
        $coach      = $request->coach;
        $leader     = $request->leader;
        $management = $request->management;
        $address    = $request->address;

        if ($accountModel->isAccountExist($accountId)) {
            $request->session()->flash('error', '帳號重覆');
            return false;
        } else {
            $insertData = [
                'accountId'  => $accountId,
                'password'   => bcrypt($password),
                'email'      => $email,
                'teamName'   => $teamName,
                'phone'      => $phone,
                'coach'      => $coach,
                'leader'     => $leader,
                'management' => $management,
                'address'    => $address,
            ];

            return AccountModel::create($insertData);
        }
    }

}
