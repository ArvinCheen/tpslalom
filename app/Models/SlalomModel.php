<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlalomModel extends Model
{
    protected $table = 'slalom';

    protected $fillable = [
        'enroll_id',
        'round_one_second',
        'round_one_miss_conr',
        'round_two_second',
        'round_two_miss_conr',
        'final_result',
        'rank',
        'integral',
        'created_at',
        'updated_at',
    ];
}
