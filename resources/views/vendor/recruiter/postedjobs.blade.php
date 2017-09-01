@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>RECRUITER POSTED JOBS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                        {{ $recruiter->organisation_name }} posted jobs

                                                </h2>
                                                {{--<ul class="header-dropdown m-r--5">--}}
                                                    {{--<li class="dropdown">--}}
                                                        {{--<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                                                            {{--<i class="material-icons">more_vert</i>--}}
                                                        {{--</a>--}}
                                                        {{--<ul class="dropdown-menu pull-right">--}}
                                                            {{--<li><a href="javascript:void(0);">Action</a></li>--}}
                                                            {{--<li><a href="javascript:void(0);">Another action</a></li>--}}
                                                            {{--<li><a href="javascript:void(0);">Something else here</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            </div>
                                            <div class="body">
                                                <ul class="list-group">
                                                    @foreach($jobs as $key_jobs => $value_jobs)
                                                    <li class="list-group-item">{{ $value_jobs['specialization'] }} <span class="badge bg-pink custom-badge getdetails" data-recruiter="{{$recruiter->id}}" data-react="{{ $value_jobs['id'] }}">View Detail</span></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #END# Badges -->
                                </div>

                            </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="modal" id="job-detail" tabindex="-1" role="dialog">
            <div class="modal-dialog custom-modal-dialog" role="document">
                <div class="modal-content">
                    {{--<div class="modal-header">--}}
                    {{--<h4 class="modal-title" id="defaultModalLabel">Order Detail</h4>--}}
                    {{--</div>--}}
                    <div class="row clearfix" id="orderDetails">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <div class="row clearfix">
                                        <div class="col-xs-12 col-sm-6">
                                            <h3>Recruiter Details with posted job</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-12 clearfix">
                                            <h4>Job Detail</h4>
                                            <li class="list-group-item">
                                                <span >Job Role </span>
                                                <input type="hidden" value="" id="orderId">
                                                <span id="job_by_roles" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Job Location : </span>
                                                <span id="job_location" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span>Specialization : </span>
                                                <span id="specialization" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Qualification :</span>
                                                <span id="qualification" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Passout Criteria:</span>
                                                <span id="year_of_passing" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Qualification Criteria :</span>
                                                <span id="percentage_or_cgpa" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Skills Required :</span>
                                                <span id="skills_required" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Minimum salary:</span>
                                                <span id="min_sal" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Minimum salary :</span>
                                                <span id="max_sal" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Job Type :</span>
                                                <span id="job_type" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Process :</span>
                                                <span id="process" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Job Discription :</span>
                                                <span id="job_discription" style="margin-left: 15px"></span>
                                            </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-12 clearfix">
                                            <h4>Recruiter Detail</h4>
                                            <li class="list-group-item">
                                                <span >Organisation Name : </span>
                                                <input type="hidden" value="" id="orderId">
                                                <span id="organisation_name" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Recruiter Contact No. : </span>
                                                <span id="recruiter_mobile_no" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span>Recruiter Email : </span>
                                                <span id="recruiter_email" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Recruiter identity :</span>
                                                <span id="i_am" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Recruiter Address :</span>
                                                <span id="org_address" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Recruiter Location :</span>
                                                <span id="org_location" style="margin-left: 15px"></span>
                                            </li>
                                            <li class="list-group-item">
                                                <span >Recruiter Website :</span>
                                                <span id="org_website" style="margin-left: 15px"></span>
                                            </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="modal-body">--}}
                    {{--<div class="col-md-12">--}}
                    {{--<h4>User Deatail</h4>--}}
                    {{--</div>--}}


                    {{--</div>--}}
                    <div class="modal-footer">
                        <div class="confirm-loading">
                            <div class="preloader pl-size-xs" >
                                <div class="spinner-layer pl-red-grey">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<button type="button" id="rejectOrder" class="btn btn-warning waves-effect">Reject</button>--}}
                        {{--<button type="button" id="printOrder" class="btn btn-info waves-effect">Print</button>--}}
                        {{--<button type="button" id="confirmOrder" class="btn btn-success waves-effect">Confirmed</button>--}}
                        {{--<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
