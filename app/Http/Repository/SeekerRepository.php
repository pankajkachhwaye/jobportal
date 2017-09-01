<?php

namespace App\Http\Repository;


use App\Models\ApplyOnJobModel;
use App\Models\SeekerModel;
use App\Models\SeekerProfile;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SeekerRepository
{

    public function fillSeekerProfile($data = []){
        try{


            $temp_data = $data->all();

//       dd($temp_data);
//            if(isset($data->gender))
//                $temp_data['gender']= $data->gender;
//            else
//                return ['code' => 400, 'message' => trim(Lang::get('seeker.seeker-profile-gender')),'data'=>[]];

            if($data->hasFile('avtar')) {
                $ext = $data->avtar->getClientOriginalExtension();

                $path = Storage::putFileAs('seeker_pic', $data->avtar,time().$data->seeker_id .".".$ext);
                $temp_data['avtar'] = $path;
            }
            else{

                $temp_data['avtar'] = 'seeker_pic/dummy_user.png';

            }


//           if(isset($data->job_type))
//                $temp_data['job_type'] = $data->job_type;
//            else
//                return ['code' => 400, 'message' => trim(Lang::get('seeker.seeker-profile-job-type')),'data'=>[]];
//
//            if(isset($data->work_experience))
//                $temp_data['work_experience'] = $data->work_experience;
//            else
//                return ['code' => 400, 'message' => trim(Lang::get('seeker.seeker-profile-work-experience')),'data'=>[]];

//            if($data->specialization == '')
//                $temp_data['specialization'] = $data->specialization;
//            else
//                $temp_data['specialization'] = null;
//
//            if($data->role_type == '')
//                $temp_data['role_type'] = $data->role_type;
//            else
//                $temp_data['role_type'] = null;

            if($data->hasFile('resume')) {
                $ext = $data->resume->getClientOriginalExtension();

                $path = Storage::putFileAs('resumes', $data->resume,time().$data->seeker_id .".".$ext);
                $temp_data['resume'] = $path;
            }
            else{
//                return ['code' => 400, 'message' => trim(Lang::get('seeker.seeker-profile-resume')),'data'=>[]];
                $temp_data['resume'] = 'blank _resume';
            }



            $check = SeekerProfile::where('seeker_id',$data->seeker_id)->first();
            if($check ==null){
                $temp_data['created_at'] = Carbon::now();
                SeekerProfile::insert($temp_data);
            }
            else{
                $temp_data['updated_at'] = Carbon::now();
                SeekerProfile::where('seeker_id',$data->seeker_id)->update($temp_data);
            }
            $seeker = SeekerModel::find($data->seeker_id);
            $seeker->profile_update = 1;
            $seeker->save();
            $seeker_profile = $seeker->seekerProfile;
            $returndata = $seeker->toArray();
            $profile = $returndata['seeker_profile']['avtar'];
            $resume = $returndata['seeker_profile']['resume'];
            $returndata['seeker_profile']['avtar'] =asset('storage/'.$profile);
            $returndata['seeker_profile']['resume'] =asset('storage/'.$resume);

            return ['code' => 101,'status'=>true, 'message' => 'Profile has been updated successfully.','data'=>$returndata];

        }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage(),'data'=>[]];
        }
    }


    public function applyjob($data = [], $model){

        try {
            $check = ApplyOnJobModel::GetJobApplication($data['job_id'], $data['seeker_id'])->get()->toArray();
            if (count($check) > 0) {
                return ['code' => 400, 'message' => trim(Lang::get('seeker.already-apply'))];
            } else {
                $data['created_at'] = Carbon::now();
                $model->insert($data);
                return ['code' => 101, 'status' => true, 'message' => trim(Lang::get('seeker.apply-success'))];
            }
       }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }
}