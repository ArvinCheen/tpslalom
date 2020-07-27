<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnrollModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EnrollModel query()
 * @mixin \Eloquent
 */
class AgencyModel extends Model
{
    protected $table = 'agency';

    protected $fillable = ['agency', 'agency_short'];

}
