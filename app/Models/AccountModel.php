<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'account';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAccountExist($accountId)
    {
        return $this->where('account_id', $accountId)->exists();
    }
}
