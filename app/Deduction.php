<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = [
        'emp_id', 'SSS', 'PHIC', 'PAG_IBIG'
    ];
}
