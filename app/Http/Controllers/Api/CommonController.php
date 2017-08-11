<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Facades\General;
use Response;


class CommonController extends Controller
{

    public function basicInformation(){

       return Response::json(General::basicInfo());
    }
}
