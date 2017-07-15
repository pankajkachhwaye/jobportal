<?php
namespace App\Http\Helpers;


use App\Models\AreaOfSectorsModel;
use App\Models\JobByRolesModel;
use App\Models\JobTypesModel;
use App\Models\LocationModel;
use App\Models\QualificationModel;
use App\Models\SpecializationModel;

class GeneralInformation{

    public function basicInfo(){
        $basicinfo = [];
        $basicinfo['locations']= LocationModel::all()->toArray();
        $basicinfo['area_of_sectors']= AreaOfSectorsModel::all()->toArray();
        $basicinfo['specialization'] = SpecializationModel::all()->toArray();
        $basicinfo['qualifications']= QualificationModel::all()->toArray();
        $basicinfo['job_by_roles'] = JobByRolesModel::all()->toArray();
        $basicinfo['job_types'] = JobTypesModel::all()->toArray();
        return $basicinfo;
    }
}

?>