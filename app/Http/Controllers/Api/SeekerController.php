<?php

namespace App\Http\Controllers\Api;

use App\Http\Facades\General;
use App\Http\Repository\SeekerRepository;
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
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-not-register'))]);
            }
            if ($seeker->verified == false) {
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-not-verified'))]);
            }
            if (Hash::check($request->password, $seeker->password)) {
                return Response::json(['code' => 200, 'status' => true, 'data' => $seeker]);
            } else {
                return Response::json(['code' => 200, 'status' => false, 'message' => trim(Lang::get('seeker.seeker-password'))]);
            }
        } catch (\Exception $exception) {
            return Response::json(['code' => 500, 'status' => false, 'message' => $exception->getMessage()]);
        }


    }

    public function fillSeekerProfile(Request $request ,SeekerRepository $repository){

        $save = $repository->fillSeekerProfile($request, new SeekerProfile());
        if ($save['code'] == 400)
            return Response::json(['code' => 400, 'status' => false, 'message' => $save['message']]);

        if($save['code'] == 101)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);

        if($save['code'] == 500)
            return Response::json(['code' => $save['code'], 'status' => $save['status'], 'message' => $save['message']]);
    }

    public function activeJobs(Request $request){
      $seeker =  SeekerModel::find($request->seeker_id);
      $jobs = General::matchjob($seeker);

      if(count($jobs) > 0){
          return Response::json(['code' => 101, 'status' => true, 'data' => $jobs]);
      }
      else{
          return Response::json(['code' => 200, 'status' => false, 'message' => 'No Matching Jobs Are found For this Profile']);
      }


    }


}
