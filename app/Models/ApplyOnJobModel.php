<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyOnJobModel extends Model
{
    protected $table = 'apply_on_job';

    public function scopeGetJobApplication($query,$job_id,$seeker_id){
        return $query->where('job_id',$job_id)->where('seeker_id',$seeker_id);
    }
}
