<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{

    protected $table = 'check';

    protected $guarded = ['id'];

    public function students()
    {
        return $this->hasOne('App\Students', 'id', 'student_id');
    }
}
