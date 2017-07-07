<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\AreaOfSectorsModel;
use App\Models\LocationModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
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


    public function index(){
        $locations = LocationModel::all()->toArray();
        $page = "dashboard";
        return view('vendor.admin.dashboard',compact('page','locations'));
    }


    public function location(){
        $locations = LocationModel::all()->toArray();
        $page = 'location';
        return view('vendor.admin.locations',compact('page','locations'));
    }

    public function postLocation(Request $req,CrudRepository $repo){
        $save =$repo->createNew($req->all(), new LocationModel());
        if($save['code'] == 101){
            $locations = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location Added Successfully')->with($locations);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }


    public function areaOfSectors(){
        $area_of_sectors = AreaOfSectorsModel::all()->toArray();
        $page = 'area-of-sectors';
        return view('vendor.admin.areaofsectors',compact('page','area_of_sectors'));
    }

    public function postAreaOfSectors(Request $req,CrudRepository $repo){
        $save =$repo->createNew($req->all(), new AreaOfSectorsModel());
        if($save['code'] == 101){
            $area_of_sectors = AreaOfSectorsModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area Of Sectors Added Successfully')->with($area_of_sectors);
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
    }

}
