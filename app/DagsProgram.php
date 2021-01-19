<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DagsProgram extends Model
{
    protected $fillable = [
        'program_name'
        , 'status', 'created_at','created_by'
    ];
}
