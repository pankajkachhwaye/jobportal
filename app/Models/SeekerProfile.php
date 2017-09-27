<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
   protected $table = 'seeker_profile';

   public function seekerAreaOfSector(){
       return $this->belongsTo('App\Models\AreaOfSectorsModel','area_of_sector');
   }

    public function jobType(){
        return $this->belongsTo('App\Models\JobTypesModel','job_type');
    }


    public function seekerQualification(){
        return $this->belongsTo('App\Models\QualificationModel','seeker_qualification');
    }

    public function seekerSpecialization(){
        return $this->belongsTo('App\Models\SpecializationModel','specialization');
    }

    public function seekerRoleType(){
        return $this->belongsTo('App\Models\JobByRolesModel','role_type');
    }





    public function getSpecializationAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getExperienceInYearAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getExperienceInMonthsAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getRoleTypeAttribute($value)
    {
        return ($value == null ? '':$value);
    }


    public function getCertificationAttribute($value)
    {
        return ($value == null ? '':$value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return ($value == null ? '':$value);
    }
}
