<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\AccountModel
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccountModel query()
 * @mixin \Eloquent
 */
class AccountModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'account';

    protected $guarded = ['id'];

    protected $hidden = ['password', 'remember_token'];

    public function isAccountExist($account)
    {
        return $this->where('account', $account)->exists();
    }
}










