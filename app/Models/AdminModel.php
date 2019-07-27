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
class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $guarded = 'id';

    protected $hidden = ['password', 'remember_token'];

//    public function isAccountExist($account)
//    {
//        return $this->where('account', $account)->exists();
//    }
}










