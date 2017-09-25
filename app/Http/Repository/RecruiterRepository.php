<?php

namespace App\Http\Repository;


use App\Models\ApplyOnJobModel;
use App\Models\JobsModel;
use App\Models\LocationModel;
use App\Models\RecruiterModel;
use App\Models\RecruiterProfile;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RecruiterRepository
{

    public function fillRecruiterProfile($data = [])
    {
        try {
            $temp_data = $data->all();

            if (isset($data->i_am))
                $temp_data['i_am'] = $data->i_am;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-identity'))];

            if ($data->org_location != '')
                $temp_data['org_location'] = $data->org_location;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-location'))];

            if ($data->org_address != '')
                $temp_data['org_address'] = $data->org_address;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-address'))];

            if ($data->org_discription != '')
                $temp_data['org_discription'] = $data->org_discription;
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.recruiter-discription'))];


            if ($data->hasFile('org_logo')) {
                $ext = $data->org_logo->getClientOriginalExtension();

                $path = Storage::putFileAs('organisationlogo', $data->org_logo, time() . $data->recruiter_id . "." . $ext);
                $temp_data['org_logo'] = $path;
            } else {
                $temp_data['org_logo'] = 'organisationlogo/company_dummy.jpg';
            }

//              $model->insert($temp_data);
            $check = RecruiterProfile::where('recruiter_id', $data->recruiter_id)->first();
            if ($check == null) {
                $temp_data['created_at'] = Carbon::now();
                RecruiterProfile::insert($temp_data);
            } else {
                $temp_data['updated_at'] = Carbon::now();
                RecruiterProfile::where('recruiter_id', $data->recruiter_id)->update($temp_data);
            }
            $recruiter = RecruiterModel::find($data->recruiter_id);
            $recruiter->recruiter_profile_update = 1;
            $recruiter->save();
            $recruiter_profile = $recruiter->recruiterProfile;
            $returndata = $recruiter->toArray();
            $logo = $returndata['recruiter_profile']['org_logo'];

            $returndata['recruiter_profile']['org_logo'] = asset('storage/' . $logo);


            return ['code' => 101, 'status' => true, 'message' => 'Profile has been updated successfully.', 'data' => $returndata];

        } catch (\Exception $exception) {
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }


    public function saveNewJob($data = [], $model)
    {
       try{

        $temp_data = $data->all();
//            dd($temp_data);
        if (isset($data->job_type))
            $temp_data['job_type'] = $data->job_type;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-type'))];

        if ($data->job_by_roles != '')
            $temp_data['job_by_roles'] = $data->job_by_roles;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-role'))];

        if ($data->qualification != '')
            $temp_data['qualification'] = $data->qualification;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.qualification'))];

        if ($data->job_location != '')
            $temp_data['job_location'] = $data->job_location;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-location'))];

        if ($data->specialization != '')
            $temp_data['specialization'] = $data->specialization;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.specialization'))];

        if ($data->skills_required != '')
            $temp_data['skills_required'] = $data->skills_required;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.skills'))];

        if ($data->experience != '')
            $temp_data['experience'] = $data->experience;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.experience'))];

        if ($data->job_discription != '')
            $temp_data['job_discription'] = $data->job_discription;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.job-discription'))];

        if ($data->min_sal != '')
            $temp_data['min_sal'] = $data->min_sal;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.minimum-salary'))];

        if ($data->max_sal != '')
            $temp_data['max_sal'] = $data->max_sal;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.maximum-salary'))];

        if ($data->per != '')
            $temp_data['per'] = $data->per;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.salary-per'))];

        if ($data->vacancies != '')
            $temp_data['vacancies'] = $data->vacancies;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.vacancies'))];

        if ($data->last_date != '')
            $temp_data['last_date'] = date("Y-m-d", strtotime($data->last_date));
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.last-date-app'))];

        if (isset($data->process))
            $temp_data['process'] = $data->process;
        else
            return ['code' => 400, 'message' => trim(Lang::get('recruiter.post-new-job.process'))];


        if ($temp_data['job_id'] == 0) {
            $temp_data['created_at'] = Carbon::now();
            unset($temp_data['job_id']);
            $model->insert($temp_data);
            return ['code' => 101, 'status' => true, 'message' => 'Job Added Successfully'];

        } else {
//                dd($temp_data);
            $job_id = $temp_data['job_id'];
            unset($temp_data['job_id']);
            $temp_data['updated_at'] = Carbon::now();
            $model->where('id', $job_id)->update($temp_data);
            return ['code' => 101, 'status' => true, 'message' => 'Job update Successfully'];


        }


       }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function checkJobApplication($data)
    {
        try {

            if ($data['recruiter_id'] == null)
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.invalid-recruiter'))];

            if ($data['job_id'] == null)
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.invalid-job'))];

            $job = JobsModel::find($data['job_id']);
            $application = $job->jobApplications()->get();

            $seeker = [];

            foreach ($application as $key_app => $value_app) {
                $temp_x = $value_app->seekerOnJob;
                $profile = $temp_x->seekerProfile;
                $temp_role_type = $profile->seekerRoleType;
                if($temp_role_type == null){
                    $role_type = $profile->work_experience;
                }
                else{
                    $role_type = $temp_role_type->job_by_role;
                }

                $temp_seeker = $temp_x->toArray();

                $x['full_name'] = $temp_seeker['full_name'];
                $x['mobile_no'] = $temp_seeker['mobile_no'];
                $x['email'] = $temp_seeker['email'];
                $x['seeker_id'] = $temp_seeker['id'];
                $x['role_type'] = $role_type;
                array_push($seeker, $x);
            }

            if (count($seeker) > 0)
                return ['code' => 200, 'status' => true, 'message' => 'Job Application Found', 'data' => $seeker];
            else
                return ['code' => 400, 'message' => trim(Lang::get('recruiter.check-application.no-application'))];
        } catch (\Exception $exception) {
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }


    }


    public function getProfileDataOnJob($data)
    {
        try {

            if ($data['seeker_id'] == null)
                return ['code' => 400, 'message' => 'Please provide seeker'];

            if ($data['job_id'] == null)
                return ['code' => 400, 'message' => 'Please provide Job'];

            $job_application = ApplyOnJobModel::GetJobApplication($data['job_id'], $data['seeker_id'])->first();
            $temp_x = $job_application->seekerOnJob;
            $x = $temp_x->toArray();
            $profile = $temp_x->seekerProfile;
            $x['profile'] = $profile->toArray();
            $area_of_sector = $profile->seekerAreaOfSector->area_of_sector;
            $x['profile']['seeker_area_of_sector'] = $area_of_sector;
            $job_type = $profile->jobType->job_type;
            $x['profile']['seeker_job_type'] = $job_type;
            $qualification = $profile->seekerQualification->qualification;
            $x['profile']['seeker_qulification'] = $qualification;
            if ($x['profile']['specialization'] != null) {
                $specialization = $profile->seekerSpecialization->specialization;
                $x['profile']['seeker_specialization'] = $specialization;
            } else {
                $x['profile']['seeker_specialization'] = '';
            }
            if ($x['profile']['role_type'] != null) {
                $role_type = $profile->seekerRoleType->job_by_role;
                $x['profile']['seeker_role_type'] = $role_type;
            } else {
                $x['profile']['seeker_role_type'] = '';
            }
//                dd($profile->preferred_location);
            $prefered_location = LocationModel::find($profile->preferred_location);
            $x['profile']['seeker_prefered_location'] = $prefered_location->location_name;

//                $x['profile']['seeker_qualification'] = $temp_x->seekerProfile->seekerQualification->qualification;
//                dd($x['profile']['seeker_area_of_sector']);
            $resume = $x['profile']['resume'];
            $x['profile']['resume'] = asset('storage/' . $resume);
            $apply_date = $job_application->toArray();
            $x['profile']['seeker_apply_date'] = $apply_date['created_at'];
//            $x['job_detail'] = $job_application->particularJob()->first(['last_date','job_discription']);

            return ['code' => 101, 'status' => true, 'message' => 'Sekeer details Found', 'data' => $x];
        } catch (\Exception $exception) {
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }

}
