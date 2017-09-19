<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeekerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\GenralNotification;
use Illuminate\Support\Facades\Lang;
use Response;

class ManageSeekerController extends Controller
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

    public function seekerSendNotification(){
        $page = 'notification';
        $sub_page = 'send-notification-seeker';
        $seeker = SeekerModel::all()->toArray();
        return view('vendor.seeker.notifyseeker',compact('page','sub_page','seeker'));
    }

    public function notifSelectedSeeker(Request $request){
        foreach ($request->seeker as $key_seeker => $value_seeker){
            $temp_user = SeekerModel::find($value_seeker);
            $user_device = $temp_user->device_type;
            if($user_device != null){
                $temp_user->notify(new GenralNotification($request->notification_title, $request->notification_body));
                $notify =  $this->firebase_notification($temp_user->device_token,$request->notification_title, $request->notification_body);
            }
        }
        return Response::json(['code' => 200, 'status' => true, 'message' => 'notification send successfully to selected seekers','response' => $notify]);
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
//        return $response;

    }
}
