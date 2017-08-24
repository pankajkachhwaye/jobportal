<?php

namespace App\Http\Repository;


use App\Models\JobsModel;
use App\Models\RecruiterModel;
use App\Models\RecruiterProfile;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RecruiterRepository
{

    public function fillRecruiterProfile($data = []){
        try{
            $temp_data = $data->all();

            if(isset($data->i_am))
                $temp_data['i_am']= $data->i_am;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-identity'))];

            if($data->org_location != '')
                $temp_data['org_location']= $data->org_location;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-location'))];

            if($data->org_address != '')
                $temp_data['org_address']= $data->org_address;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-address'))];

            if($data->org_discription != '')
                $temp_data['org_discription']= $data->org_discription;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-discription'))];


            if($data->hasFile('org_logo')) {
                $ext = $data->org_logo->getClientOriginalExtension();

                $path = Storage::putFileAs('organisationlogo', $data->org_logo,time().$data->recruiter_id .".".$ext);
                $temp_data['org_logo'] = $path;
            }
            else{
                $temp_data['org_logo'] = 'organisationlogo/company_dummy.jpg';
            }

//              $model->insert($temp_data);
            $check = RecruiterProfile::where('recruiter_id',$data->recruiter_id)->first();
            if($check == null){
                $temp_data['created_at'] = Carbon::now();
                RecruiterProfile::insert($temp_data);
            }
            else{
                $temp_data['updated_at'] = Carbon::now();
                RecruiterProfile::where('recruiter_id',$data->recruiter_id)->update($temp_data);
            }
            $recruiter = RecruiterModel::find($data->recruiter_id);
            $recruiter->recruiter_profile_update = 1;
            $recruiter->save();
            $recruiter_profile = $recruiter->recruiterProfile;
            $returndata = $recruiter->toArray();
            $logo = $returndata['recruiter_profile']['org_logo'];
            $returndata['recruiter_profile']['org_logo'] =asset('storage/'.$logo);


            return ['code' => 101,'status'=>true, 'message' => 'Profile Update Successfully','data'=>$returndata];

        }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }


    public function saveNewJob($data = [], $model){
        try{

            $temp_data = $data->all();

            if(isset($data->job_type))
                $temp_data['job_type']= $data->job_type;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-type'))];

            if($data->job_by_roles != '')
                $temp_data['job_by_roles']= $data->job_by_roles;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-role'))];

            if($data->qualification != '')
                $temp_data['qualification']= $data->qualification;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.qualification'))];

            if($data->job_location != '')
                $temp_data['job_location']= $data->job_location;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-location'))];

            if($data->specialization != '')
                $temp_data['specialization']= $data->specialization;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.specialization'))];

            if($data->skills_required != '')
                $temp_data['skills_required']= $data->skills_required;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.skills'))];

            if($data->experience != '')
                $temp_data['experience']= $data->experience;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.experience'))];

            if($data->job_discription != '')
                $temp_data['job_discription']= $data->job_discription;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-discription'))];

            if($data->min_sal != '')
                $temp_data['min_sal']= $data->min_sal;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.minimum-salary'))];

            if($data->max_sal != '')
                $temp_data['max_sal']= $data->max_sal;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.maximum-salary'))];

            if($data->per != '')
                $temp_data['per']= $data->per;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.salary-per'))];

            if($data->vacancies != '')
                $temp_data['vacancies']= $data->vacancies;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.vacancies'))];

            if($data->last_date != '')
                $temp_data['last_date']= date("Y-m-d", strtotime($data->last_date));
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.last-date-app'))];

            if(isset($data->process))
                $temp_data['process']= $data->process;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.process'))];

            $temp_data['created_at'] = Carbon::now();
            //dd($temp_data);

            $model->insert($temp_data);
            return ['code' => 101,'status'=>true, 'message' => 'Job Added Successfully'];

        }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function checkJobApplication($data){
        try{
            if($data['recruiter_id'] == null)
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.invalid-recruiter'))];

            if($data['job_id'] == null)
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.invalid-job'))];

            $job = JobsModel::find($data['job_id']);
            $application = $job->jobApplications()->get();

            $seeker = [];
            foreach ($application as $key_app => $value_app){
                $temp_x = $value_app->seekerOnJob;
                $x = $temp_x->toArray();
                $x['profile'] = $temp_x->seekerProfile->toArray();
                $resume = $x['profile']['resume'];
                $x['profile']['resume'] = asset('storage/'.$resume);
                array_push($seeker,$x);
            }

            if(count($seeker) > 0)
                return ['code' => 101,'status'=>true, 'message' => 'Job Application Found','data' => $seeker];
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.no-application'))];
        }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }


    }


}