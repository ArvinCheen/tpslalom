<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'account';

    protected $primaryKey = 'accountSn';

    protected $fillable = ['accountId', 'password', 'email', 'teamName', 'phone', 'address', 'coach', 'leader', 'management'];

    public $timestamps = true;

    const CREATED_AT = 'createTime';

    const UPDATED_AT = 'updateTime';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAccountExist($accountId)
    {
        return $this->where('accountId', $accountId)->exists();
    }
}
