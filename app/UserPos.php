<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPos extends Model
{    
    protected $fillable = [
        'user_id', 'group_id', 'branch_id', 'created_by'
    ];
}
