<?php

namespace App\Http\Controllers\Admin;

use App\Http\Facades\General;
use App\Models\JobsModel;
use Illuminate\Http\Request;
use App\Models\RecruiterModel;
use App\Http\Controllers\Controller;
use Response;


class ManageRecruiterController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getAllRecruiter(){
        $page = 'recruiter';
        $sub_page = 'all-recruiter';
        $recruiter = RecruiterModel::all()->toArray();

        return view('vendor.recruiter.allrecruiter',compact('page','sub_page','recruiter'));
    }

    public function recruiterViewDetails($id){
        $page = 'recruiter';
        $sub_page = 'all-recruiter';
        $temp = RecruiterModel::find($id);
        $recruiter = $temp->toArray();
        $recruiter['profile'] = $temp->recruiterProfile->toArray();
        $recruiter['postedjobs'] = $temp->postedJobs()->get()->toArray();

        return view('vendor.recruiter.recruiterdetails',compact('page','sub_page','recruiter'));
    }

    public function recruiterPostedJobs($id){
        $page = 'recruiter';
        $sub_page = 'all-recruiter';
        $recruiter = RecruiterModel::find($id);
        $posted_jobs = $recruiter->postedJobs()->get();
        $jobs = [];
        foreach ($posted_jobs as $key_job => $value_job){
            $x = $value_job->toArray();
            $specialization = $value_job->jobSpecialization->toArray();
            $x['specialization'] = $specialization['specialization'];
            $x['specialization_id'] = $specialization['id'];
            array_push($jobs,$x);
        }

        if(count($jobs) == 0){
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'currently no job posted by recruiter');
        }
        else{
            return view('vendor.recruiter.postedjobs',compact('page','sub_page','jobs','recruiter'));
        }
    }

    public function recruiterPostedJobsDetail($id,$recruiter_id){
        $temp_job = JobsModel::find($id);
        $x = $temp_job->toArray();
        $x['process'] = json_decode($x['process']);
        $job_type = $temp_job->jobType->toArray();

        $x['job_type'] = $job_type['job_type'];
//        $x['job_type_id'] = $job_type['id'];
        $job_by_roles = $temp_job->jobRole->toArray();
        $x['job_by_roles'] =$job_by_roles['job_by_role'];
        $x['job_by_roles_id'] =$job_by_roles['id'];
        $qualification = $temp_job->jobQualification->toArray();
        $x['qualification'] = $qualification['qualification'];
//        $x['qualification_id'] = $qualification['id'];
        $location = $temp_job->jobLocation->toArray();
        $x['job_location'] = $location['location_name'];
//        $x['job_location_id'] = $location['id'];
        $specialization = $temp_job->jobSpecialization->toArray();
        $x['specialization'] = $specialization['specialization'];
//        $x['specialization_id'] = $specialization['id'];
        $recruiter = RecruiterModel::find($recruiter_id);
        $profile = $recruiter->recruiterProfile;
        $x['recruiter']  = $recruiter;

        return Response::json($x);
    }
}