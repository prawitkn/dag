<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DagsProgramCourseTest extends Model
{
    protected $fillable = [
        'program_course_id', 'program_course_test_name', 'score', 'is_finished', 'status', 'created_at','created_by'
    ];
}
