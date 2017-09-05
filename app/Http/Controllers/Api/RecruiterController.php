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
use Illuminate\Support\Facades\Config;
use JWTAuth;

use JWTAuthException;
class RecruiterController extends Controller
{

    public function __construct()
    {
        Config::set('jwt.user', 'App\Models\RecruiterModel');
    }

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
                   $token = JWTAuth::fromUser($recruiter);
                   $perm_recruiter['jwt_token'] = $token;
                   $perm_recruiter['recruiter_profile'] = $profile;

                    return Response::json(['code' => 200, 'status' => true,'message'=> 'You successfully logged in.', 'data' => $perm_recruiter]);
                }
                else{
//                    dd($recruiter);
                    $token = JWTAuth::fromUser($recruiter);
                    $recruiter->jwt_token = $token;
                    $recruiter->role = 'recruiter';
                    $recruiter->recruiter_profile = new \stdClass();
                    return Response::json(['code' => 200, 'status' => true,'message'=> 'You successfully logged in.', 'data' => $recruiter]);
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
            $tem_jobs = JobsModel::where('recruiter_id',$request->recruiter_id)->get(['id','specialization','job_discription']);
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

        public function getRecruiterJobDetail(Request $request){
            $value_job = JobsModel::find($request->job_id);
            $x = $value_job->toArray();
            $x['process'] = json_decode($x['process']);
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
            return Response::json( ['code' => 101,'status'=>true, 'message' => 'Job details found','data' => $x]);

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

        public function seekerProfileDetailOnJob(Request $request,RecruiterRepository $repository){
            $response = $repository->getProfileDataOnJob($request->all());
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
                return Response::json(['code' => 200, 'status' => true, 'message' =>'Password has been updated successfully.' ]);
            } else {
                return Response::json(['code' => 500, 'status' => false, 'message' =>'Internal Server error' ]);
            }
        } else {
            return Response::json(['code' => 400, 'status' => false, 'message' =>'Please enter valid old password.' ]);
        }


    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);

        return response()->json(['result' => $user]);
    }

    public function deleteJob(Request $request){
        $job = JobsModel::find($request->job_id);
        $job->delete();
        return Response::json(['code' => 200, 'status' => true, 'message' =>'job deleted successfully.' ]);
    }

}
