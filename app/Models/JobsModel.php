<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobsModel extends Model
{
    protected $table = 'jobs';

    public function scopeProfileMatchedJobs($query,$qualification,$location,$specilization,$role_type,$job_type){
        return $query->where('qualification',$qualification)
             ->orWhere('job_location', $location)
            ->orWhere('specialization', $specilization)
            ->orWhere('job_by_roles', $role_type)
            ->orWhere('job_type', $job_type);


    }

    public function jobType(){
        return $this->belongsTo('App\Models\JobTypesModel','job_type');
    }

    public function jobRole(){
        return $this->belongsTo('App\Models\JobByRolesModel','job_by_roles');
    }

    public function jobQualification(){
        return $this->belongsTo('App\Models\QualificationModel','qualification');
    }

    public function jobLocation(){
        return $this->belongsTo('App\Models\LocationModel','job_location');
    }

    public function jobSpecialization(){
        return $this->belongsTo('App\Models\SpecializationModel','specialization');
    }
}
