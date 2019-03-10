<?php
namespace App\Services;

use App\Models\AccountModel;

class AccountService
{
    public function getAccount()
    {
        $accountSn = app('request')->user()->accountSn;

        return AccountModel::find($accountSn);
    }

    public function update($request)
    {
        try {
            \DB::disableQueryLog();
            \DB::beginTransaction();

            AccountModel::where('accountSn', $request->accountSn)->update([
                'email'      => $request->email,
                'teamName'   => $request->teamName,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'coach'      => $request->coach,
                'leader'     => $request->leader,
                'management' => $request->management,
            ]);

            \DB::commit();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}
