<?php

namespace App\Http\Controllers\Api;

use App\Http\Facades\General;
use App\Http\Repository\SeekerRepository;
use App\Models\ApplyOnJobModel;
use App\Models\SeekerProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use App\Mail\JobPortalConfirmationEmail;
use Mockery\Exception;
use Validator;
use App\Models\SeekerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Response;
use Illuminate\Support\Facades\DB;
use App\Models\JobsModel;


class SeekerController extends Controller
{

    public function generalInfo(){
        dd(General::basicInfo());
    }

    protected function createSeeker(array $data)
    {
        return SeekerModel::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'mobile_no' => $data['mobile_no'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function registerSeeker(Request $request)
    {

        try {
            $seeker_email = SeekerModel::GetSeekerByEmail($request->email)->first();
            $seeker_mob = SeekerModel::GetSeekerByMob($request->mobile_no)->first();

            if ($seeker_email != null) {
                return Response::json(['code' => 400, 'status' => false, 'message' => 'User email already register with us.']);
            }

            if ($seeker_mob != null) {
                return Response::json(['code' => 400, 'status' => false, 'message' => 'User mobile number already register with us.']);
            }

            $user = $this->createSeeker($request->all());

            Mail::to($user->email)->send(new JobPortalConfirmationEmail($user));



            if (count(Mail::failures()) == 0) {
                return Response::json(['code' => 200, 'status' => true, 'message' => trim(Lang::get('seeker.register-succees'))]);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    public function confirmEmail($token)
    {
        try {
            $confirm = SeekerModel::whereToken($token)->firstOrFail()->hasVerified();
            return Response::json(['code' => 200, 'status' => true, 'message' => trim(Lang::get('seeker.register-confirm'))]);
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    public function loginSeeker(Request $request)
    {
        try {
            $seeker = SeekerModel::GetSeekerByMobOrEmail($request->value)->first();
            if ($seeker == null) {
                return Response::json(['code' => 400, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-not-register'))]);
            }
            if ($seeker->verified == false) {
                return Response::json(['code' => 400, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-not-verified'))]);
            }
            if (Hash::check($request->password, $seeker->password)) {
                return Response::json(['code' => 200, 'status' => true, 'message' => 'Login successfully', 'data' => $seeker]);
            } else {
                return Response::json(['code' => 400, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-password'))]);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    public function fillSeekerProfile(Request $request ,SeekerRepository $repository){

        $save = $repository->fillSeekerProfile($request, new SeekerProfile());
        if ($save['code'] == 400)
            return Response::json(['code' => 400, 'status' => false, 'message' => $save['message'],'data'=>$save['data']]);

        if($save['code'] == 101)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message'],'data'=>$save['data']]);

        if($save['code'] == 500)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message'],'data'=>$save['data']]);
    }

    public function activeJobs(Request $request){
//      $seeker =  SeekerModel::find($request->seeker_id);
//      $jobs = General::matchjob($seeker);
        $tem_jobs =   JobsModel::all();
        $jobs = [];
        foreach ($tem_jobs as $key_job => $value_job){
            $recruiter = $value_job->postedRecruiter;
            $profile = $recruiter->recruiterProfile;
            $x = $value_job->toArray();
//            $x['process'] = json_decode($x['process']);
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
      return Response::json($tempdata);
    }

    public function applyOnJob(Request $request,SeekerRepository $repository){
        $save = $repository->applyjob($request->all(), new ApplyOnJobModel());
        if($save['code'] == 101)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);
        if ($save['code'] == 400)
            return Response::json(['code' => 400, 'status' => false, 'message' => $save['message']]);

        if($save['code'] == 500)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);
    }

    public function seekerChangePassword(Request $request){
        $data = $request->all();
        $old = $data['old_password'];
        $new = $data['new_password'];

        if ($old == '')
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Please enter your old password' ]);

        if ($new == '')
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Please enter your new password' ]);

         $users = SeekerModel::find($data['seeker_id']);
          // dd($users);
        $dbpass = $users->password;

        if (Hash::check($old, $dbpass)) {
                  $new = bcrypt($new);
                    $info = ['password' => $new];
                    $query = DB::table('seeker')->where('id', $data['seeker_id'])->update($info);
                    if ($query) {
                     return Response::json(['code' => 200, 'status' => true, 'message' =>'Your password has been updated' ]);
                    } else {
                        return Response::json(['code' => 500, 'status' => false, 'message' =>'Internal Server error' ]);
                    }
                } else {
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Your old password is not match' ]);
                }


    }

}
