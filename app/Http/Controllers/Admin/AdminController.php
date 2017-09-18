<?php

namespace App\Http\Controllers\Admin;

use App\Http\Repository\CrudRepository;
use App\Models\AreaOfSectorsModel;
use App\Models\JobByRolesModel;
use App\Models\JobTypesModel;
use App\Models\LocationModel;
use App\Models\QualificationModel;
use App\Models\RecruiterModel;
use App\Models\SeekerModel;
use App\Models\SpecializationModel;
use App\Models\ApplyOnJobModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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


    public function index()
    {
        $locations = LocationModel::all()->toArray();
        $location = LocationModel::all()->count();
        $area = AreaOfSectorsModel::all()->count();
        $role = JobByRolesModel::all()->count();
        $type = JobTypesModel::all()->count();
        $specialization = SpecializationModel::all()->count();
        $qualification = QualificationModel::all()->count();
        $recruiter = RecruiterModel::all()->count();
        $apply_on_job = ApplyOnJobModel::all()->count();
        $job_today = ApplyOnJobModel::whereDay('created_at', '=', date('d'))->count();
        $yesterday = date("d", strtotime( '-1 days' ) );
        $job_yesterday = ApplyOnJobModel::whereDay('created_at', '=', $yesterday)->count();
        $job_month = ApplyOnJobModel::whereMonth('created_at', '=', date('m'))->count();
        $job_year = ApplyOnJobModel::whereYear('created_at', '=', date('Y'))->count();
        $seeker = SeekerModel::all()->count();
        $job_by_roles = \DB::table('job_by_roles')->offset(0)
            ->limit(5)->get();
        $page = "dashboard";
        //$area = AreaOfSectorsModel::where("area_of_sector", 'IT Service')->count();
        return view('vendor.admin.dashboard', compact('page', 'locations', 'location', 'area','role','type','specialization','qualification','recruiter','seeker','job_by_roles','apply_on_job','job_today','job_year','job_month','job_yesterday'));
    }


    public function location()
    {
        $locations = LocationModel::all()->toArray();
        $page = 'location';
        return view('vendor.admin.locations', compact('page', 'locations'));
    }


    public function editLocation($id)
    {
        $location = LocationModel::find($id)->toArray();
        $page = 'location';
        return view('vendor.admin.editlocation', compact('page', 'location'));
    }

    public function postLocation(Request $req, CrudRepository $repo)
    {
        $check = LocationModel::where('location_name',$req->location_name)->first();
        if($check == null){
        $save = $repo->createNew($req->all(), new LocationModel());
        if ($save['code'] == 101) {
            $locations = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location Added Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
        }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location already exist please enter unique location.');

        }
    }

    public function updateLocation(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new LocationModel());
        if ($update['code'] == 101) {
            $locations = LocationModel::all()->toArray();
            return redirect('location')->with('returnStatus', true)->with('status', 101)->with('message', 'Location Updated Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }


    public function areaOfSectors()
    {
        $area_of_sectors = AreaOfSectorsModel::all()->toArray();
        $page = 'area-of-sectors';
        return view('vendor.admin.areaofsectors', compact('page', 'area_of_sectors'));
    }

    public function postAreaOfSectors(Request $req, CrudRepository $repo)
    {
        $check = AreaOfSectorsModel::where('area_of_sector',$req->area_of_sector)->first();
        if($check == null){
            $save = $repo->createNew($req->all(), new AreaOfSectorsModel());
            if ($save['code'] == 101) {
                $area_of_sectors = AreaOfSectorsModel::all()->toArray();
                return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area Of Sectors Added Successfully')->with($area_of_sectors);
            } else {
                return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
            }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area of sector already exist please enter unique area of sector.');
        }

    }

    public function editAreaOfSector($id)
    {
        $area_of_sector = AreaOfSectorsModel::find($id)->toArray();
        $page = 'area-of-sectors';
        return view('vendor.admin.editareaofsector', compact('page', 'area_of_sector'));

    }

    public function updateAreaOfSectors(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new AreaOfSectorsModel());
        if ($update['code'] == 101) {
            $area_of_sectors = AreaOfSectorsModel::all()->toArray();
            return redirect('area-of-sectors')->with('returnStatus', true)->with('status', 101)->with('message', 'Area Of Sectors Updated Successfully')->with($area_of_sectors);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }

    public function specialization()
    {
        $specializations = SpecializationModel::all()->toArray();
        $page = 'specialization';
        return view('vendor.admin.specialization', compact('page', 'specializations'));
    }

    public function postSpecialization(Request $req, CrudRepository $repo)
    {
        $check = SpecializationModel::where('specialization',$req->specialization)->first();
        if($check == null){
            $save = $repo->createNew($req->all(), new SpecializationModel());
            if ($save['code'] == 101) {
                $specializations = SpecializationModel::all()->toArray();
                return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Specialization Added Successfully')->with($specializations);
            } else {
                return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
            }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Specialization already exist please enter unique specialization.');
        }


    }

    public function editSpecialization($id)
    {
        $specialization = SpecializationModel::find($id)->toArray();
        $page = 'specialization';
        return view('vendor.admin.editspecialization', compact('page', 'specialization'));
    }

    public function updateSpecialization(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new SpecializationModel());
        if ($update['code'] == 101) {
            $specializations = SpecializationModel::all()->toArray();
            return redirect('specialization')->with('returnStatus', true)->with('status', 101)->with('message', 'Specializations Updated Successfully')->with($specializations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }

    public function qualification()
    {
        $qualifications = QualificationModel::all()->toArray();
        $page = 'qualification';
        return view('vendor.admin.qualification', compact('page', 'qualifications'));
    }

    public function postQualification(Request $req, CrudRepository $repo)
    {
        $check = QualificationModel::where('qualification',$req->qualification)->first();
        if($check == null){
            $save = $repo->createNew($req->all(), new QualificationModel());
            if ($save['code'] == 101) {
                $qualifications = QualificationModel::all()->toArray();
                return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Qualification Added Successfully')->with($qualifications);
            } else {
                return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
            }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Qualification already exist please enter unique qualification.');
        }

    }

    public function editQualification($id)
    {
        $qualification = QualificationModel::find($id)->toArray();
        $page = 'qualification';
        return view('vendor.admin.editqualification', compact('page', 'qualification'));
    }

    public function updateQualification(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new QualificationModel());
        if ($update['code'] == 101) {
            $qualifications = QualificationModel::all()->toArray();
            return redirect('qualification')->with('returnStatus', true)->with('status', 101)->with('message', 'Qualification Updated Successfully')->with($qualifications);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }


    public function jobByRoles()
    {
        $job_by_roles = JobByRolesModel::all()->toArray();
        $page = 'job-by-roles';
        return view('vendor.admin.jobbyroles', compact('page', 'job_by_roles'));
    }

    public function postJobByRoles(Request $req, CrudRepository $repo)
    {
        $check = JobByRolesModel::where('job_by_role',$req->job_by_role)->first();
        if($check == null){
            $save = $repo->createNew($req->all(), new JobByRolesModel());
            if ($save['code'] == 101) {
                $job_by_roles = JobByRolesModel::all()->toArray();
                return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role Added Successfully')->with($job_by_roles);
            } else {
                return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
            }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role already exist please enter unique job role.');
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editJobByRoles($id)
    {
        $job_by_role = JobByRolesModel::find($id)->toArray();
        $page = 'job-by-roles';
        return view('vendor.admin.editjobbyroles', compact('page', 'job_by_role'));
    }

    /**
     * @param Request $req
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateJobByRoles(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new JobByRolesModel());
        if ($update['code'] == 101) {
            $job_by_roles = JobByRolesModel::all()->toArray();
            return redirect('job-by-role')->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role Updated Successfully')->with($job_by_roles);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function jobTypes()
    {
        $job_types = JobTypesModel::all()->toArray();
        $page = 'job-types';
        return view('vendor.admin.jobtypes', compact('page', 'job_types'));
    }

    /**
     * @param Request $req
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postJobType(Request $req, CrudRepository $repo)
    {
        $check = JobTypesModel::where('job_type',$req->job_type)->first();
        if($check == null){
            $save = $repo->createNew($req->all(), new JobTypesModel());
            if ($save['code'] == 101) {
                $job_types = JobTypesModel::all()->toArray();
                return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role Added Successfully')->with($job_types);
            } else {
                return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
            }
        }
        else{
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Type already exist please enter unique job type.');
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editJobTypes($id)
    {
        $job_type = JobTypesModel::find($id)->toArray();
        $page = 'job-types';
        return view('vendor.admin.editjobtypes', compact('page', 'job_type'));
    }


    /**
     * @param Request $req
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateJobType(Request $req, CrudRepository $repo)
    {
        $update = $repo->updateModelById($req->all(), new JobTypesModel());
        if ($update['code'] == 101) {
            $job_types = JobTypesModel::all()->toArray();
            return redirect('job-types')->with('returnStatus', true)->with('status', 101)->with('message', 'Job Type Updated Successfully')->with($job_types);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $update['message']);
        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllUser()
    {
        $page = 'user';
        $sub_page = 'all-user';
        $users = SeekerModel::all()->toArray();
        return view('vendor.seeker.allseeker', compact('users', 'page', 'sub_page'));
    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id, CrudRepository $repo)
    {
        // for seeker
        $whereArray = array('seeker_id'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new SeekerModel());
        if ($delete['code'] == 101) {
            $locations = SeekerModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'User deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }

    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRecruiter($id, CrudRepository $repo)
    {
        // for jobs
        $whereArray = array('recruiter_id'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();
        // for seeker
        $whereArray = array('recruiter_id'=>$id);
        $deleteseeker = \DB::table('recruiter_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new RecruiterModel());
        if ($delete['code'] == 101) {
            $locations = JobTypesModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Recruiter Deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }

    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteJobTypes($id, CrudRepository $repo)
    {
        // for jobs
        $whereArray = array('job_type'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();
        // for seeker
        $whereArray = array('job_type'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new JobTypesModel());
        if ($delete['code'] == 101) {
            $locations = JobTypesModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }

    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteJobByRoles($id, CrudRepository $repo)
    {
        // for jobs
        $whereArray = array('job_by_roles'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();
        // for seeker
        $whereArray = array('role_type'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new JobByRolesModel());

        if ($delete['code'] == 101) {
            $locations = JobByRolesModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNewRecruiter()
    {

        $page = 'recruiter';
        $sub_page = 'add-recruiter';
        return view('vendor.recruiter.addrecruiter', compact('page', 'sub_page'));
    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLocation($id, CrudRepository $repo)
    {
        $whereArray = array('job_location'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new LocationModel());
        if ($delete['code'] == 101) {
            $locations = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }

    }

    public function deleteSpecialization($id, CrudRepository $repo)
    {
        $whereArray = array('specialization'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();

        $whereArray = array('specialization'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new SpecializationModel());
        if ($delete['code'] == 101) {
            $locations = SpecializationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Specialization deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }
    }

    public function deleteQualification($id, CrudRepository $repo)
    {
        $whereArray = array('qualification'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();

        $whereArray = array('seeker_qualification'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new QualificationModel());
        if ($delete['code'] == 101) {
            $locations = QualificationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Qualification deleted Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }
    }

    /**
     * @param $id
     * @param CrudRepository $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAreaOfSector($id, CrudRepository $repo){

        $whereArray = array('area_of_sector'=>$id);
        $deletejobs = \DB::table('jobs')->where($whereArray)->delete();

        $whereArray = array('area_of_sector'=>$id);
        $deleteseeker = \DB::table('seeker_profile')->where($whereArray)->delete();

        $delete = $repo->deleteModelById($id, new AreaOfSectorsModel());
        if ($delete['code'] == 101) {
            $area_of_sectors = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area of sector deleted Successfully')->with($area_of_sectors);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }
    }


}