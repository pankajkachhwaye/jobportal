<?php

namespace App\Http\Repository;


use App\Models\ApplyOnJobModel;
use App\Models\JobsModel;
use App\Models\SeekerModel;
use App\Models\SeekerProfile;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Config;

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

            return ['code' => 200,'status'=>true, 'message' => 'Profile has been updated successfully.','data'=>$returndata];

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
                $recruiter = JobsModel::find($data['job_id'])->postedRecruiter;
                    if($recruiter->device_type != null){
                        $title = 'Job Portal';
                        $body = trim(Lang::get('recruiter.recruiter-notify.applied-on-job'));
                        $notify = $this->firebase_notification($recruiter->device_token,$title,$body);
                        $responseNotification = json_decode($notify);
                        dd($responseNotification);
                    }

                return ['code' => 200, 'status' => true, 'message' => trim(Lang::get('seeker.apply-success'))];
            }
       }
        catch (\Exception $exception){
            return ['code' => 500, 'status' => false, 'message' => $exception->getMessage()];
        }
    }

    public function sendNotificationRegisteredUser(){

        $page = 'notification';
        $sub_page = 'notify-registered-users';
        $app_users = AppUser::all();
//        dd($app_users);
        return view('admin.notifyregisterd',compact('page','sub_page','app_users'));
    }


    public function firebase_notification($device_token,$title,$body){
        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        //The device token.
        /*$token = "eA-RyGHUo38:APA91bE_Giwf5lGGH87syUFLy__NS8g_YYR8W2LWp9hvss_gnTlDCkrHZekz44pI_6LZU0G1dJ4JUO5bDm6J_U6TsOgQqd4MzsUN37EP-JKA2NdonXIvjCrAPNz3Ui6xwPPbt608jltI";*/
        $token = $device_token;

        //Title of the Notification.
        $title = $title;

        //Body of the Notification.
        $body = $body;

        //Creating the notification array.
        $notification = array('title' =>$title , 'text' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' => $token, 'notification' => $notification);
        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);

        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';

        //behindbar
        //$headers[] = 'Authorization: key= AAAANYa3Tpo:APA91bFFgq6p2EqPi2OPhNFYdHChomOILYJr4mqbPGQANq5w6axeEZwojxfkL0Iyknsvte825OgjfhyJ7dnIMVOzS7uRMqE502y0amwipgpw6GM5yeQAilUUgiCASrvkYpc8vwNj9EQk'; //server key here


        //poochplay
        $headers[] = 'Authorization: key= AAAAN1pXap0:APA91bGolaXhXdz-gH74YVIGtM5lryB67HxZpKtayOmfD7JFSv2dnaGjLdJJJ2ezzeLBN1hWCww23dQIxlsPT-YX9fytENzNrLBLUip4hNgrPMYcxwGK5quYL2TDggzv_FvoUPAiA2gU'; //server key here

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
//        curl_close($ch);
//        return $response;

    }
}
