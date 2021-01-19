<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DagsProgramClass extends Model
{	
    protected $fillable = [
        'program_id'
        ,'program_id','course_hours','course_days','credit','program_class_name','program_class_qty'
        ,'confirm_title','confirm_full_name','confirm_position_abb'
        ,'approve_title','approve_full_name','approve_position_abb'
        , 'status', 'created_at','created_by'
    ];
}
