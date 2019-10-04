<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'emp_id', 'reason','total_days','dates_of_leave','paid', 'emp_name'
    ];
    //
}
