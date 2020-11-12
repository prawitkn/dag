<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OssServiceData extends Model
{
    protected $fillable = [
        'issue_date', 'service_type_id', 'service_topic_id', 'remark', 'created_by'
    ];
}
