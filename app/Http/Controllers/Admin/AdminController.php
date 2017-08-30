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
        $page = "dashboard";
        return view('vendor.admin.dashboard', compact('page', 'locations'));
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
        $save = $repo->createNew($req->all(), new LocationModel());
        if ($save['code'] == 101) {
            $locations = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location Added Successfully')->with($locations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $save = $repo->createNew($req->all(), new AreaOfSectorsModel());
        if ($save['code'] == 101) {
            $area_of_sectors = AreaOfSectorsModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area Of Sectors Added Successfully')->with($area_of_sectors);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $save = $repo->createNew($req->all(), new SpecializationModel());
        if ($save['code'] == 101) {
            $specializations = SpecializationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Specialization Added Successfully')->with($specializations);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $save = $repo->createNew($req->all(), new QualificationModel());
        if ($save['code'] == 101) {
            $qualifications = QualificationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Qualification Added Successfully')->with($qualifications);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $save = $repo->createNew($req->all(), new JobByRolesModel());
        if ($save['code'] == 101) {
            $job_by_roles = JobByRolesModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role Added Successfully')->with($job_by_roles);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $save = $repo->createNew($req->all(), new JobTypesModel());
        if ($save['code'] == 101) {
            $job_types = JobTypesModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Job Role Added Successfully')->with($job_types);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $save['message']);
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
        $delete = $repo->deleteModelById($id, new LocationModel());
        if ($delete['code'] == 101) {
            $locations = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Location deleted Successfully')->with($locations);
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
        $delete = $repo->deleteModelById($id, new AreaOfSectorsModel());
        if ($delete['code'] == 101) {
            $area_of_sectors = LocationModel::all()->toArray();
            return back()->with('returnStatus', true)->with('status', 101)->with('message', 'Area of sector deleted Successfully')->with($area_of_sectors);
        } else {
            return back()->with('returnStatus', true)->with('status', 101)->with('message', $delete['message']);
        }
    }


}
