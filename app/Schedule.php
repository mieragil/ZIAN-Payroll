<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'emp_id','dayoff','req_in','req_out'
    ];
}
