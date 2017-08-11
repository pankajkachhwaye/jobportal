<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Facades\General;
use Response;


class CommonController extends Controller
{

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
}
