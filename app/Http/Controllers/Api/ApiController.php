<?php

namespace App\Http\Controllers\Api;

use App\Http\Facades\General;
use App\Models\RecruiterModel;
use App\Models\SeekerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    public function index(){

        return view('api.apidetails');
    }

    public function seekerregister(){
        return view('api.seeker.seekerregister');
    }

    public function showSeekerLogin(){
        return view('api.seeker.seekerlogin');
    }


    public function showSeekerProfileForm(){
        $seeker = SeekerModel::all()->toArray();
        $basicInfo = General::basicInfo();
        return view('api.seeker.seekerprofile' , compact('seeker','basicInfo'));
    }

    public function recruiterRegister(){
        return view('api.recruiter.recruiterregister');
    }

    public function showRecruiterLogin(){
        return view('api.recruiter.recruiterlogin');
    }

    public function showRecruiterProfileForm(){
        $recruiter = RecruiterModel::all()->toArray();
        $basicInfo = General::basicInfo();
        return view('api.recruiter.recruiterprofile',compact('recruiter','basicInfo'));
    }

    public function showPostJobForm(){
        $recruiter = RecruiterModel::all()->toArray();
        $basicInfo = General::basicInfo();

        return view('api.recruiter.postjob',compact('recruiter','basicInfo'));
    }

    public function showActiveJobsForm(){
        $seeker = SeekerModel::all()->toArray();
        return view('api.seeker.activejob' , compact('seeker'));
    }

}