<?php

namespace App\Http\Controllers\Api;

use App\Models\ApplyOnJobModel;
use Illuminate\Support\Facades\Hash;
use App\Http\Repository\RecruiterRepository;
use App\Mail\JobPortalRecruiterConfirmationEmail;
use App\Models\JobsModel;
use App\Models\RecruiterModel;
use App\Models\RecruiterProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;

use Response;
use Illuminate\Support\Facades\DB;

class RecruiterController extends Controller
{
    protected function createRecruiter(array $data)
    {
        return RecruiterModel::create([
            'organisation_name' => $data['organisation_name'],
            'recruiter_email' => $data['recruiter_email'],
            'recruiter_mobile_no' => $data['recruiter_mobile_no'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function registerRecruiter(Request $request)
    {

        try {
            $recruiter_email = RecruiterModel::GetRecruiterByEmail($request->recruiter_email)->first();
            $recruiter_mob = RecruiterModel::GetRecruiterByMob($request->recruiter_mobile_no)->first();


            if ($recruiter_email != null) {
                return Response::json(['code' => 400, 'status' => false, 'message' => 'Recruiter email already register with us.']);
            }

            if ($recruiter_mob != null) {
                return Response::json(['code' => 400, 'status' => false, 'message' => 'Recruiter mobile number already register with us.']);
            }


            $user = $this->createRecruiter($request->all());

            Mail::to($user->recruiter_email)->send(new JobPortalRecruiterConfirmationEmail($user));

            if (count(Mail::failures()) == 0) {
                return Response::json(['code' => 200, 'status' => true, 'message' => trim(Lang::get('recruiter.register-succees'))]);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    public function recruiterConfirmEmail($token){
        try {
            $confirm = RecruiterModel::whereToken($token)->firstOrFail()->hasVerified();
            return Response::json(['code' => 200, 'status' => true, 'message' => trim(Lang::get('recruiter.register-confirm'))]);
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function loginRecruiter(Request $request){
        try {
            $recruiter = RecruiterModel::GetRecruiterByMobOrEmail($request->value_recruiter)->first();

            if ($recruiter == null) {
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('recruiter.recruiter-not-register'))]);
            }
            if ($recruiter->recruiter_verified == false) {
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('recruiter.recruiter-not-verified'))]);
            }
            if (Hash::check($request->password, $recruiter->password)) {
                if($recruiter->recruiter_profile_update == 1){
                    $perm_recruiter = $recruiter->toArray();
                    $profile =  $recruiter->recruiterProfile;
                    $logo = $profile->org_logo;
                    $profile->org_logo =asset('storage/'.$logo);
                    $perm_recruiter['role'] = 'recruiter';

                    return Response::json(['code' => 200, 'status' => true,'message'=> 'Login successfully', 'data' => $perm_recruiter,'profile' => $profile]);
                }
                else{
                    $recruiter->role = 'recruiter';
                    return Response::json(['code' => 200, 'status' => true,'message'=> 'Login successfully', 'data' => $recruiter]);
                }

            } else {
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('recruiter.recruiter-password'))]);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }
    }

    public function fillRecruiterProfile(Request $request,RecruiterRepository $repository){
        $save = $repository->fillRecruiterProfile($request);
        if ($save['code'] == 400)
            return Response::json(['code' => 400, 'status' => false, 'message' => $save['message'],'data' => array()]);

        if($save['code'] == 101)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message'],'data' => $save['data']]);

        if($save['code'] == 500)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message'],'data' => array()]);
    }

    public function postNewJob(Request $request,RecruiterRepository $repository){
        $save = $repository->saveNewJob($request, new JobsModel());
        if ($save['code'] == 400)
            return Response::json(['code' => 400, 'status' => false, 'message' => $save['message']]);

        if($save['code'] == 101)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);

        if($save['code'] == 500)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);
    }


        public function getRecruiterJobs(Request $request){
//        dd($request->all());
            $tem_jobs = JobsModel::where('recruiter_id',$request->recruiter_id)->get();
            $jobs = [];
            foreach ($tem_jobs as $key_job => $value_job){
                $x = $value_job->toArray();
                $specialization = $value_job->jobSpecialization->toArray();
                $x['specialization'] = $specialization['specialization'];
                $x['specialization_id'] = $specialization['id'];

                $count = ApplyOnJobModel::where('job_id',$value_job->id)->count();
                $x['no_applied_by'] = $count;
                array_push($jobs,$x);
            }
            if(count($jobs) > 0){
                return Response::json( ['code' => 101,'status'=>true, 'message' => 'Job Application Found','data' => $jobs]);
            }
            else{
                return Response::json( ['code' => 400,'status'=>false, 'message' => 'No job posted yet','data' => $jobs]);
            }



        }

        public function getJobApplications(Request $request,RecruiterRepository $repository){

            $response = $repository->checkJobApplication($request->all());
            if ($response['code'] == 400)
                return Response::json(['code' => 400, 'status' => false, 'message' => $response['message']]);

            if($response['code'] == 101)
                return Response::json(['code' => $response['code'], 'status' => $response['status'],'message' => $response['message'],'data' => $response['data']]);

            if($response['code'] == 500)

                return Response::json(['code' => $response['code'], 'status' => $response['status'], 'message' => $response['message']]);
        }


    public function recruiterChangePassword(Request $request){
        $data = $request->all();
        $old = $data['old_password'];
        $new = $data['new_password'];


        if ($old == '')
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Please enter your old password' ]);

        if ($new == '')
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Please enter your new password' ]);

        $users = RecruiterModel::find($data['recruiter_id']);

        $dbpass = $users->password;

        if (Hash::check($old,trim($dbpass))) {
            $new = bcrypt($new);
            $info = ['password' => $new];
            $query = DB::table('recruiter')->where('id', $data['recruiter_id'])->update($info);
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
