<?php

namespace App\Http\Controllers\Admin;

use App\Http\Facades\General;
use Illuminate\Http\Request;
use App\Models\RecruiterModel;
use App\Http\Controllers\Controller;

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

}
