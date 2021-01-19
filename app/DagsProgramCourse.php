<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DagsProgramCourse extends Model
{
    protected $fillable = [
        'program_id'
        ,'course_hierarchy','course_hierarchy','course_no','course_name','course_description','course_hours'
        ,'credit','is_calc','score'
        , 'status', 'created_at','created_by'
    ];
}