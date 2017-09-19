<?php

namespace App\Http\Controllers\Admin;

use App\Http\Facades\General;
use App\Models\JobsModel;
use Illuminate\Http\Request;
use App\Models\RecruiterModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Response;
use App\Notifications\GenralNotification;

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

    public function recruiterSendNotification(){
        $page = 'notification';
        $sub_page = 'send-notification-recruiter';
        $recruiter = RecruiterModel::all()->toArray();
        return view('vendor.recruiter.notifyrecruiter',compact('page','sub_page','recruiter'));
    }

    public function notifSelectedReruiters(Request $request){
        foreach ($request->recruiter as $key_recruiter => $value_recruiter){
            $temp_user = RecruiterModel::find($value_recruiter);
            $user_device = $temp_user->device_type;
            if($user_device != null){
                $temp_user->notify(new GenralNotification($request->notification_title, $request->notification_body));
                $notify =  $this->firebase_notification($temp_user->device_token,$request->notification_title, $request->notification_body);
               }
        }
        return Response::json(['code' => 200, 'status' => true, 'message' => 'notification send successfully to selected recruiters','response' => $notify]);
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
        $headers[] = 'Authorization: key= '.Lang::get('constant.firebase-key'); //server key here

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

        //Send the request
        $response = curl_exec($ch);

        //Close request
        curl_close($ch);
   return $response;

    }
}