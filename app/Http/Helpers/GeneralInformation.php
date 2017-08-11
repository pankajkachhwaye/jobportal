<?php
namespace App\Http\Helpers;


use App\Models\AreaOfSectorsModel;
use App\Models\JobByRolesModel;
use App\Models\JobTypesModel;
use App\Models\LocationModel;
use App\Models\QualificationModel;
use App\Models\SpecializationModel;
use App\Models\SeekerModel;
use App\Models\JobsModel;

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

    public function matchJob($user){
       $tempuserprofile = $user->seekerProfile;
       $tempdata = [];

       if($tempuserprofile == null){
           $tempdata =[
               'code' => 400,
               'status' => false,
               'message' => 'No job found for user Please update profile',
               'data' => []
           ];

       }
       else{
           $userprofile = $tempuserprofile->toArray();
           $tem_jobs =   JobsModel::ProfileMatchedJobs($userprofile['seeker_qualification'],$userprofile['preferred_location'],$userprofile['specialization'],$userprofile['role_type'])->get();
            $jobs = [];
           foreach ($tem_jobs as $key_job => $value_job){
               $recruiter = $value_job->postedRecruiter;
                $profile = $recruiter->recruiterProfile;
               $x = $value_job->toArray();
               $job_type = $value_job->jobType->toArray();
               $x['job_type'] = $job_type['job_type'];
               $x['job_type_id'] = $job_type['id'];
               $job_by_roles = $value_job->jobRole->toArray();
               $x['job_by_roles'] =$job_by_roles['job_by_role'];
               $x['job_by_roles_id'] =$job_by_roles['id'];
               $qualification = $value_job->jobQualification->toArray();
               $x['qualification'] = $qualification['qualification'];
               $x['qualification_id'] = $qualification['id'];
               $location = $value_job->jobLocation->toArray();
               $x['job_location'] = $location['location_name'];
               $x['job_location_id'] = $location['id'];
               $specialization = $value_job->jobSpecialization->toArray();
               $x['specialization'] = $specialization['specialization'];
               $x['specialization_id'] = $specialization['id'];
//               $x['recruiter'] = $recruiter;
//               $x['recruiter']['profile'] = $profile;

               array_push($jobs,$x);
           }
           if(count($jobs) > 0){
               $tempdata =[
                   'code' => 200,
                   'status' => true,
                   'message' => 'Job found',
                   'data' => $jobs
               ];

           }
           else{
               $tempdata =[
                   'code' => 400,
                   'status' => false,
                   'message' => 'No Matching Jobs Are found For this Profile',
                   'data' => []
               ];

           }


       }


        return $tempdata;
    }

}

?>
