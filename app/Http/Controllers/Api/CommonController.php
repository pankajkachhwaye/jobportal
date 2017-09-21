<?php

namespace App\Http\Controllers\Api;

use App\Mail\ForgotPassword;
use App\Models\RecruiterModel;
use App\Models\SeekerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Facades\General;
use Illuminate\Support\Facades\Mail;
use Response;


class CommonController extends Controller
{
    public function __construct()
    {
        $this->middleware('cors');
    }

    /**
     * @return mixed
     */
    public function basicInformation(){
        $general =  General::basicInfo();
        if(count($general) > 0){
            $tempdata =[
                'code' => 200,
                'status' => true,
                'message' => 'Data found',
                'data' => $general
            ];
        }
        else{
            $tempdata =[
                'code' => 500,
                'status' => false,
                'message' => 'Data not found',
                'data' => []
            ];
        }

       return Response::json($tempdata);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function forgotPassword(Request $request){
            if($request->role == '0'){
                $seeker = SeekerModel::GetSeekerByEmail($request->email)->first();
                if($seeker != null){
                    $password = str_random(8);
                    $seeker->password = bcrypt($password);
                    $seeker->save();
                    Mail::to($request->email)->send(new ForgotPassword($seeker,$password));
                    if (count(Mail::failures()) == 0) {
                        return Response::json(['code' => 200, 'status' => true, 'message' => 'New Password has been send to register email address.','data' => array()]);
                    }
                }
                else{
                    return Response::json(['code' => 400, 'status' => false, 'message' =>'Seeker is not register with us.','data'=>array() ]);
                }
            }
            if($request->role == '1'){
                $recruiter = RecruiterModel::GetRecruiterByEmail($request->email)->first();
//                dd($recruiter);
                if($recruiter != null){
                    $password = str_random(8);
                    $recruiter->password = bcrypt($password);
                    $recruiter->save();
                    Mail::to($request->email)->send(new ForgotPassword($recruiter,$password));
                    if (count(Mail::failures()) == 0) {
                        return Response::json(['code' => 200, 'status' => true, 'message' => 'New Password has been send to register email address.','data' => array()]);
                    }
                }
                else{
                    return Response::json(['code' => 400, 'status' => false, 'message' =>'Recruiter is not register with us.','data'=>array() ]);
                }
            }
    }

    public function getAllNotifications(Request $request){
//        dd($request->all());
        if($request->role == 0){
            //seeker
            $seeker = SeekerModel::find($request->id);
            $notifications = $seeker->notifications->toArray();

        }
        else{
            //recruiter
            $recruiter = RecruiterModel::find($request->id);
            $notifications = $recruiter->notifications->toArray();
        }

        if(count($notifications) > 0){
            $temp_notification = [];
            foreach ($notifications as $key_notify => $value_notify){
                $value_notify['data']['created_at'] = $value_notify['created_at'];
                array_push($temp_notification,$value_notify['data']);
            }

            return Response::json(['code' => 200, 'status' => true,'message' => 'notification found','data' =>$temp_notification]);
        }
        else{
            return Response::json(['code' => 200, 'status' => false,'message' => 'No notification found','data' =>array()]);
        }
    }

}
