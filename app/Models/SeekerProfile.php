<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
   protected $table = 'seeker_profile';

   public function areaOfSector(){
       return $this->hasOne('App\Models\AreaOfSectorsModel','area_of_sector');
   }

    public function jobType(){
        return $this->hasOne('App\Models\JobTypesModel','job_type');
    }


}
